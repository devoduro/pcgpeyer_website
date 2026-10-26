<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use RuntimeException;

/**
 * Firebase Cloud Messaging (HTTP v1). Signs a short-lived JWT with the service-account key,
 * swaps it for an OAuth access token, then sends to a topic. Uses plain curl (no HTTP package
 * is installed); tests pass their own $post transport.
 */
class FcmPushNotifier implements PushNotifier
{
    /** @var callable(string $url, array $headers, string $body): array{0:int,1:?array} */
    private $post;

    public function __construct(private string $projectId, private string $credentialsPath, ?callable $post = null)
    {
        $this->post = $post ?? [$this, 'curlPost'];
    }

    public function isConfigured(): bool
    {
        return is_readable($this->credentialsPath);
    }

    public function sendToTopic(string $topic, string $title, string $body, array $data = [], ?string $imageUrl = null): void
    {
        $notification = array_filter(['title' => $title, 'body' => $body, 'image' => $imageUrl]);

        [$status, $json] = ($this->post)(
            "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send",
            ['Authorization: Bearer ' . $this->accessToken(), 'Content-Type: application/json'],
            json_encode([
                'message' => [
                    'topic' => $topic,
                    'notification' => $notification,
                    // FCM data values must be strings.
                    'data' => array_map('strval', $data),
                    'android' => ['priority' => 'high', 'notification' => ['channel_id' => 'devotions', 'sound' => 'default']],
                ],
            ])
        );

        if ($status < 200 || $status >= 300) {
            throw new RuntimeException('Firebase refused the notification (HTTP ' . $status . '): '
                . ($json['error']['message'] ?? 'no details'));
        }
    }

    private function accessToken(): string
    {
        return Cache::remember('fcm_access_token', 50 * 60, function () {
            $key = $this->credentials();
            $tokenUri = $key['token_uri'] ?? 'https://oauth2.googleapis.com/token';
            $now = time();
            $jwt = $this->jwt([
                'iss' => $key['client_email'],
                'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
                'aud' => $tokenUri,
                'iat' => $now,
                'exp' => $now + 3600,
            ], $key['private_key']);

            [$status, $json] = ($this->post)($tokenUri, ['Content-Type: application/x-www-form-urlencoded'], http_build_query([
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ]));
            if ($status !== 200 || empty($json['access_token'])) {
                throw new RuntimeException('Could not sign in to Firebase with the service-account key (HTTP ' . $status . ').');
            }

            return $json['access_token'];
        });
    }

    private function credentials(): array
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Push notifications are not set up: the Firebase service-account key is missing.');
        }
        $key = json_decode((string) file_get_contents($this->credentialsPath), true);
        if (! is_array($key) || empty($key['client_email']) || empty($key['private_key'])) {
            throw new RuntimeException('The Firebase service-account key file is not valid.');
        }

        return $key;
    }

    private function jwt(array $claims, string $privateKey): string
    {
        $segments = [$this->b64(json_encode(['alg' => 'RS256', 'typ' => 'JWT'])), $this->b64(json_encode($claims))];
        $signature = '';
        if (! openssl_sign(implode('.', $segments), $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            throw new RuntimeException('Could not sign the Firebase request with the service-account key.');
        }
        $segments[] = $this->b64($signature);

        return implode('.', $segments);
    }

    /** @return array{0:int,1:?array} HTTP status and decoded JSON body */
    private function curlPost(string $url, array $headers, string $body): array
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
        ]);
        $raw = curl_exec($ch);
        if ($raw === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new RuntimeException("Could not reach Firebase: $error");
        }
        $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);

        return [$status, json_decode($raw, true)];
    }

    private function b64(string $s): string
    {
        return rtrim(strtr(base64_encode($s), '+/', '-_'), '=');
    }
}
