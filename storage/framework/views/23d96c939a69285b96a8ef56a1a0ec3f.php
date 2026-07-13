<?php $__env->startSection('title', 'Sermons'); ?>
<?php $__env->startSection('page-title', 'Sermons Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Sermons</h3>
    <a href="<?php echo e(route('dashboard.sermons.create')); ?>" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Sermon
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Preacher</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Featured</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $sermons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sermon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-900 font-semibold"><?php echo e($sermon->title); ?></td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($sermon->preacher); ?></td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($sermon->sermon_date ? $sermon->sermon_date->format('M d, Y') : 'N/A'); ?></td>
                <td class="px-6 py-4 text-sm">
                    <form action="<?php echo e(route('dashboard.sermons.toggle-featured', $sermon)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium transition <?php echo e($sermon->featured ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                            <?php echo e($sermon->featured ? '★ Featured' : '☆ Not Featured'); ?>

                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="<?php echo e(route('dashboard.sermons.edit', $sermon)); ?>" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('dashboard.sermons.destroy', $sermon)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Delete this sermon?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
                    <p class="mt-2">No sermons yet. <a href="<?php echo e(route('dashboard.sermons.create')); ?>" class="text-blue-600 hover:underline">Add one</a></p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-6">
    <?php echo e($sermons->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/sermons/index.blade.php ENDPATH**/ ?>