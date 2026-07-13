<?php $__env->startSection('title', 'Ministries'); ?>
<?php $__env->startSection('page-title', 'Ministries Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Ministries</h3>
    <a href="<?php echo e(route('dashboard.ministries.create')); ?>" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Ministry
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Leader</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Active</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $ministries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ministry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900"><?php echo e($ministry->name); ?></div>
                    <div class="text-xs text-gray-500"><?php echo e(Str::limit($ministry->description, 40)); ?></div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($ministry->leader ?? 'N/A'); ?></td>
                <td class="px-6 py-4">
                    <form action="<?php echo e(route('dashboard.ministries.toggle-active', $ministry)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium transition <?php echo e($ministry->active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                            <?php echo e($ministry->active ? '✓ Active' : '○ Inactive'); ?>

                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="<?php echo e(route('dashboard.ministries.edit', $ministry)); ?>" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('dashboard.ministries.destroy', $ministry)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
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
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                    No ministries yet. <a href="<?php echo e(route('dashboard.ministries.create')); ?>" class="text-blue-600 hover:underline">Create one</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-6">
    <?php echo e($ministries->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/ministries/index.blade.php ENDPATH**/ ?>