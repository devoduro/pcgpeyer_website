@extends('layouts.app')

@section('title', 'Privacy Policy - PCG Peyer Memorial Congregation')

@section('content')
@include('legal._page', ['heading' => 'Privacy Policy', 'updated' => '25 October 2026'])

<section class="py-12 bg-white">
    <div class="legal max-w-3xl mx-auto px-4 sm:px-6">
        <p>This policy explains what the PCG mobile app ("the app") of the Presbyterian Church of Ghana, Peyer Memorial
            Congregation ("we", "the church") collects, why, and the choices you have. It also covers this website where
            it handles app accounts.</p>

        <h2>Information we collect</h2>
        <ul>
            <li><strong>Account details</strong> you give when you register: full name, email address, phone number,
                preferred language and, if you add them, your congregation and a profile picture. Your password is stored
                only as a secure hash.</li>
            <li><strong>Membership applications</strong>: the congregation and notes you submit when you apply to become a member.</li>
            <li><strong>Devotion activity</strong>: when you open and complete each daily devotional, your streak, and any
                reflection answer you choose to write.</li>
            <li><strong>Settings on your phone</strong>: favourite hymns, text size and reading position are kept on your
                device, not on our servers.</li>
            <li><strong>Notifications</strong>: if you allow notifications, a push token from Firebase Cloud Messaging so we can
                send church announcements.</li>
        </ul>
        <p>We do not collect your location, contacts, photos (other than a profile picture you choose to upload) or
            payment details.</p>

        <h2>How we use it</h2>
        <ul>
            <li>To create and secure your account, verify your email and let you sign in.</li>
            <li>To provide devotions, devotion-first mode, streaks, hymns, the Bible and church content.</li>
            <li>To process membership applications through the church office.</li>
            <li>To send church notifications you have allowed.</li>
        </ul>
        <p>We do not sell your personal information and we do not use it for advertising profiles.</p>

        <h2>Service providers</h2>
        <ul>
            <li><strong>Google Firebase</strong> (Authentication and Cloud Messaging) sends the email verification link and
                delivers notifications. Google processes your email address and device token for these purposes.</li>
            <li><strong>Google AdMob</strong>: the app contains Google's advertising library. If advertisements are shown,
                Google may use device identifiers as described in
                <a href="https://policies.google.com/technologies/partner-sites">Google's partner policy</a>.</li>
            <li>Our web host stores the church database securely.</li>
        </ul>

        <h2>Who can see your information</h2>
        <p>Only authorised church staff can see account and membership details. Reflection answers are private to you and
            authorised pastoral staff. Your details are never shown to other app users.</p>

        <h2>Security</h2>
        <p>Data is sent over encrypted connections (HTTPS). Passwords are hashed. Your sign-in token is kept in your
            phone's secure storage (Android Keystore).</p>

        <h2>Keeping and deleting your data</h2>
        <p>We keep your account until you delete it. You can delete your account at any time:</p>
        <ul>
            <li>In the app: <strong>Profile &rarr; Delete account</strong>.</li>
            <li>On the web, without the app: <a href="{{ route('legal.delete-account') }}">{{ route('legal.delete-account') }}</a>.</li>
        </ul>
        <p>Deletion is immediate and permanent. It removes your account, sign-in sessions, verification codes, profile
            picture, devotion records and reflection answers, and membership applications. If you are a registered church
            member, the church office keeps its own member register as part of normal church administration; it is only
            unlinked from the deleted app account. Data stored only on your phone is removed when you uninstall the app.</p>

        <h2>Children</h2>
        <p>The app is intended for church members and visitors aged 13 and over. Younger children should use it with a
            parent or guardian. If you believe a child has given us personal information without consent, contact us and
            we will delete it.</p>

        <h2>Your rights</h2>
        <p>You may ask to see, correct or delete your information, in line with Ghana's Data Protection Act, 2012 (Act 843).
            Most details can be changed in the app; for anything else contact us.</p>

        <h2>Changes</h2>
        <p>We will post any changes on this page and update the date above.</p>

        <h2>Contact</h2>
        <p>PCG Peyer Memorial Congregation &middot; <a href="mailto:info@pcgpeyer.org">info@pcgpeyer.org</a></p>
    </div>
</section>
@endsection
