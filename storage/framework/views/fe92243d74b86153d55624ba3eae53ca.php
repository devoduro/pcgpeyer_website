<?php $__env->startSection('title', 'Gallery Management'); ?>
<?php $__env->startSection('page-title', 'Photo Galleries'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Galleries</h3>
    <a href="<?php echo e(route('dashboard.galleries.create')); ?>" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Create New Gallery
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php $__empty_1 = true; $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="relative h-48 bg-gray-100 overflow-hidden group">
            <?php if($gallery->thumbnail_path): ?>
                <img src="<?php echo e(asset('storage/' . $gallery->thumbnail_path)); ?>" alt="<?php echo e($gallery->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition">
            <?php else: ?>
                <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                    <i class="fas fa-images text-6xl text-gray-500 opacity-50"></i>
                </div>
            <?php endif; ?>
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-50 transition flex items-center justify-center gap-2">
                <a href="<?php echo e(route('dashboard.galleries.show', $gallery)); ?>" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="<?php echo e(route('dashboard.galleries.edit', $gallery)); ?>" class="bg-green-600 text-white p-3 rounded-full hover:bg-green-700 transition">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="<?php echo e(route('dashboard.galleries.destroy', $gallery)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this gallery and all its images?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
            <?php if($gallery->is_featured): ?>
                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                    <i class="fas fa-star"></i> Featured
                </div>
            <?php endif; ?>
        </div>
        <div class="p-4">
            <h4 class="font-bold text-gray-900 text-lg mb-2 truncate"><?php echo e($gallery->title); ?></h4>
            <?php if($gallery->description): ?>
                <p class="text-sm text-gray-600 mb-3 line-clamp-2"><?php echo e($gallery->description); ?></p>
            <?php endif; ?>
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-500">
                    <i class="fas fa-images mr-1"></i>
                    <?php echo e($gallery->images->count()); ?> <?php echo e(Str::plural('photo', $gallery->images->count())); ?>

                </span>
                <span class="text-gray-400 text-xs">
                    <?php echo e($gallery->created_at->diffForHumans()); ?>

                </span>
            </div>
            <?php if($gallery->creator): ?>
                <div class="mt-2 text-xs text-gray-500">
                    <i class="fas fa-user mr-1"></i> <?php echo e($gallery->creator->name); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-span-full text-center py-16 text-gray-500">
        <i class="fas fa-images text-6xl mb-4 opacity-30"></i>
        <p class="text-lg font-semibold mb-2">No galleries yet</p>
        <p class="text-sm mb-4">Create your first photo gallery to get started</p>
        <a href="<?php echo e(route('dashboard.galleries.create')); ?>" class="inline-flex items-center bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition">
            <i class="fas fa-plus mr-2"></i> Create Gallery
        </a>
    </div>
    <?php endif; ?>
</div>

<?php if($galleries->hasPages()): ?>
<div class="mt-8">
    <?php echo e($galleries->links()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/galleries/index.blade.php ENDPATH**/ ?>