<nav id="navbar" class="fixed w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-3">
                    <img id="logo-default" src="<?php echo e(asset('images/logo.png')); ?>" alt="PCG Monninger Logo" class="h-14 w-auto">
                    <img id="logo-white" src="<?php echo e(asset('images/logo-white.png')); ?>" alt="PCG Monninger Logo" class="h-14 w-auto hidden">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(request()->routeIs('home') ? 'text-pcg-red-600' : ''); ?>">
                    Home
                </a>
                
                <!-- About Us Dropdown -->
                <div class="relative group">
                    <button class="nav-link flex items-center <?php echo e(request()->routeIs('about.*') ? 'text-pcg-red-600' : ''); ?>">
                        About Us
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <div class="py-1">
                            <a href="<?php echo e(route('about.history')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Brief History</a>
                           <!--  <a href="<?php echo e(route('about.staff')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Administrative Staff</a>-->
                            <a href="<?php echo e(route('about.leadership')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Church Leadership</a>
                            <a href="<?php echo e(route('group-leadership.index')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Group Leaders</a>
                            <a href="<?php echo e(route('about.ministers')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Roll of Ministers</a>
                        </div>
                    </div>
                </div>

                <!-- Ministries Dropdown -->
                <div class="relative group">
                    <button class="nav-link flex items-center <?php echo e(request()->routeIs('ministries.*') ? 'text-pcg-red-600' : ''); ?>">
                        Ministries
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <div class="py-1">
                            <a href="<?php echo e(route('ministries.inter-generational')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Inter-Generational Groups</a>
                            <a href="<?php echo e(route('ministries.generational')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Generational Groups</a>
                        </div>
                    </div>
                </div>

                <!-- Media Dropdown -->
                <div class="relative group">
                    <button class="nav-link flex items-center <?php echo e(request()->routeIs('media.*') ? 'text-pcg-red-600' : ''); ?>">
                        Media
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <div class="py-1">
                            <a href="<?php echo e(route('media.photos')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Photos</a>
                            <a href="<?php echo e(route('media.videos')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pcg-blue-50 hover:text-pcg-red-600">Videos</a>
                        </div>
                    </div>
                </div>

                <a href="<?php echo e(route('contact')); ?>" class="nav-link <?php echo e(request()->routeIs('contact') ? 'text-pcg-red-600' : ''); ?>">
                    Contact
                </a>
                
                <a href="<?php echo e(route('news-update')); ?>" class="nav-link <?php echo e(request()->routeIs('news-update*') ? 'text-pcg-red-600' : ''); ?>">
                    News Update
                </a>
                
                   <a href="https://www.app.pcgmonninger.org/" class="nav-link <?php echo e(request()->routeIs('news-update*') ? 'text-pcg-red-600' : ''); ?>">
                  Membership
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button id="mobile-menu-button" type="button" class="text-gray-700 hover:text-pcg-red-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="<?php echo e(route('home')); ?>" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-pcg-red-600 hover:bg-gray-50 rounded-md">Home</a>
            
            <!-- About Us Mobile -->
            <div class="dropdown">
                <button class="dropdown-button w-full text-left px-3 py-2 text-base font-medium text-gray-700 hover:text-pcg-red-600 hover:bg-gray-50 rounded-md flex justify-between items-center">
                    About Us
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="mobile-dropdown-menu hidden pl-4">
                    <a href="<?php echo e(route('about.history')); ?>" class="block px-3 py-2 text-sm text-gray-600 hover:text-pcg-red-600">Brief History</a>
                   <!--  <a href="<?php echo e(route('about.staff')); ?>" class="block px-3 py-2 text-sm text-gray-600 hover:text-pcg-red-600">Administrative Staff</a> -->
                    <a href="<?php echo e(route('about.leadership')); ?>" class="block px-3 py-2 text-sm text-gray-600 hover:text-pcg-red-600">Leadership</a>
                    <a href="<?php echo e(route('about.ministers')); ?>" class="block px-3 py-2 text-sm text-gray-600 hover:text-pcg-red-600">Roll of Ministers</a>
                </div>
            </div>

            <!-- Ministries Mobile -->
            <div class="dropdown">
                <button class="dropdown-button w-full text-left px-3 py-2 text-base font-medium text-gray-700 hover:text-pcg-red-600 hover:bg-gray-50 rounded-md flex justify-between items-center">
                    Ministries
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="mobile-dropdown-menu hidden pl-4">
                    <a href="<?php echo e(route('ministries.inter-generational')); ?>" class="block px-3 py-2 text-sm text-gray-600 hover:text-pcg-red-600">Inter-Generational Groups</a>
                    <a href="<?php echo e(route('ministries.generational')); ?>" class="block px-3 py-2 text-sm text-gray-600 hover:text-pcg-red-600">Generational Groups</a>
                </div>
            </div>

            <!-- Media Mobile -->
            <div class="dropdown">
                <button class="dropdown-button w-full text-left px-3 py-2 text-base font-medium text-gray-700 hover:text-pcg-red-600 hover:bg-gray-50 rounded-md flex justify-between items-center">
                    Media
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="mobile-dropdown-menu hidden pl-4">
                    <a href="<?php echo e(route('media.photos')); ?>" class="block px-3 py-2 text-sm text-gray-600 hover:text-pcg-red-600">Photos</a>
                    <a href="<?php echo e(route('media.videos')); ?>" class="block px-3 py-2 text-sm text-gray-600 hover:text-pcg-red-600">Videos</a>
                </div>
            </div>

            <a href="<?php echo e(route('contact')); ?>" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-pcg-red-600 hover:bg-gray-50 rounded-md">Contact</a>
            <a href="<?php echo e(route('news-update')); ?>" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-pcg-red-600 hover:bg-gray-50 rounded-md">News Update</a>
               <a href="https://www.app.pcgmonninger.org/" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-pcg-red-600 hover:bg-gray-50 rounded-md">Membership</a>

        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/partials/navigation.blade.php ENDPATH**/ ?>