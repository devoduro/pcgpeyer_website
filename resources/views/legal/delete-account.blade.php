@extends('layouts.app')

@section('title', 'Delete your app account - PCG Peyer Memorial Congregation')

@section('content')
@include('legal._page', ['heading' => 'Delete your app account', 'updated' => null])

<section class="py-12 bg-white">
    <div class="legal max-w-xl mx-auto px-4 sm:px-6">
        @if(session('deleted'))
            <div class="p-4 mb-6 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('deleted') }}</div>
        @endif

        <p>Use this page to delete the account you created in the <strong>PCG mobile app</strong> without opening the app.
            You can also delete it inside the app under <strong>Profile &rarr; Delete account</strong>.</p>

        <h2>What is deleted</h2>
        <ul>
            <li>Your account (name, email, phone, password, language, congregation, profile picture)</li>
            <li>All sign-in sessions and verification codes</li>
            <li>Your devotion reading records, streak and reflection answers</li>
            <li>Your membership applications</li>
        </ul>
        <p>Deletion is immediate and cannot be undone. The church office's own member register is not part of your app
            account; ask the office if you want it changed. See the <a href="{{ route('legal.privacy') }}">Privacy Policy</a>.</p>

        <form method="POST" action="{{ route('legal.delete-account.submit') }}" class="mt-8 space-y-4">
            @csrf
            @if($errors->any())
                <div class="p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                </div>
            @endif
            <div>
                <label for="email" class="block font-semibold text-gray-700 mb-1">Email used in the app</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label for="password" class="block font-semibold text-gray-700 mb-1">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                <p class="text-sm text-gray-500 mt-1">Forgotten it? Use "Forgot password" in the app first, or email
                    <a href="mailto:info@pcgpeyer.org">info@pcgpeyer.org</a> from the address on your account.</p>
            </div>
            <label class="flex items-start gap-2">
                <input type="checkbox" name="confirm" value="1" class="mt-1">
                <span class="text-gray-700">I understand my account and its data will be permanently deleted.</span>
            </label>
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg">
                Delete my account
            </button>
        </form>
    </div>
</section>
@endsection
