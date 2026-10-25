<?php

namespace Tests\Feature;

use App\Models\AppUser;
use App\Support\FirebaseTokenVerifier;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/** Signs test tokens with a locally generated key that stands in for Google's. */
class FirebaseVerificationTest extends TestCase
{
    private const PROJECT = 'bantama-presby';

    private \OpenSSLAsymmetricKey $key;
    private string $cert;
    private string $token;

    protected function setUp(): void
    {
        parent::setUp();
        $base = dirname(__DIR__, 2);
        Artisan::call('migrate:fresh', [
            '--realpath' => true,
            '--path' => [
                "$base/database/migrations/2024_01_01_000000_create_users_table.php",
                "$base/database/migrations/2026_10_17_000001_create_members_table.php",
                "$base/database/migrations/2026_10_17_000002_create_app_users_table.php",
                "$base/database/migrations/2026_10_18_000001_create_devotionals_tables.php",
                "$base/vendor/laravel/sanctum/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php",
            ],
        ]);

        [$this->key, $this->cert] = $this->keyPair();
        $this->app->instance(FirebaseTokenVerifier::class, new FirebaseTokenVerifier(self::PROJECT, fn () => ['kid1' => $this->cert]));

        $this->token = $this->postJson('/api/v1/auth/register', [
            'name' => 'Ama', 'email' => 'Ama@Example.com', 'phone' => '0200111222',
            'password' => 'secret-pass-1', 'password_confirmation' => 'secret-pass-1',
        ])->json('token');
    }

    private function keyPair(): array
    {
        $cfg = ['private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA];
        // XAMPP's PHP on Windows has no default OpenSSL config; certificate creation needs one.
        foreach ([getenv('OPENSSL_CONF') ?: '', 'C:/xampp/php/extras/ssl/openssl.cnf'] as $conf) {
            if ($conf !== '' && is_file($conf)) {
                $cfg['config'] = $conf;
                break;
            }
        }
        $key = openssl_pkey_new($cfg);
        $csr = openssl_csr_new(['commonName' => 'test'], $key, $cfg);
        openssl_x509_export(openssl_csr_sign($csr, null, $key, 1, $cfg), $cert);
        return [$key, $cert];
    }

    private function jwt(array $override = [], $key = null, string $kid = 'kid1'): string
    {
        $now = time();
        $claims = array_merge([
            'iss' => 'https://securetoken.google.com/' . self::PROJECT,
            'aud' => self::PROJECT,
            'auth_time' => $now - 10,
            'iat' => $now - 10,
            'exp' => $now + 3600,
            'sub' => 'firebase-uid-1',
            'email' => 'ama@example.com',
            'email_verified' => true,
        ], $override);
        $b64 = fn ($v) => rtrim(strtr(base64_encode(json_encode($v)), '+/', '-_'), '=');
        $head = $b64(['alg' => 'RS256', 'kid' => $kid, 'typ' => 'JWT']);
        $body = $b64($claims);
        openssl_sign("$head.$body", $sig, $key ?? $this->key, OPENSSL_ALGO_SHA256);
        return "$head.$body." . rtrim(strtr(base64_encode($sig), '+/', '-_'), '=');
    }

    private function send(string $jwt)
    {
        return $this->withToken($this->token)->postJson('/api/v1/auth/verify-email/firebase', ['id_token' => $jwt]);
    }

    public function test_valid_firebase_token_verifies_the_email(): void
    {
        $this->send($this->jwt())->assertOk()->assertJsonPath('user.email_verified', true);
        $this->assertNotNull(AppUser::first()->email_verified_at);
    }

    public function test_rejects_token_for_another_project(): void
    {
        $this->send($this->jwt(['aud' => 'someone-else']))->assertStatus(422);
        $this->send($this->jwt(['iss' => 'https://securetoken.google.com/someone-else']))->assertStatus(422);
        $this->assertNull(AppUser::first()->email_verified_at);
    }

    public function test_rejects_expired_or_future_tokens(): void
    {
        $this->send($this->jwt(['exp' => time() - 600]))->assertStatus(422);
        $this->send($this->jwt(['iat' => time() + 600]))->assertStatus(422);
    }

    public function test_rejects_forged_signature_and_unknown_key(): void
    {
        [$otherKey] = $this->keyPair();
        $this->send($this->jwt([], $otherKey))->assertStatus(422);
        $this->send($this->jwt([], null, 'unknown-kid'))->assertStatus(422);
        $this->send('not.a.jwt')->assertStatus(422);
    }

    public function test_rejects_other_email_or_unverified_email(): void
    {
        $this->send($this->jwt(['email' => 'someone@example.com']))->assertStatus(422);
        $this->send($this->jwt(['email_verified' => false]))->assertStatus(422)->assertJsonValidationErrors('id_token');
        $this->assertNull(AppUser::first()->email_verified_at);
    }

    public function test_requires_login(): void
    {
        $this->postJson('/api/v1/auth/verify-email/firebase', ['id_token' => $this->jwt()])->assertUnauthorized();
    }
}
