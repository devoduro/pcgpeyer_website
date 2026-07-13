<?php $__env->startSection('title', 'Manage Leadership Titles'); ?>
<?php $__env->startSection('page-title', 'Manage Leadership Titles'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl">
    <!-- Add New Title -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-6">Add New Title</h3>
        <form action="<?php echo e(route('dashboard.leadership.store-title')); ?>" method="POST" class="grid grid-cols-3 gap-4">
            <?php echo csrf_field(); ?>

            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title/Position *</label>
                <input type="text" id="title" name="title" placeholder="e.g., Session Clerk" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <input type="text" id="description" name="description" placeholder="e.g., Leads church sessions" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-cyan-600 text-white px-4 py-2 rounded-lg hover:bg-cyan-700 transition flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i> Add Title
                </button>
            </div>
        </form>
    </div>

    <!-- Titles List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Leadership Titles</h3>
        </div>

        <?php if($titles->isEmpty()): ?>
            <div class="p-8 text-center text-gray-500">
                <p>No titles created yet. Add one using the form above.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Description</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Members</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-8 py-4 text-right text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-8 py-4">
                                    <span class="font-semibold text-gray-800"><?php echo e($title->title); ?></span>
                                </td>
                                <td class="px-8 py-4 text-gray-600">
                                    <?php echo e($title->description ?? '—'); ?>

                                </td>
                                <td class="px-8 py-4">
                                    <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                        <?php echo e($title->leaders()->count()); ?> member<?php echo e($title->leaders()->count() != 1 ? 's' : ''); ?>

                                    </span>
                                </td>
                                <td class="px-8 py-4">
                                    <?php if($title->active): ?>
                                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Active
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-block bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                            Inactive
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex gap-3 justify-end">
                                        <?php if($title->active): ?>
                                            <form action="<?php echo e(route('dashboard.leadership.toggle-title', $title)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition" title="Deactivate">
                                                    <i class="fas fa-ban"></i> Deactivate
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form action="<?php echo e(route('dashboard.leadership.toggle-title', $title)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium transition" title="Activate">
                                                    <i class="fas fa-check"></i> Activate
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <button onclick="editTitle(<?php echo e($title->id); ?>, '<?php echo e(addslashes($title->title)); ?>', '<?php echo e(addslashes($title->description ?? '')); ?>')" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        <?php if($title->leaders()->count() == 0): ?>
                                            <form action="<?php echo e(route('dashboard.leadership.delete-title', $title)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" onclick="return confirm('Delete this title?')" class="text-red-600 hover:text-red-800 text-sm font-medium transition" title="Delete">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-8">
        <a href="<?php echo e(route('dashboard.leadership.index')); ?>" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back to Leadership
        </a>
    </div>
</div>

<!-- Edit Title Modal -->
<div id="editTitleModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xs">
        <div class="px-4 py-3 border-b border-gray-200">
            <h3 class="text-base font-bold text-gray-800">Edit Title</h3>
        </div>
        <form id="editTitleForm" method="POST" class="p-4 space-y-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div>
                <label for="editTitle" class="block text-xs font-semibold text-gray-700 mb-1">Title/Position *</label>
                <input type="text" id="editTitle" name="title" required class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
            </div>

            <div>
                <label for="editDescription" class="block text-xs font-semibold text-gray-700 mb-1">Description</label>
                <input type="text" id="editDescription" name="description" class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="flex-1 bg-cyan-600 text-white px-3 py-1 text-sm rounded hover:bg-cyan-700 transition">
                    Update
                </button>
                <button type="button" onclick="closeEditTitleModal()" class="flex-1 bg-gray-300 text-gray-700 px-3 py-1 text-sm rounded hover:bg-gray-400 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeEditTitleModal();
    }
});

document.getElementById('editTitleModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeEditTitleModal();
    }
});

function editTitle(id, title, description) {
    document.getElementById('editTitle').value = title;
    document.getElementById('editDescription').value = description;
    document.getElementById('editTitleForm').action = `/dashboard/leadership/manage-titles/${id}`;
    document.getElementById('editTitleModal').classList.remove('hidden');
}

function closeEditTitleModal() {
    document.getElementById('editTitleModal').classList.add('hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/leadership/manage-titles.blade.php ENDPATH**/ ?>