<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use RuntimeException;

/**
 * Verifies Firebase Authentication ID tokens (RS256 JWTs) without extra packages, following
 * https://firebase.google.com/docs/auth/admin/verify-id-tokens#verify_id_tokens_using_a_third-party_jwt_library
 */
class FirebaseTokenVerifier
{
    private const LEEWAY = 60; // seconds of clock skew we tolerate

    /** @var callable(): array<string,string> kid => PEM certificate */
    private $certs;

    public function __construct(private string $projectId, ?callable $certs = null)
    {
        $this->certs = $certs ?? fn () => $this->fetchGoogleCerts();
    }

    /**
     * @return array<string,mixed> the verified claims
     * @throws RuntimeException when the token is not a valid ID token for this project
     */
    public function verify(string $jwt): array
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            throw new RuntimeException('Malformed token.');
        }
        [$h64, $p64, $s64] = $parts;
        $header = json_decode($this->b64($h64), true);
        $claims = json_decode($this->b64($p64), true);
        if (!is_array($header) || !is_array($claims)) {
            throw new RuntimeException('Malformed token.');
        }
        if (($header['alg'] ?? null) !== 'RS256') {
            throw new RuntimeException('Unexpected signing algorithm.');
        }

        $certs = ($this->certs)();
        $cert = $certs[$header['kid'] ?? ''] ?? null;
        if (!$cert) {
            throw new RuntimeException('Unknown signing key.');
        }
        $key = openssl_pkey_get_public($cert);
        if (!$key || openssl_verify("$h64.$p64", $this->b64($s64), $key, OPENSSL_ALGO_SHA256) !== 1) {
            throw new RuntimeException('Invalid signature.');
        }

        $now = time();
        if (($claims['exp'] ?? 0) < $now - self::LEEWAY) {
            throw new RuntimeException('Token expired.');
        }
        if (($claims['iat'] ?? PHP_INT_MAX) > $now + self::LEEWAY || ($claims['auth_time'] ?? PHP_INT_MAX) > $now + self::LEEWAY) {
            throw new RuntimeException('Token issued in the future.');
        }
        if (($claims['aud'] ?? null) !== $this->projectId) {
            throw new RuntimeException('Token is for another project.');
        }
        if (($claims['iss'] ?? null) !== 'https://securetoken.google.com/' . $this->projectId) {
            throw new RuntimeException('Unexpected token issuer.');
        }
        if (empty($claims['sub']) || !is_string($claims['sub'])) {
            throw new RuntimeException('Token has no subject.');
        }

        return $claims;
    }

    private function b64(string $s): string
    {
        return (string) base64_decode(strtr($s, '-_', '+/') . str_repeat('=', (4 - strlen($s) % 4) % 4));
    }

    /** Google rotates these keys; cache them for an hour. */
    private function fetchGoogleCerts(): array
    {
        return Cache::remember('firebase_id_token_certs', 3600, function () {
            $ctx = stream_context_create(['http' => ['timeout' => 10], 'ssl' => ['verify_peer' => true]]);
            $json = @file_get_contents(config('firebase.certs_url'), false, $ctx);
            $certs = $json ? json_decode($json, true) : null;
            if (!is_array($certs) || !$certs) {
                throw new RuntimeException('Could not load Firebase signing keys.');
            }
            return $certs;
        });
    }
}
