<?php $__env->startSection('title', 'Videos - PCG Monninger Congregation'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?w=1920&h=600&fit=crop" alt="Video Gallery" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-blue-800/90 to-pcg-blue-900/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="icon-circle-lg bg-white/20 backdrop-blur-lg border-2 border-white/30 mx-auto mb-8 animate-bounce-slow">
            <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z"/>
            </svg>
        </div>
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">Video Gallery</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">Watch Sermons, Events & Testimonies</p>
        <div class="w-24 h-1 bg-pcg-blue-400 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<!-- Category Filter -->
<?php if($categories->count() > 0): ?>
<section class="py-8 bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-3" data-aos="fade-up">
            <a href="<?php echo e(route('media.videos')); ?>" 
               class="px-6 py-3 rounded-full font-semibold transition duration-300 shadow-md <?php echo e(!request('category') ? 'bg-pcg-blue-600 text-white' : 'bg-white text-pcg-blue-900 hover:bg-pcg-blue-50'); ?>">
                <i class="fas fa-video mr-2"></i>All Videos
            </a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $isSermonCat = strtolower($cat) === 'sermons'; ?>
                <a href="<?php echo e(route('media.videos', ['category' => $cat])); ?>"
                   class="px-6 py-3 rounded-full font-semibold transition duration-300 shadow-md <?php echo e(request('category') == $cat ? ($isSermonCat ? 'bg-pcg-gold-500 text-white' : 'bg-pcg-blue-600 text-white') : ($isSermonCat ? 'bg-white text-pcg-gold-700 hover:bg-pcg-gold-50' : 'bg-white text-pcg-blue-900 hover:bg-pcg-blue-50')); ?>">
                    <i class="<?php echo e($isSermonCat ? 'fas fa-bible' : 'fas fa-folder'); ?> mr-2"></i><?php echo e($cat); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Video Gallery Grid -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if($videos->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($video->video_url); ?>" target="_blank" class="group cursor-pointer block" data-aos="fade-up" data-aos-delay="<?php echo e((($index % 3) + 1) * 100); ?>">
                    <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                        <div class="relative h-56 overflow-hidden">
                            <img src="<?php echo e($video->thumbnail_url); ?>" alt="<?php echo e($video->title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            
                            <!-- Play Button Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-20 h-20 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:scale-110 group-hover:bg-pcg-blue-600 transition-all duration-300 shadow-2xl">
                                    <svg class="w-10 h-10 text-pcg-blue-900 group-hover:text-white ml-1 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Category Badge -->
                            <?php if($video->category): ?>
                                <?php $isSermon = strtolower($video->category) === 'sermons'; ?>
                                <div class="absolute top-4 right-4 flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold shadow-lg <?php echo e($isSermon ? 'bg-pcg-gold-500 text-white' : 'bg-pcg-red-600 text-white'); ?>">
                                    <?php if($isSermon): ?>
                                        <i class="fas fa-bible"></i>
                                    <?php endif; ?>
                                    <?php echo e($video->category); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-pcg-blue-900 mb-2 group-hover:text-pcg-blue-700 transition-colors duration-300 line-clamp-2"><?php echo e($video->title); ?></h3>
                            <?php if($video->description): ?>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?php echo e($video->description); ?></p>
                            <?php endif; ?>
                            <div class="flex items-center justify-between text-gray-500 text-sm">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span><?php echo e($video->publish_date ? $video->publish_date->format('M Y') : $video->created_at->format('M Y')); ?></span>
                                </div>
                                <?php if($video->views > 0): ?>
                                    <div class="flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span><?php echo e(number_format($video->views)); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <!-- Pagination -->
            <?php if($videos->hasPages()): ?>
                <div class="mt-16">
                    <?php echo e($videos->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-20">
                <i class="fas fa-video text-8xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-4">No Videos Yet</h3>
                <p class="text-gray-500 text-lg">Check back soon for video content from our church.</p>
            </div>
        <?php endif; ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/media/videos.blade.php ENDPATH**/ ?>