@extends('layouts.app')

@section('title', 'Brief History - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
@include('partials.page-hero', [
    'title' => 'Our Rich History',
    'eyebrow' => 'Since 1957',
    'subtitle' => 'From a Morning Devotion group in Bantama homes to a congregation of over five thousand members.',
    'image' => 'images/bantama/mens_fellowship.jpg',
    'crumbs' => [['About Us', route('about.history')], ['Brief History']],
])

<!-- Introduction Section with Image -->
<section class="py-20 bg-white">
    <div class="site">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="decorative-line mb-8"></div>
                <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">Our Foundation Story</h2>
                <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                    <p>
                        Peyer Memorial Congregation of the Presbyterian Church of Ghana was established at Bantama, Kumasi
                        in 1958. It began as a Morning Devotion group during the time of the Very Rev. E. M. L. Odjidja,
                        Pastor in charge of the Ramseyer Memorial Presbyterian Church at Adum. Members grouped at three
                        locations for regular morning devotion, and the passion for souls was so great that within four
                        months, adult membership grew from fifteen to two hundred.
                    </p>
                    <p>
                        On 24th August 1958, five members were elected to manage the affairs of the young congregation:
                        Charles Paul Amponsah, Ernest E. Asare, Samuel Koranteng, E. A. Mensah, and Ben O. Afful.
                        Mr Charles Paul Amponsah offered his home as a meeting place, with Mr J. W. Amoah, who later
                        became a minister, serving as the first Catechist.
                    </p>
                    <p>
                        Over the years, the church has grown and expanded in ministry, and today counts over five
                        thousand members.
                    </p>
                </div>
            </div>
            <div class="relative">
                <div class="relative h-[500px] rounded-3xl overflow-hidden shadow-2xl group">
                    <img src="{{ asset('images/bantama/anniversary.jpg') }}" alt="Peyer Memorial Congregation 60th anniversary emblem, 1957-2017" class="w-full h-full object-contain bg-white p-6 transform group-hover:scale-105 transition duration-700">
                    <div class="absolute bottom-8 left-8 right-8 text-white">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rev. Ernst Peyer Section -->
<section class="py-20 bg-gradient-to-br from-pcg-blue-50 to-gray-50">
    <div class="site">
        <div class="text-center mb-16">
            <div class="decorative-line"></div>
            <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">Rev. Ernst Peyer</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">The Namesake of Our Congregation</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="relative h-[500px] rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/bantama/choir.jpg') }}" alt="The Church Choir of Peyer Memorial Congregation" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8 text-white">
                        <p class="text-3xl font-bold text-shadow-lg">The Church Choir</p>
                        <p class="text-xl text-shadow">Founded 1962, in the 60th anniversary year</p>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <div class="bg-white p-10 rounded-3xl shadow-xl">
                    <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                        <p>
                            Rev. Ernst Peyer was a Basel Mission Representative in Ghana who lived much of his life in
                            Kumasi. He was closely involved in the planning of the Bantama chapel, personally carrying
                            the building plan to Accra for discussion at the Presbyterian Headquarters, and he laid the
                            Foundation Stone of the chapel on 8th November 1970.
                        </p>
                        <p>
                            Rev. Peyer, together with his wife, was also among the most prominent financial supporters
                            of the chapel's construction, alongside friends of the mission in Switzerland.
                        </p>
                        <blockquote class="border-l-4 border-pcg-red-600 pl-6 py-4 my-8 bg-pcg-red-50 rounded-r-lg">
                            <p class="italic text-xl text-gray-800 mb-2">
                                "Except the Lord build the house, they labour in vain that build it."
                            </p>
                            <footer class="text-base text-gray-600">- Psalm 127:1</footer>
                        </blockquote>
                        <p>
                            On 3rd June 1990, in recognition of his devotion and support, the Bantama Presbyterian
                            Church was dedicated and named the Peyer Memorial Congregation in his honour - a legacy
                            that continues to shape our identity today.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Growth & Development Section -->
<section class="py-20 bg-white">
    <div class="site">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="decorative-line mb-8"></div>
                <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">Growth & Development</h2>
                <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                    <p>
                        From its earliest days worshipping in classrooms at the Bantama Presbyterian Block 'B' School,
                        the congregation moved to a temporary auditorium as the permanent chapel took shape. The sod
                        for the chapel was cut on 1st October 1967, and by 1978 - under the ministry of Rev. M. O. Amoh -
                        the building was roofed, plastered, and membership had grown to seven hundred.
                    </p>
                    <p>
                        Bantama was elevated to District status on 12th March 1978, and continued to extend its
                        reach, planting outstations across Kumasi and beyond. Manses and an administrative office
                        were subsequently built to support the growing work of ministry.
                    </p>
                    <p>
                        Today, we continue to honour the legacy of our founders and of Rev. Ernst Peyer by maintaining
                        a commitment to holistic ministry - education, discipleship, evangelism, and community service -
                        always seeking to be the hands and feet of Christ in Bantama, Kumasi, and beyond.
                    </p>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 gap-6 mt-10">
                    <div class="bg-gradient-to-br from-pcg-red-500 to-pcg-red-700 p-6 rounded-2xl shadow-lg text-center text-white">
                        <p class="text-4xl font-bold mb-2 tabular-nums" data-count-to="65" data-count-suffix="+">65+</p>
                        <p class="font-semibold">Years of Service</p>
                    </div>
                    <div class="bg-gradient-to-br from-pcg-blue-500 to-pcg-blue-700 p-6 rounded-2xl shadow-lg text-center text-white">
                        <p class="text-4xl font-bold mb-2 tabular-nums" data-count-to="5000" data-count-suffix="+">5,000+</p>
                        <p class="font-semibold">Members</p>
                    </div>
                    <div class="bg-gradient-to-br from-pcg-red-500 to-pcg-red-700 p-6 rounded-2xl shadow-lg text-center text-white">
                        <p class="text-4xl font-bold mb-2 tabular-nums" data-count-to="15" data-count-suffix="+">15+</p>
                        <p class="font-semibold">Ministries</p>
                    </div>
                    <div class="bg-gradient-to-br from-pcg-blue-500 to-pcg-blue-700 p-6 rounded-2xl shadow-lg text-center text-white">
                        <p class="text-4xl font-bold mb-2 tabular-nums" data-count-to="20" data-count-suffix="+">20+</p>
                        <p class="font-semibold">Pastors Served</p>
                    </div>
                </div>
            </div>
            <div class="relative h-[420px] lg:h-[560px] rounded-3xl overflow-hidden shadow-2xl group">
                <img src="{{ asset('images/bantama/session.jpg') }}" alt="The Session of Peyer Memorial Congregation" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/70 to-transparent"></div>
                <div class="absolute bottom-8 left-8 right-8 text-white">
                    <p class="text-3xl font-bold text-shadow-lg">The Session</p>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Motto Section -->
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/bantama/choir.jpg') }}" alt="The Church Choir" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 to-pcg-red-900/95"></div>
    </div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">

        <h2 class="text-4xl md:text-6xl font-bold mb-6 text-shadow-lg">Our Motto</h2>
        <p class="text-3xl md:text-4xl font-bold mb-8 text-pcg-red-300 italic">"That They All May Be"</p>
        <div class="w-24 h-1 bg-white mx-auto mb-8"></div>
        <p class="text-xl md:text-2xl leading-relaxed max-w-3xl mx-auto mb-12">
            Drawn from Jesus' prayer in John 17:21, our motto reflects our commitment to unity,
            inclusivity, and working together for God's kingdom. We believe in breaking down barriers
            and demonstrating Christ's love to all people.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12 text-left">

    </div>
</section>

<!-- Looking to the Future Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="site">
        <div class="bg-gradient-to-br from-pcg-blue-900 to-pcg-red-900 rounded-3xl overflow-hidden shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="p-12 lg:p-16 text-white">
                    <div class="decorative-line mb-8"></div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Looking to the Future</h2>
                    <div class="space-y-6 text-lg leading-relaxed">
                        <p>
                            As we look to the future, we remain committed to the vision that our founding fathers and
                            Rev. Ernst Peyer planted in this community. We continue to be a beacon of hope, a center
                            of worship, and a force for positive change in Bantama, Kumasi, and beyond.
                        </p>
                        <p>
                            Our history inspires us, but our future excites us as we trust God to do
                            even greater things through this congregation. We are expanding our ministries, reaching new
                            generations, and deepening our impact in the community.
                        </p>
                        <p>
                            We invite you to become part of our ongoing story. Together, we can continue to build on the strong
                            foundation laid by our forebears and create a legacy of faith for future generations.
                        </p>
                    </div>
                    <a href="{{ route('contact') }}" class="inline-block mt-8 bg-white text-pcg-blue-900 px-8 py-4 rounded-full font-bold hover:bg-gray-100 transition duration-300 shadow-lg">
                        Join Our Journey
                    </a>
                </div>
                <div class="relative h-64 lg:h-auto">
                    <img src="{{ asset('images/bantama/yaf.jpg') }}" alt="Young Adult Fellowship" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/50 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
