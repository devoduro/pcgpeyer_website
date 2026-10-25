<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Support\AppAccountDeleter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/** Public pages Google Play requires: privacy policy, terms, and account deletion without the app. */
class LegalController extends Controller
{
    public function privacy()
    {
        return view('legal.privacy');
    }

    public function terms()
    {
        return view('legal.terms');
    }

    public function deleteAccountForm()
    {
        return view('legal.delete-account');
    }

    public function deleteAccount(Request $request, AppAccountDeleter $deleter)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'confirm' => ['accepted'],
        ], [
            'confirm.accepted' => 'Please tick the box to confirm you want your account deleted.',
        ]);

        $user = AppUser::where('email', strtolower($data['email']))->first();

        // Same message whether the email is unknown or the password is wrong.
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'The email or password is not correct.']);
        }

        $deleter->delete($user);

        return redirect(route('legal.delete-account'))
            ->with('deleted', 'Your PCG app account and its data have been permanently deleted.');
    }
}
