<?php $__env->startSection('title', 'Users'); ?>
<?php $__env->startSection('page-title', 'User Management'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header with Actions -->
<div class="mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-2xl font-bold text-gray-900">User Management</h3>
            <p class="text-sm text-gray-600 mt-1">Manage dashboard users, roles, and permissions</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <a href="<?php echo e(route('dashboard.users.logs')); ?>" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow-md whitespace-nowrap">
                <i class="fas fa-history"></i> 
                <span>Activity Logs</span>
            </a>
            <a href="<?php echo e(route('dashboard.users.create')); ?>" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow-md whitespace-nowrap">
                <i class="fas fa-user-plus"></i> 
                <span>Add User</span>
            </a>
        </div>
    </div>
</div>

<!-- Search and Filters -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <form method="GET" action="<?php echo e(route('dashboard.users.index')); ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Name or email..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
            <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                <option value="">All Roles</option>
                <option value="admin" <?php echo e(request('role') === 'admin' ? 'selected' : ''); ?>>Admin</option>
                <option value="editor" <?php echo e(request('role') === 'editor' ? 'selected' : ''); ?>>Editor</option>
                <option value="viewer" <?php echo e(request('role') === 'viewer' ? 'selected' : ''); ?>>Viewer</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                <option value="">All Status</option>
                <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="flex-1 bg-cyan-600 text-white px-4 py-2 rounded-lg hover:bg-cyan-700 transition">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
            <a href="<?php echo e(route('dashboard.users.index')); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">User</th>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Contact</th>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Role</th>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Status</th>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Last Login</th>
                <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-blue-50 transition-colors duration-200">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white font-bold text-sm">
                            <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                        </div>
                        <div>
                            <div class="font-bold text-gray-900"><?php echo e($user->name); ?></div>
                            <?php if($user->id === auth()->id()): ?>
                            <span class="text-xs text-cyan-600 font-semibold">(You)</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900"><?php echo e($user->email); ?></div>
                    <?php if($user->phone): ?>
                    <div class="text-xs text-gray-500 mt-1"><i class="fas fa-phone mr-1"></i><?php echo e($user->phone); ?></div>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm
                            <?php echo e($user->role === 'admin' ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white' : ''); ?>

                            <?php echo e($user->role === 'editor' ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white' : ''); ?>

                            <?php echo e($user->role === 'viewer' ? 'bg-gray-200 text-gray-700' : ''); ?>

                        ">
                            <i class="fas <?php echo e($user->role === 'admin' ? 'fa-crown' : ($user->role === 'editor' ? 'fa-pen' : 'fa-eye')); ?> mr-1"></i>
                            <?php echo e(ucfirst($user->role)); ?>

                        </span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <form action="<?php echo e(route('dashboard.users.toggle-active', $user)); ?>" method="POST" style="display:inline;" <?php echo e($user->id === auth()->id() ? 'disabled' : ''); ?>>
                        <?php echo csrf_field(); ?>
                        <button type="submit" <?php echo e($user->id === auth()->id() ? 'disabled' : ''); ?> class="px-4 py-1.5 rounded-lg text-xs font-bold transition shadow-sm <?php echo e($user->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200 hover:shadow-md' : 'bg-red-100 text-red-700 hover:bg-red-200 hover:shadow-md'); ?> <?php echo e($user->id === auth()->id() ? 'opacity-50 cursor-not-allowed' : ''); ?>">
                            <i class="fas <?php echo e($user->is_active ? 'fa-check-circle' : 'fa-times-circle'); ?> mr-1"></i>
                            <?php echo e($user->is_active ? 'Active' : 'Inactive'); ?>

                        </button>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <?php if($user->last_login_at): ?>
                    <div class="text-sm text-gray-900"><?php echo e($user->last_login_at->format('M d, Y')); ?></div>
                    <div class="text-xs text-gray-500"><?php echo e($user->last_login_at->format('h:i A')); ?></div>
                    <?php else: ?>
                    <span class="text-xs text-gray-400 italic">Never</span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-2">
                        <a href="<?php echo e(route('dashboard.users.show', $user)); ?>" class="px-3 py-1.5 bg-cyan-100 text-cyan-700 rounded-lg hover:bg-cyan-200 transition" title="View Profile">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?php echo e(route('dashboard.users.edit', $user)); ?>" class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <?php if($user->id !== auth()->id()): ?>
                        <form action="<?php echo e(route('dashboard.users.destroy', $user)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg mb-2">No users found</p>
                        <a href="<?php echo e(route('dashboard.users.create')); ?>" class="text-cyan-600 hover:text-cyan-700 font-semibold">
                            <i class="fas fa-plus-circle mr-1"></i>Create your first user
                        </a>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-6">
    <?php echo e($users->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/users/index.blade.php ENDPATH**/ ?>