<?php $__env->startSection('title', 'Contact Messages'); ?>
<?php $__env->startSection('page-title', 'Contact Submissions'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">From</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Subject</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50 transition <?php echo e($submission->status === 'new' ? 'bg-blue-50' : ''); ?>">
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900"><?php echo e($submission->name); ?></div>
                    <div class="text-xs text-gray-500"><?php echo e($submission->email); ?></div>
                </td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900"><?php echo e($submission->subject); ?></td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        <?php echo e($submission->status === 'new' ? 'bg-blue-100 text-blue-700' : ''); ?>

                        <?php echo e($submission->status === 'read' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                        <?php echo e($submission->status === 'replied' ? 'bg-purple-100 text-purple-700' : ''); ?>

                        <?php echo e($submission->status === 'resolved' ? 'bg-green-100 text-green-700' : ''); ?>

                    ">
                        <?php echo e(ucfirst($submission->status)); ?>

                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($submission->created_at->format('M d, Y')); ?></td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="<?php echo e(route('dashboard.contact.show', $submission)); ?>" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="<?php echo e(route('dashboard.contact.destroy', $submission)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
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
                    <p>No contact messages yet</p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-6">
    <?php echo e($submissions->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/contact/index.blade.php ENDPATH**/ ?>