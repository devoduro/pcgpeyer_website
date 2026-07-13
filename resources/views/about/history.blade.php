@extends('layouts.app')

@section('title', 'Brief History - PCG Monninger Congregation')

@section('content')
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=1920&h=600&fit=crop" alt="Church History" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-blue-900/90 to-pcg-red-900/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
     
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg">Our Rich History</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto">The Legacy of Rev. Friedrich Monninger</p>
        <div class="w-24 h-1 bg-pcg-red-400 mx-auto"></div>
    </div>
</section>

<!-- Introduction Section with Image -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="decorative-line mb-8"></div>
                <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">Our Foundation Story</h2>
                <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                    <p>
                        The Presbyterian Church of Ghana, Monninger Congregation, stands as a testament to the dedication 
                        and vision of Rev. Friedrich Monninger, a German missionary who devoted his life to spreading the 
                        Gospel in Ghana.
                    </p>
                    <p>
                        Our congregation was established in Akosombo, a town known for its hydroelectric dam 
                        and beautiful landscapes along the Volta River. The church became a spiritual home for workers 
                        and residents of this growing community.
                    </p>
                    <p>
                        Rev. Monninger arrived in Ghana during the early missionary period, bringing with him not just the 
                        message of salvation, but also a heart for community development and education. His work laid the 
                        foundation for what would become one of the most vibrant Presbyterian congregations in the Eastern Region.
                    </p>
                </div>
            </div>
            <div class="relative">
                <div class="relative h-[500px] rounded-3xl overflow-hidden shadow-2xl group">
                    <img src="{{ asset('storage/images/auditorious.jpg') }}" alt="Church Foundation" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/80 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8 text-white">
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rev. Monninger's Legacy Section -->
<section class="py-20 bg-gradient-to-br from-pcg-blue-50 to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="decorative-line"></div>
            <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">Rev. Friedrich Monninger</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">A Pioneer of Faith and Service</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="relative h-[500px] rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('storage/images/revmonninger.jpeg') }}" alt="Rev. Monninger Legacy" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8 text-white">
                        <p class="text-3xl font-bold text-shadow-lg">Rev. Friedrich Monninger Wilhelm</p>
                        <p class="text-xl text-shadow">(1870–1895)</p>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <div class="bg-white p-10 rounded-3xl shadow-xl">
                    <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                        <p>
                            Rev. Friedrich Monninger was more than a missionary; he was a builder of communities and a shepherd 
                            of souls. His approach to ministry was holistic, addressing both spiritual and physical needs of the people.
                        </p>
                        <p>
                            He established schools, health centers, and agricultural programs alongside the church, 
                            demonstrating that the Gospel transforms every aspect of life. His legacy continues to inspire 
                            our congregation's commitment to comprehensive ministry.
                        </p>
                        <blockquote class="border-l-4 border-pcg-red-600 pl-6 py-4 my-8 bg-pcg-red-50 rounded-r-lg">
                            <p class="italic text-xl text-gray-800 mb-2">
                                "The work of the Gospel is not complete until it touches every part of human existence - 
                                spiritual, physical, educational, and social."
                            </p>
                            <footer class="text-base text-gray-600">- Rev. Friedrich Monninger</footer>
                        </blockquote>
                        <p>
                            His dedication to the people of Ghana and his unwavering faith in God's calling left an indelible 
                            mark on our community that continues to shape our ministry today.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Growth & Development Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="decorative-line mb-8"></div>
                <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">Growth & Development</h2>
                <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                    <p>
                        Over the decades, the Monninger Congregation has grown from a small gathering of believers to a 
                        thriving church community. The congregation has been blessed with faithful leaders, dedicated members, 
                        and a clear vision for ministry.
                    </p>
                    <p>
                        We have expanded our facilities, increased our programs, and deepened 
                        our impact in Akosombo and surrounding areas. From humble beginnings, we have become a beacon 
                        of hope and transformation in the Eastern Region.
                    </p>
                    <p>
                        Today, we continue to honor Rev. Monninger's legacy by maintaining his commitment to holistic ministry. 
                        Our church is actively involved in education, healthcare, youth development, and community service, 
                        always seeking to be the hands and feet of Christ in our community.
                    </p>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 gap-6 mt-10">
                    <div class="bg-gradient-to-br from-pcg-red-500 to-pcg-red-700 p-6 rounded-2xl shadow-lg text-center text-white">
                        <p class="text-4xl font-bold mb-2">60+</p>
                        <p class="font-semibold">Years of Service</p>
                    </div>
                    <div class="bg-gradient-to-br from-pcg-blue-500 to-pcg-blue-700 p-6 rounded-2xl shadow-lg text-center text-white">
                        <p class="text-4xl font-bold mb-2">500+</p>
                        <p class="font-semibold">Active Members</p>
                    </div>
                    <div class="bg-gradient-to-br from-pcg-red-500 to-pcg-red-700 p-6 rounded-2xl shadow-lg text-center text-white">
                        <p class="text-4xl font-bold mb-2">15+</p>
                        <p class="font-semibold">Ministries</p>
                    </div>
                    <div class="bg-gradient-to-br from-pcg-blue-500 to-pcg-blue-700 p-6 rounded-2xl shadow-lg text-center text-white">
                        <p class="text-4xl font-bold mb-2">20+</p>
                        <p class="font-semibold">Pastors Served</p>
                    </div>
                </div>
            </div>
            <div class="relative h-[900px] rounded-3xl overflow-hidden shadow-2xl group">
                <img src="{{ asset('storage/images/manse.png') }}" alt="Church Growth" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/70 to-transparent"></div>
                <div class="absolute bottom-8 left-8 right-8 text-white">
                    <p class="text-3xl font-bold text-shadow-lg">Church Manse</p>
 
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Motto Section -->
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1507692049790-de58290a4334?w=1920&h=800&fit=crop" alt="Unity" class="w-full h-full object-cover">
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-pcg-blue-900 to-pcg-red-900 rounded-3xl overflow-hidden shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="p-12 lg:p-16 text-white">
                    <div class="decorative-line mb-8"></div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Looking to the Future</h2>
                    <div class="space-y-6 text-lg leading-relaxed">
                        <p>
                            As we look to the future, we remain committed to the vision that Rev. Monninger planted in this 
                            community. We continue to be a beacon of hope, a center of worship, and a force for positive change 
                            in Akosombo and beyond.
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
                    <img src="{{ asset('storage/images/future.png') }}" alt="Future Vision" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/50 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section 
<section class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center text-pcg-blue-900 mb-16">Our Journey Through Time</h2>
        
        <div class="space-y-12">
            <div class="flex items-start">
                <div class="flex-shrink-0 w-32 text-right pr-8">
                    <span class="text-2xl font-bold text-pcg-red-600">Early 1900s</span>
                </div>
                <div class="flex-shrink-0 w-4 h-4 rounded-full bg-pcg-blue-600 mt-2"></div>
                <div class="flex-grow pl-8">
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-2">Foundation</h3>
                    <p class="text-gray-700">Rev. Friedrich Monninger arrives in Ghana and begins missionary work.</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0 w-32 text-right pr-8">
                    <span class="text-2xl font-bold text-pcg-red-600">1950s</span>
                </div>
                <div class="flex-shrink-0 w-4 h-4 rounded-full bg-pcg-blue-600 mt-2"></div>
                <div class="flex-grow pl-8">
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-2">Establishment</h3>
                    <p class="text-gray-700">Formal establishment of the Monninger Congregation in Akosombo.</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0 w-32 text-right pr-8">
                    <span class="text-2xl font-bold text-pcg-red-600">1970s-1980s</span>
                </div>
                <div class="flex-shrink-0 w-4 h-4 rounded-full bg-pcg-blue-600 mt-2"></div>
                <div class="flex-grow pl-8">
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-2">Growth Period</h3>
                    <p class="text-gray-700">Significant growth in membership and expansion of church facilities.</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0 w-32 text-right pr-8">
                    <span class="text-2xl font-bold text-pcg-red-600">2000s</span>
                </div>
                <div class="flex-shrink-0 w-4 h-4 rounded-full bg-pcg-blue-600 mt-2"></div>
                <div class="flex-grow pl-8">
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-2">Modernization</h3>
                    <p class="text-gray-700">Introduction of modern programs and technology in ministry.</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0 w-32 text-right pr-8">
                    <span class="text-2xl font-bold text-pcg-red-600">Present</span>
                </div>
                <div class="flex-shrink-0 w-4 h-4 rounded-full bg-pcg-red-600 mt-2"></div>
                <div class="flex-grow pl-8">
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-2">Continued Impact</h3>
                    <p class="text-gray-700">Thriving congregation serving Akosombo and beyond with excellence.</p>
                </div>
            </div>
        </div>
    </div>
</section> -->
@endsection
