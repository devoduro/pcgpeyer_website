<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - PCG Monninger Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/loader.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/loader.png')); ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Compiled Tailwind CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/dashboard.css']); ?>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="font-poppins antialiased bg-gray-50">
    <div
        x-data="{ sidebarOpen: false, sidebarCollapsed: localStorage.getItem('dashSidebarCollapsed') === 'true' }"
        class="min-h-screen flex"
    >
        <!-- Mobile overlay -->
        <div
            x-cloak
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/40 md:hidden"
        ></div>

        <!-- Sidebar -->
        <aside
            x-cloak
            :class="{
                'translate-x-0': sidebarOpen,
                '-translate-x-full': !sidebarOpen,
                'md:w-20': sidebarCollapsed,
                'md:w-64': !sidebarCollapsed,
                'sidebar-collapsed': sidebarCollapsed,
            }"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 shadow-lg transform transition-all duration-300 ease-in-out md:translate-x-0 md:static md:shadow-none md:min-h-screen flex-shrink-0 overflow-y-auto"
        >
            <!-- Collapse toggle (desktop only) -->
            <button
                @click="sidebarCollapsed = !sidebarCollapsed; localStorage.setItem('dashSidebarCollapsed', sidebarCollapsed)"
                class="hidden md:flex absolute -right-3 top-20 w-6 h-6 items-center justify-center rounded-full bg-white border border-gray-300 shadow-sm text-gray-500 hover:text-primary-600 hover:border-primary-300 transition-colors z-10"
                :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'"
            >
                <i class="fas text-[10px]" :class="sidebarCollapsed ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
            </button>

            <!-- Logo -->
            <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200 overflow-hidden">
                <h1 class="text-xl font-bold gradient-text whitespace-nowrap flex items-center gap-2" x-show="!sidebarCollapsed" x-cloak>
                    <i class="fas fa-church text-primary-600"></i> PCG Admin
                </h1>
                <div class="w-9 h-9 rounded-lg gradient-bg flex items-center justify-center text-white font-bold text-sm flex-shrink-0" x-show="sidebarCollapsed" x-cloak>PCG</div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <a href="<?php echo e(route('dashboard.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.index') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>

                <?php if(auth()->user()->isEditor()): ?>
                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-gray-400" x-show="!sidebarCollapsed" x-cloak>Content</p>

                <a href="<?php echo e(route('dashboard.blog.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.blog.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>News / Blog</span>
                </a>

                <a href="<?php echo e(route('dashboard.sermons.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.sermons.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-bible w-5"></i>
                    <span>Sermons</span>
                </a>

                <a href="<?php echo e(route('dashboard.ministries.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.ministries.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-hands-praying w-5"></i>
                    <span>Ministries</span>
                </a>

                <a href="<?php echo e(route('dashboard.events.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.events.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-calendar-days w-5"></i>
                    <span>Events</span>
                </a>

                <a href="<?php echo e(route('dashboard.galleries.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.galleries.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-images w-5"></i>
                    <span>Gallery</span>
                </a>

                <a href="<?php echo e(route('dashboard.videos.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.videos.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-video w-5"></i>
                    <span>Videos</span>
                </a>

                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-gray-400" x-show="!sidebarCollapsed" x-cloak>Leadership</p>

                <div x-data="{ open: <?php echo e(request()->routeIs('dashboard.leadership.*') || request()->routeIs('dashboard.group-leadership.*') ? 'true' : 'false'); ?> }">
                    <button @click="open = !open" class="w-full flex items-center justify-between gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.leadership.*') || request()->routeIs('dashboard.group-leadership.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-user-tie w-5"></i>
                            <span>Leadership</span>
                        </span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-transition class="pl-8 space-y-1">
                        <a href="<?php echo e(route('dashboard.leadership.index')); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.leadership.index') || request()->routeIs('dashboard.leadership.create') || request()->routeIs('dashboard.leadership.edit') ? 'text-primary-600 font-medium' : ''); ?>">
                            Leadership Members
                        </a>
                        <a href="<?php echo e(route('dashboard.group-leadership.index')); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.group-leadership.*') ? 'text-primary-600 font-medium' : ''); ?>">
                            Group Leaders
                        </a>
                        <a href="<?php echo e(route('dashboard.leadership.manage-years')); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.leadership.manage-years') ? 'text-primary-600 font-medium' : ''); ?>">
                            Manage Years
                        </a>
                        <a href="<?php echo e(route('dashboard.leadership.manage-titles')); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.leadership.manage-titles') ? 'text-primary-600 font-medium' : ''); ?>">
                            Manage Titles
                        </a>
                    </div>
                </div>

                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-gray-400" x-show="!sidebarCollapsed" x-cloak>Communications</p>

                <a href="<?php echo e(route('dashboard.prayer-requests.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.prayer-requests.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-hands w-5"></i>
                    <span>Prayer Requests</span>
                    <?php $unansweredPrayers = \App\Models\PrayerRequest::unanswered()->count(); ?>
                    <?php if($unansweredPrayers > 0): ?>
                        <span class="ml-auto bg-primary-600 text-white text-xs font-bold px-2 py-0.5 rounded-full" x-show="!sidebarCollapsed" x-cloak><?php echo e($unansweredPrayers); ?></span>
                    <?php endif; ?>
                </a>

                <a href="<?php echo e(route('dashboard.contact.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.contact.*') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-envelope w-5"></i>
                    <span>Contact Submissions</span>
                    <?php $newContacts = \App\Models\ContactSubmission::unread()->count(); ?>
                    <?php if($newContacts > 0): ?>
                        <span class="ml-auto bg-primary-600 text-white text-xs font-bold px-2 py-0.5 rounded-full" x-show="!sidebarCollapsed" x-cloak><?php echo e($newContacts); ?></span>
                    <?php endif; ?>
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->isAdmin()): ?>
                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-gray-400" x-show="!sidebarCollapsed" x-cloak>Administration</p>

                <a href="<?php echo e(route('dashboard.users.index')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.users.index') || request()->routeIs('dashboard.users.create') || request()->routeIs('dashboard.users.edit') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-users-cog w-5"></i>
                    <span>Users</span>
                </a>

                <a href="<?php echo e(route('dashboard.users.logs')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.users.logs') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-history w-5"></i>
                    <span>Activity Logs</span>
                </a>
                <?php endif; ?>

                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-gray-400" x-show="!sidebarCollapsed" x-cloak>Account</p>

                <a href="<?php echo e(route('dashboard.profile')); ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg <?php echo e(request()->routeIs('dashboard.profile') ? 'bg-primary-50 text-primary-600 font-medium' : ''); ?>">
                    <i class="fas fa-user w-5"></i>
                    <span>Profile</span>
                </a>

                <form method="POST" action="<?php echo e(route('dashboard.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-gray-600 transition-all duration-200 hover:bg-red-50 hover:text-red-600 rounded-lg">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between h-14 px-4 md:px-6">
                    <!-- Mobile Menu Button -->
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="text-gray-600 md:hidden focus:outline-none"
                    >
                        <i class="fas fa-bars text-lg"></i>
                    </button>

                    <!-- Page Title - Mobile -->
                    <div class="md:hidden font-semibold text-lg text-gray-800">
                        <?php echo $__env->yieldContent('page-title', 'Dashboard'); ?>
                    </div>

                    <!-- Search -->
                    <div class="hidden md:flex md:flex-1 md:max-w-md">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input
                                type="text"
                                class="w-full py-2 pl-10 pr-4 text-sm text-gray-700 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-primary-500 focus:outline-none"
                                placeholder="Search..."
                            >
                        </div>
                    </div>

                    <!-- Right Navigation -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <?php if(auth()->user()->isEditor()): ?>
                        <div x-data="{ open: false }" class="relative">
                            <button
                                @click="open = !open"
                                class="relative p-2 text-gray-600 transition-colors duration-200 rounded-full hover:bg-gray-100 hover:text-primary-600 focus:outline-none"
                            >
                                <i class="fas fa-bell"></i>
                                <?php $notifCount = $unansweredPrayers + $newContacts; ?>
                                <?php if($notifCount > 0): ?>
                                    <span class="absolute -top-0.5 -right-0.5 w-4 h-4 flex items-center justify-center bg-red-500 text-white text-[10px] font-bold rounded-full"><?php echo e($notifCount > 9 ? '9+' : $notifCount); ?></span>
                                <?php endif; ?>
                            </button>

                            <div
                                x-show="open"
                                @click.away="open = false"
                                x-transition
                                x-cloak
                                class="absolute right-0 z-10 w-80 mt-2 origin-top-right bg-white border border-gray-200 rounded-lg shadow-lg"
                            >
                                <div class="p-3 border-b border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-700">Notifications</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto divide-y divide-gray-100">
                                    <?php if($newContacts > 0): ?>
                                        <a href="<?php echo e(route('dashboard.contact.index')); ?>" class="block p-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-envelope text-primary-500 mr-2"></i>
                                            <?php echo e($newContacts); ?> new contact <?php echo e(Str::plural('submission', $newContacts)); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if($unansweredPrayers > 0): ?>
                                        <a href="<?php echo e(route('dashboard.prayer-requests.index')); ?>" class="block p-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-hands text-primary-500 mr-2"></i>
                                            <?php echo e($unansweredPrayers); ?> unanswered prayer <?php echo e(Str::plural('request', $unansweredPrayers)); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if($notifCount === 0): ?>
                                        <div class="p-4 text-sm text-gray-500">No new notifications</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- User Menu -->
                        <div x-data="{ open: false }" class="relative">
                            <button
                                @click="open = !open"
                                class="flex items-center space-x-2 focus:outline-none"
                            >
                                <div class="w-8 h-8 overflow-hidden rounded-full gradient-bg flex items-center justify-center text-white font-bold text-sm">
                                    <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                                </div>
                                <span class="hidden md:block text-sm font-medium text-gray-700"><?php echo e(auth()->user()->name); ?></span>
                                <i class="hidden md:block fas fa-chevron-down text-xs text-gray-400"></i>
                            </button>

                            <div
                                x-show="open"
                                @click.away="open = false"
                                x-transition
                                x-cloak
                                class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-white border border-gray-200 rounded-lg shadow-lg"
                            >
                                <div class="p-2">
                                    <a href="<?php echo e(route('dashboard.profile')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-600 rounded-md">
                                        <i class="fas fa-user-circle mr-2"></i> Profile
                                    </a>
                                    <hr class="my-1 border-gray-200">
                                    <form method="POST" action="<?php echo e(route('dashboard.logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-600 rounded-md">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 flex flex-col px-4 md:px-8 py-6">
                <!-- Alerts -->
                <?php if($errors->any()): ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg animate-fade-in">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Errors occurred:</strong>
                    <ul class="mt-2 ml-4 list-disc">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if(session()->has('success')): ?>
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 p-3 bg-green-50 border-l-4 border-green-500 text-green-700 flex justify-between items-center rounded-r-lg animate-fade-in">
                    <div>
                        <i class="fas fa-check-circle mr-2"></i>
                        <?php echo e(session('success')); ?>

                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <?php endif; ?>

                <?php if(session()->has('error')): ?>
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 flex justify-between items-center rounded-r-lg animate-fade-in">
                    <div>
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?php echo e(session('error')); ?>

                    </div>
                    <button @click="show = false" class="text-red-700 hover:text-red-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <?php endif; ?>

                <!-- Page Header -->
                <div class="mb-2">
                    <h1 class="text-2xl font-bold text-gray-800"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                </div>

                <!-- Content -->
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <!-- Footer -->
            <footer class="py-4 px-6 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-500">
                        &copy; <?php echo e(date('Y')); ?> PCG Monninger Congregation. All rights reserved.
                    </p>
                    <div class="mt-2 md:mt-0">
                        <a href="<?php echo e(route('home')); ?>" class="text-sm text-gray-500 hover:text-primary-600">View Public Site</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/layouts/app.blade.php ENDPATH**/ ?>