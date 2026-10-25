<?php

namespace App\Support;

use App\Models\AppUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Permanently deletes a mobile-app account and the personal data tied to it (Google Play account
 * deletion requirement). Used by the in-app API and the public web form.
 *
 * Removed: the account, sign-in tokens, verification/reset codes, profile picture, devotion reading
 * and completion records (including reflection answers) and membership applications.
 * Kept: the church's own member register entry (members table), which belongs to the church office,
 * not to the app account. It is only unlinked.
 */
class AppAccountDeleter
{
    public function delete(AppUser $user): void
    {
        $picture = $user->profile_picture;
        $email = $user->email;

        DB::transaction(function () use ($user, $email) {
            $user->tokens()->delete();
            DB::table('app_auth_codes')->where('email', $email)->delete();
            // devotional_reads, devotional_completions and membership_applications cascade on delete.
            $user->delete();
        });

        if ($picture) {
            Storage::disk('public')->delete($picture);
        }
    }
}
