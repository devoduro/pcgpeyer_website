@extends('layouts.app')

@section('title', 'Terms of Use - PCG Peyer Memorial Congregation')

@section('content')
@include('legal._page', ['heading' => 'Terms of Use', 'updated' => '25 October 2026'])

<section class="py-12 bg-white">
    <div class="legal max-w-3xl mx-auto px-4 sm:px-6">
        <p>By creating an account or using the PCG mobile app you agree to these terms. If you do not agree, please do not
            use the app.</p>

        <h2>Your account</h2>
        <ul>
            <li>Anyone may register; you do not need to be a church member. Give accurate details and keep your password private.</li>
            <li>Membership status is confirmed only by the church office.</li>
            <li>You can delete your account at any time in the app (Profile &rarr; Delete account) or at
                <a href="{{ route('legal.delete-account') }}">{{ route('legal.delete-account') }}</a>.</li>
        </ul>

        <h2>Acceptable use</h2>
        <p>Use the app respectfully and lawfully. Do not attempt to access other people's accounts, disrupt the service,
            or copy content for commercial use. We may suspend accounts that misuse the app.</p>

        <h2>Content</h2>
        <ul>
            <li>Devotionals, sermons and church media are provided by the congregation for personal spiritual use.</li>
            <li>Hymn texts are from the hymnody of the Presbyterian Church of Ghana and are provided for worship and
                personal use; please do not republish them.</li>
            <li>The Bible text is the King James Version, which is in the public domain outside the United Kingdom.</li>
        </ul>

        <h2>Devotion-first mode</h2>
        <p>When devotion-first mode is on, some sections stay locked until you complete the day's devotional. Completion is
            confirmed by our server; this is a spiritual discipline feature, not a measure of anyone's faith.</p>

        <h2>Availability and liability</h2>
        <p>We provide the app as it is and try to keep it available and accurate, but we cannot promise it will always be
            free of errors or interruptions. To the extent the law allows, the church is not liable for losses from using the app.</p>

        <h2>Privacy</h2>
        <p>Our <a href="{{ route('legal.privacy') }}">Privacy Policy</a> explains how we handle your information.</p>

        <h2>Changes and law</h2>
        <p>We may update these terms and will post changes here. These terms are governed by the laws of Ghana.</p>

        <h2>Contact</h2>
        <p><a href="mailto:info@pcgpeyer.org">info@pcgpeyer.org</a></p>
    </div>
</section>
@endsection
