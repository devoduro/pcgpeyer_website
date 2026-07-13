<?php $__env->startSection('title', 'Events'); ?>
<?php $__env->startSection('page-title', 'Events Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Events</h3>
    <a href="<?php echo e(route('dashboard.events.create')); ?>" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Event
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Event Title</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Location</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm font-semibold text-gray-900"><?php echo e($event->title); ?></td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($event->start_date->format('M d, Y H:i')); ?></td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($event->location ?? 'TBD'); ?></td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($event->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'); ?>">
                        <?php echo e($event->published ? '✓ Published' : '○ Draft'); ?>

                    </span>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="<?php echo e(route('dashboard.events.edit', $event)); ?>" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('dashboard.events.destroy', $event)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
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
                    No events yet. <a href="<?php echo e(route('dashboard.events.create')); ?>" class="text-blue-600 hover:underline">Create one</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-6">
    <?php echo e($events->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/events/index.blade.php ENDPATH**/ ?>