<?php $__env->startSection('title', 'Inter-Generational Groups - PCG Monninger Congregation'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=1920&h=600&fit=crop" alt="Inter-Generational" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-red-900/90 to-pcg-blue-900/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">Inter-Generational Groups</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">Bringing All Ages Together in Fellowship & Service</p>
        <div class="w-24 h-1 bg-pcg-red-400 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<!-- Introduction -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="decorative-line"></div>
            <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">United Across Generations</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Our inter-generational ministries create opportunities for members of all ages to worship, serve, and grow together. 
                Experience the richness of multi-generational fellowship as we build God's kingdom together.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php $__currentLoopData = $ministries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ministry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- <?php echo e($ministry->name); ?> -->
            <div class="group" data-aos="fade-up" data-aos-delay="<?php echo e(($index + 1) * 100); ?>">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-3">
                    <div class="relative h-72 overflow-hidden">
                        <img src="<?php echo e(asset('storage/' . $ministry->image)); ?>" alt="<?php echo e($ministry->name); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-900/90 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                           
                        </div>
                    </div>
                    <div class="p-8">
                        <?php if($ministry->ministry_category): ?>
                            <span class="inline-block bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-100 text-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-800 px-3 py-1 rounded-full text-xs font-bold mb-3">
                                <?php echo e($ministry->ministry_category); ?>

                            </span>
                        <?php endif; ?>
                        <h3 class="text-3xl font-bold text-pcg-blue-900 mb-4"><?php echo e($ministry->name); ?></h3>
                        <p class="text-gray-700 mb-6 leading-relaxed"><?php echo e($ministry->description); ?></p>
                        <?php if($ministry->meeting_schedule): ?>
                        <div class="flex items-center text-gray-600 bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-50 p-3 rounded-lg hover:bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-100 transition duration-300 mb-3">
                            <svg class="w-5 h-5 mr-3 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span><strong>Meeting Day & Time:</strong> <?php echo e($ministry->meeting_schedule); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="space-y-3 mb-6">
                            <?php if($ministry->leader): ?>
                            <div class="flex items-center text-gray-600 bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-50 p-3 rounded-lg hover:bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-100 transition duration-300">
                                <svg class="w-5 h-5 mr-3 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span><strong>Leader:</strong> <?php echo e($ministry->leader); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($ministry->leader_phone): ?>
                            <div class="flex items-center text-gray-600 bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-50 p-3 rounded-lg hover:bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-100 transition duration-300">
                                <svg class="w-5 h-5 mr-3 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span><strong>Phone:</strong> <?php echo e($ministry->leader_phone); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($ministry->location): ?>
                            <div class="flex items-center text-gray-600 bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-50 p-3 rounded-lg hover:bg-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-100 transition duration-300">
                                <svg class="w-5 h-5 mr-3 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <span><strong>Location:</strong> <?php echo e($ministry->location); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('ministries.show', $ministry->slug)); ?>" class="inline-block bg-gradient-to-r from-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-600 to-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-700 text-white px-6 py-3 rounded-full font-semibold hover:from-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-700 hover:to-<?php echo e($index % 2 == 0 ? 'pcg-blue' : 'pcg-red'); ?>-800 transition duration-300 shadow-lg hover:shadow-xl">Learn More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-br from-pcg-blue-900 to-pcg-red-900 text-white relative overflow-hidden" data-aos="fade-up">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-pcg-red-500 rounded-full filter blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="icon-circle-lg bg-white/20 backdrop-blur-lg border-2 border-white/30 mx-auto mb-8" data-aos="zoom-in">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up" data-aos-delay="100">Get Involved Today</h2>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            Join one of our inter-generational ministries and experience the joy of serving together 
            with believers of all ages. Everyone has a place in God's family!
        </p>
        <a href="<?php echo e(route('contact')); ?>" class="inline-block bg-white text-pcg-blue-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition duration-300 shadow-2xl hover:shadow-3xl hover:scale-105" data-aos="zoom-in" data-aos-delay="300">Contact Us Today</a>
    </div>
</section>

<section class="py-24 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="decorative-line"></div>
            <h2 class="section-title">PCG Age Groups</h2>
            <p class="section-subtitle">Discover ministries for every stage of life</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $generationalMinistries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ministry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo e(($index + 1) * 50); ?>">
                <div class="h-56 relative">
                    <img src="<?php echo e(asset('storage/' . $ministry->image)); ?>" class="w-full h-full object-cover" alt="<?php echo e($ministry->name); ?>">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-pcg-blue-900"><?php echo e($ministry->name); ?></h3>
                    <?php if($ministry->age_range): ?>
                    <p class="text-sm text-gray-600"><strong>Ages:</strong> <?php echo e($ministry->age_range); ?></p>
                    <?php endif; ?>
                    <?php if($ministry->meeting_schedule): ?>
                    <p class="text-sm text-gray-600 mb-4"><strong>Time:</strong> <?php echo e($ministry->meeting_schedule); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo e(route('ministries.show', $ministry->slug)); ?>" class="btn-outline">Learn More</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Custom animations */
    @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    @keyframes expand {
        from {
            width: 0;
        }
        to {
            width: 6rem;
        }
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    .animate-expand {
        animation: expand 1s ease-out forwards;
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/ministries/inter-generational.blade.php ENDPATH**/ ?>