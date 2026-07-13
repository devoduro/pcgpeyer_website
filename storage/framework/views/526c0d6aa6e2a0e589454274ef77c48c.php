<?php $__env->startSection('title', 'Roll of Ministers - PCG Monninger Congregation'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero -->
<section class="relative h-[60vh] min-h-[500px] flex items-center justify-center overflow-hidden bg-gradient-to-br from-pcg-blue-700 to-pcg-blue-900">
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-pcg-red-500 rounded-full filter blur-3xl"></div>
    </div>
    <div class="relative z-10 text-center text-white px-4" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Roll of Ministers</h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
            Honoring those who have faithfully served the Monninger Congregation
            <?php if($stats['earliest_year']): ?> since <?php echo e($stats['earliest_year']); ?> <?php endif; ?>
        </p>
    </div>
</section>

<!-- Our Leadership Legacy -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Leadership Legacy</h2>
            <div class="w-20 h-0.5 bg-pcg-blue-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-4xl mx-auto mb-8">
                Since our establishment, the Monninger Congregation has been blessed with faithful shepherds who have guided us with wisdom, dedication, and love for God's people. Their service has shaped our Presbyterian identity and mission in Akosombo.
            </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-3xl font-bold text-pcg-blue-600 mb-2"><?php echo e($stats['years_of_history']); ?>+</div>
                    <div class="text-gray-700">Years of History</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-3xl font-bold text-pcg-blue-600 mb-2"><?php echo e($stats['total_ministers']); ?></div>
                    <div class="text-gray-700">Total Ministers</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-3xl font-bold text-pcg-blue-600 mb-2"><?php echo e($stats['ministers_in_charge']); ?></div>
                    <div class="text-gray-700">Ministers-in-Charge</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-3xl font-bold text-pcg-blue-600 mb-2"><?php echo e($stats['associate_ministers']); ?></div>
                    <div class="text-gray-700">Associate Ministers</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Past Ministers -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Past Ministers</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">Each minister brought unique gifts and vision to the spiritual growth and development of our congregation.</p>
        </div>

        <?php if($categories->count() > 1): ?>
            <div class="flex justify-center mb-10" data-aos="fade-up">
                <div class="inline-flex flex-wrap justify-center rounded-lg bg-gray-100 p-1 gap-1">
                    <a href="<?php echo e(route('about.ministers')); ?>"
                       class="px-4 py-2 md:px-6 md:py-3 rounded-md font-medium transition-all duration-200 text-sm md:text-base whitespace-nowrap <?php echo e(!$activeCategory ? 'bg-white text-pcg-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900'); ?>">
                        All
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('about.ministers', ['category' => $category])); ?>"
                           class="px-4 py-2 md:px-6 md:py-3 rounded-md font-medium transition-all duration-200 text-sm md:text-base whitespace-nowrap <?php echo e($activeCategory === $category ? 'bg-white text-pcg-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900'); ?>">
                            <?php echo e($category); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if($filteredMinisters->count()): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                <?php $__currentLoopData = $filteredMinisters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $minister): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group" data-aos="fade-up" data-aos-delay="<?php echo e(($loop->index % 3) * 100); ?>">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:border-pcg-blue-200 transition-all duration-300 h-full">
                            <div class="relative h-56 overflow-hidden">
                                <?php if($minister->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $minister->image)); ?>" alt="<?php echo e($minister->name); ?>"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/avatar-placeholder.png')); ?>" alt="<?php echo e($minister->name); ?>"
                                         class="w-full h-full object-cover">
                                <?php endif; ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <?php if($minister->service_duration): ?>
                                    <div class="absolute bottom-3 left-3 text-white">
                                        <div class="bg-pcg-blue-700/90 px-2 py-1 rounded text-xs font-medium"><?php echo e($minister->service_duration); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-pcg-blue-700 transition-colors duration-300"><?php echo e($minister->name); ?></h3>
                                <p class="text-pcg-blue-600 font-medium text-sm mb-1"><?php echo e($minister->displayTitle); ?></p>
                                <p class="text-gray-600 text-xs mb-3"><?php echo e($minister->yearRange); ?></p>
                                <?php if($minister->bio): ?>
                                    <p class="text-gray-700 text-xs leading-relaxed"><?php echo e(Str::limit($minister->bio, 120)); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="max-w-2xl mx-auto text-center py-12" data-aos="fade-up">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <p class="text-gray-600 text-lg">
                    <?php if($activeCategory): ?>
                        No ministers found for "<?php echo e($activeCategory); ?>".
                    <?php else: ?>
                        Past minister records will appear here once added from the dashboard.
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Current Leadership CTA -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Current Leadership</h2>
        <?php if($currentMinister): ?>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                <?php echo e($currentMinister->name); ?> now serves as our <?php echo e($currentMinister->displayTitle); ?>, continuing this legacy of faithful pastoral leadership.
            </p>
        <?php else: ?>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Meet the ministers and presbyters currently leading our congregation.
            </p>
        <?php endif; ?>
        <a href="<?php echo e(route('about.leadership')); ?>" class="inline-block bg-pcg-blue-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-pcg-blue-700 transition-colors duration-200">
            Meet Current Leaders
        </a>
    </div>
</section>

<!-- Continue the Legacy -->
<section class="py-16 bg-pcg-blue-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <h2 class="text-3xl font-bold mb-4">Continue the Legacy</h2>
        <p class="text-xl mb-8 text-white/90 max-w-2xl mx-auto">Join us as we continue building on the foundation laid by these faithful leaders.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo e(route('about.leadership')); ?>" class="inline-block bg-white text-pcg-blue-800 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200">Current Leadership</a>
            <a href="<?php echo e(route('contact')); ?>" class="inline-block bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-pcg-blue-800 transition-all duration-200">Get Involved</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/about/ministers.blade.php ENDPATH**/ ?>