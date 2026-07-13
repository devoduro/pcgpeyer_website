<?php $__env->startSection('title', 'Videos'); ?>
<?php $__env->startSection('page-title', 'Video Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">All Videos</h2>
        <p class="text-gray-600 mt-1">Manage your video content</p>
    </div>
    <a href="<?php echo e(route('dashboard.videos.create')); ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
        <i class="fas fa-plus mr-2"></i> Add New Video
    </a>
</div>

<!-- Search and Filter -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form method="GET" action="<?php echo e(route('dashboard.videos.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search videos..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
            <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option value="">All Categories</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat); ?>" <?php echo e(request('category') == $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        
        <div class="flex items-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300 mr-2">
                <i class="fas fa-search mr-2"></i> Search
            </button>
            <a href="<?php echo e(route('dashboard.videos.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-redo mr-2"></i> Reset
            </a>
        </div>
    </form>
</div>

<!-- Videos Grid -->
<?php if($videos->count() > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <!-- Video Thumbnail -->
            <div class="relative h-48 bg-gray-200">
                <img src="<?php echo e($video->thumbnail_url); ?>" alt="<?php echo e($video->title); ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                    <a href="<?php echo e(route('dashboard.videos.show', $video)); ?>" class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-600 hover:text-white transition duration-300">
                        <i class="fas fa-eye mr-2"></i> View
                    </a>
                </div>
                
                <!-- Status Badges -->
                <div class="absolute top-2 left-2 flex gap-2">
                    <?php if($video->featured): ?>
                        <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs font-bold">
                            <i class="fas fa-star"></i> Featured
                        </span>
                    <?php endif; ?>
                    <?php if($video->published): ?>
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold">
                            <i class="fas fa-check"></i> Published
                        </span>
                    <?php else: ?>
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">
                            <i class="fas fa-times"></i> Draft
                        </span>
                    <?php endif; ?>
                </div>
                
                <!-- Video Type Badge -->
                <div class="absolute top-2 right-2">
                    <span class="bg-indigo-600 text-white px-2 py-1 rounded text-xs font-bold uppercase">
                        <?php echo e($video->video_type); ?>

                    </span>
                </div>
            </div>
            
            <!-- Video Info -->
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2"><?php echo e($video->title); ?></h3>
                
                <?php if($video->category): ?>
                    <span class="inline-block bg-indigo-100 text-indigo-800 px-2 py-1 rounded text-xs font-semibold mb-2">
                        <i class="fas fa-folder mr-1"></i><?php echo e($video->category); ?>

                    </span>
                <?php endif; ?>
                
                <?php if($video->description): ?>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?php echo e($video->description); ?></p>
                <?php endif; ?>
                
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span>
                        <i class="far fa-calendar mr-1"></i>
                        <?php echo e($video->created_at->format('M d, Y')); ?>

                    </span>
                    <?php if($video->views > 0): ?>
                        <span>
                            <i class="fas fa-eye mr-1"></i>
                            <?php echo e(number_format($video->views)); ?> views
                        </span>
                    <?php endif; ?>
                </div>
                
                <!-- Actions -->
                <div class="flex gap-2">
                    <a href="<?php echo e(route('dashboard.videos.edit', $video)); ?>" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-center font-semibold transition duration-300">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    
                    <form action="<?php echo e(route('dashboard.videos.toggle-published', $video)); ?>" method="POST" class="flex-1">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full bg-<?php echo e($video->published ? 'yellow' : 'green'); ?>-600 hover:bg-<?php echo e($video->published ? 'yellow' : 'green'); ?>-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-300">
                            <i class="fas fa-<?php echo e($video->published ? 'eye-slash' : 'check'); ?>"></i>
                        </button>
                    </form>
                    
                    <form action="<?php echo e(route('dashboard.videos.destroy', $video)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-300">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    <!-- Pagination -->
    <?php if($videos->hasPages()): ?>
        <div class="mt-8">
            <?php echo e($videos->links()); ?>

        </div>
    <?php endif; ?>
<?php else: ?>
    <!-- Empty State -->
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <i class="fas fa-video text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-700 mb-2">No Videos Found</h3>
        <p class="text-gray-500 mb-6">Get started by adding your first video.</p>
        <a href="<?php echo e(route('dashboard.videos.create')); ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Video
        </a>
    </div>
<?php endif; ?>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/video/index.blade.php ENDPATH**/ ?>