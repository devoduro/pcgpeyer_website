<!-- Our Videos Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-600 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-pcg-blue-600 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-block">
                <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider mb-2 block">Watch & Learn</span>
                <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-4">Our Videos</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-600 to-pcg-blue-600 mx-auto"></div>
            </div>
            <p class="text-xl text-gray-600 mt-4">Experience our services, events, and testimonies</p>
        </div>

        <?php if(isset($latestVideos) && $latestVideos->count() > 0): ?>
            <!-- Videos Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $latestVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($video->video_url); ?>" target="_blank" 
                   class="video-card group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2"
                   data-aos="fade-up" 
                   data-aos-delay="<?php echo e(($index + 1) * 100); ?>">
            
                <!-- Video Thumbnail -->
                <div class="relative h-56 overflow-hidden bg-gray-900">
                    <img src="<?php echo e($video->thumbnail_url); ?>" 
                         alt="<?php echo e($video->title); ?>" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    
                    <!-- Play Button Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:scale-110 group-hover:bg-indigo-600 transition-all duration-300 shadow-2xl">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-indigo-600 group-hover:text-white ml-1 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Category Badge -->
                    <?php if($video->category): ?>
                        <div class="absolute top-4 right-4 bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            <?php echo e($video->category); ?>

                        </div>
                    <?php endif; ?>
                    
                    <!-- Featured Badge -->
                    <?php if($video->featured): ?>
                        <div class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            <i class="fas fa-star mr-1"></i> Featured
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Video Info -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-2 group-hover:text-indigo-600 transition-colors duration-300 line-clamp-2">
                        <?php echo e($video->title); ?>

                    </h3>
                    
                    <?php if($video->description): ?>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            <?php echo e($video->description); ?>

                        </p>
                    <?php endif; ?>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="far fa-calendar mr-2 text-indigo-600"></i>
                            <span><?php echo e($video->publish_date ? $video->publish_date->format('M d, Y') : $video->created_at->format('M d, Y')); ?></span>
                        </div>
                        <?php if($video->views > 0): ?>
                            <div class="flex items-center">
                                <i class="fas fa-eye mr-1 text-indigo-600"></i>
                                <span><?php echo e(number_format($video->views)); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Watch Now Button -->
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <span class="text-indigo-600 font-semibold group-hover:text-indigo-700 flex items-center">
                            <i class="fas fa-play-circle mr-2"></i>
                            Watch Now
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </span>
                    </div>
                </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <!-- View All Button -->
          

              <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="300">
           
              <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="500">
            <a href="<?php echo e(route('media.videos')); ?>"  class="btn-primary">Explore All Galleries</a>
        </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-16">
                <i class="fas fa-video text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No Videos Available</h3>
                <p class="text-gray-500 text-lg">Check back soon for video content from our church.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/sections/videos.blade.php ENDPATH**/ ?>