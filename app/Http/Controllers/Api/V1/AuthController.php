<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Support\FirebaseTokenVerifier;
use App\Support\Phone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private const CODE_TTL_MINUTES = 30;
    private const MAX_CODE_ATTEMPTS = 5;

    public function register(Request $request): JsonResponse
    {
        $request->merge(['phone' => Phone::normalize($request->input('phone'))]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:190', 'unique:app_users,email'],
            'phone' => ['required', 'string', 'max:20', 'unique:app_users,phone'],
            'password' => ['required', 'string', 'min:8', 'max:100', 'confirmed'],
            'language' => ['nullable', Rule::in(['en', 'tw', 'ga'])],
            'device_name' => ['nullable', 'string', 'max:100'],
        ]);

        $user = AppUser::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'phone' => $data['phone'],
            'password' => $data['password'],
            'language' => $data['language'] ?? 'en',
        ]);
        $user->refresh(); // load DB defaults (role, status) into the response

        $this->sendCode($user->email, 'verify_email');

        return response()->json([
            'user' => $this->present($user),
            'token' => $user->createToken($data['device_name'] ?? 'mobile')->plainTextToken,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['nullable', 'string', 'max:100'],
        ]);

        $user = AppUser::where('email', strtolower($data['email']))->first();

        // Same response for unknown email and wrong password (no account enumeration).
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => ['These credentials do not match our records.']]);
        }
        if (!$user->isActive()) {
            return response()->json(['message' => 'This account is not active.'], 403);
        }

        $user->forceFill(['last_login_at' => now()])->save();

        return response()->json([
            'user' => $this->present($user),
            'token' => $user->createToken($data['device_name'] ?? 'mobile')->plainTextToken,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out.']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json(['user' => $this->present($request->user())]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        if ($request->has('phone')) {
            $request->merge(['phone' => Phone::normalize($request->input('phone'))]);
        }

        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:120'],
            'phone' => ['sometimes', 'string', 'max:20', Rule::unique('app_users', 'phone')->ignore($user->id)],
            'language' => ['sometimes', Rule::in(['en', 'tw', 'ga'])],
            'congregation' => ['sometimes', 'nullable', 'string', 'max:150'],
            'notification_settings' => ['sometimes', 'array'],
            'profile_picture' => ['sometimes', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        $user->update($data);

        return response()->json(['user' => $this->present($user->fresh())]);
    }

    public function changePassword(Request $request): JsonResponse
    {
        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'max:100', 'confirmed'],
        ]);

        $user = $request->user();
        if (!Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages(['current_password' => ['Current password is incorrect.']]);
        }

        $user->update(['password' => $data['password']]);
        // Keep this device signed in; revoke every other session.
        $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Password updated.']);
    }

    public function verifyEmail(Request $request): JsonResponse
    {
        $data = $request->validate(['code' => ['required', 'digits:6']]);
        $user = $request->user();

        if ($user->email_verified_at) {
            return response()->json(['user' => $this->present($user)]);
        }
        $this->consumeCode($user->email, 'verify_email', $data['code']);
        $user->forceFill(['email_verified_at' => now()])->save();

        return response()->json(['user' => $this->present($user->fresh())]);
    }

    /**
     * Verify the email using Firebase: the app sends a Firebase ID token obtained after the user
     * clicked Firebase's verification link. We trust it only if Google signed it for our project
     * and it says this exact email address is verified.
     */
    public function verifyEmailWithFirebase(Request $request, FirebaseTokenVerifier $verifier): JsonResponse
    {
        $data = $request->validate(['id_token' => ['required', 'string', 'max:4096']]);
        $user = $request->user();

        if ($user->email_verified_at) {
            return response()->json(['user' => $this->present($user)]);
        }

        try {
            $claims = $verifier->verify($data['id_token']);
        } catch (\RuntimeException $e) {
            report($e);
            throw ValidationException::withMessages(['id_token' => ['We could not confirm your email with Firebase. Please try again.']]);
        }

        if (strtolower((string) ($claims['email'] ?? '')) !== strtolower($user->email)) {
            throw ValidationException::withMessages(['id_token' => ['That Firebase account belongs to a different email address.']]);
        }
        if (($claims['email_verified'] ?? false) !== true) {
            throw ValidationException::withMessages(['id_token' => ['Your email is not verified yet. Open the link in the email we sent, then try again.']]);
        }

        $user->forceFill(['email_verified_at' => now()])->save();

        return response()->json(['user' => $this->present($user->fresh())]);
    }

    public function resendVerification(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user->email_verified_at) {
            $this->sendCode($user->email, 'verify_email');
        }
        return response()->json(['message' => 'If verification is pending, a new code has been sent.']);
    }

    public function forgotPassword(Request $request): JsonResponse
    {
        $data = $request->validate(['email' => ['required', 'email']]);
        $email = strtolower($data['email']);

        if (AppUser::where('email', $email)->exists()) {
            $this->sendCode($email, 'reset_password');
        }
        // Identical response whether or not the account exists.
        return response()->json(['message' => 'If that email is registered, a reset code has been sent.']);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'digits:6'],
            'password' => ['required', 'string', 'min:8', 'max:100', 'confirmed'],
        ]);
        $email = strtolower($data['email']);

        $this->consumeCode($email, 'reset_password', $data['code']);

        $user = AppUser::where('email', $email)->first();
        if (!$user) {
            throw ValidationException::withMessages(['code' => ['The code is invalid or has expired.']]);
        }
        $user->update(['password' => $data['password']]);
        $user->tokens()->delete();

        return response()->json(['message' => 'Password reset. Please log in.']);
    }

    /** Deactivates the account now and flags it for data deletion by an administrator. */
    public function requestDeletion(Request $request): JsonResponse
    {
        $request->validate(['password' => ['required', 'string']]);
        $user = $request->user();

        if (!Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages(['password' => ['Password is incorrect.']]);
        }

        $user->forceFill(['status' => 'deactivated', 'deletion_requested_at' => now()])->save();
        $user->tokens()->delete();

        return response()->json(['message' => 'Your account has been deactivated and queued for deletion.']);
    }

    private function sendCode(string $email, string $type): void
    {
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('app_auth_codes')->updateOrInsert(
            ['email' => $email, 'type' => $type],
            [
                'code_hash' => Hash::make($code),
                'attempts' => 0,
                'expires_at' => now()->addMinutes(self::CODE_TTL_MINUTES),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $subject = $type === 'verify_email' ? 'Verify your PCG app account' : 'Reset your PCG app password';
        try {
            Mail::raw("Your code is {$code}. It expires in " . self::CODE_TTL_MINUTES . ' minutes.', function ($m) use ($email, $subject) {
                $m->to($email)->subject($subject);
            });
        } catch (\Throwable $e) {
            report($e); // mail transport down must not break registration; user can resend
        }
    }

    private function consumeCode(string $email, string $type, string $code): void
    {
        $row = DB::table('app_auth_codes')->where(['email' => $email, 'type' => $type])->first();
        $invalid = ValidationException::withMessages(['code' => ['The code is invalid or has expired.']]);

        if (!$row || now()->greaterThan($row->expires_at) || $row->attempts >= self::MAX_CODE_ATTEMPTS) {
            throw $invalid;
        }
        if (!Hash::check($code, $row->code_hash)) {
            DB::table('app_auth_codes')->where('id', $row->id)->increment('attempts');
            throw $invalid;
        }
        DB::table('app_auth_codes')->where('id', $row->id)->delete();
    }

    private function present(AppUser $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'language' => $user->language,
            'congregation' => $user->congregation,
            'role' => $user->role,
            'profile_picture' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : null,
            'email_verified' => (bool) $user->email_verified_at,
            'membership_status' => $user->membershipStatus(),
            'member_number' => $user->member?->member_number,
            'notification_settings' => $user->notification_settings,
        ];
    }
}
