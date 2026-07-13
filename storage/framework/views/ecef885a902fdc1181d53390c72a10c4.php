<?php $__env->startSection('title', 'Group Leadership Management'); ?>
<?php $__env->startSection('page-title', 'Group Leadership Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Group Leadership</h1>
    <a href="<?php echo e(route('dashboard.group-leadership.create')); ?>" class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Add Group
    </a>
</div>

<!-- Search and Filter Section -->
<div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl shadow-sm border border-cyan-100 p-5 mb-6">
    <form method="GET" action="<?php echo e(route('dashboard.group-leadership.index')); ?>" id="filterForm">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <div class="flex items-center justify-center w-8 h-8 bg-cyan-600 rounded-lg">
                    <i class="fas fa-filter text-white text-sm"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-800">Search & Filter</h3>
            </div>
        </div>

        <!-- Filter Row -->
        <div class="flex flex-col md:flex-row gap-3 md:gap-2">
            <!-- Search Input -->
            <div class="flex-grow md:flex-grow-0 md:min-w-56">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                    <input type="text" name="search" placeholder="Search group name..." value="<?php echo e(request('search')); ?>" class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-sm transition-all bg-white">
                </div>
            </div>

            <!-- Status Dropdown -->
            <div class="flex-grow md:flex-grow-0 md:min-w-40">
                <div class="relative">
                    <i class="fas fa-circle absolute left-3 top-3 text-gray-400 text-sm pointer-events-none"></i>
                    <select name="status" class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-sm appearance-none bg-white transition-all cursor-pointer">
                        <option value="">Status</option>
                        <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2 md:ml-auto">
                <button type="submit" class="px-6 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg font-medium text-sm transition-all shadow-sm hover:shadow-md flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-search text-xs"></i> Search
                </button>
                <?php if(request()->anyFilled(['search', 'status'])): ?>
                    <a href="<?php echo e(route('dashboard.group-leadership.index')); ?>" class="px-5 py-2.5 bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 rounded-lg font-medium text-sm transition-all shadow-sm flex items-center gap-2 whitespace-nowrap">
                        <i class="fas fa-redo text-xs"></i> Reset
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<!-- Results Summary -->
<?php if($groups->count()): ?>
    <div class="mb-4 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            <span class="font-semibold text-cyan-600"><?php echo e($groups->total()); ?></span>
            <span class="text-gray-600">group<?php echo e($groups->total() != 1 ? 's' : ''); ?> found</span>
            <?php if(request()->anyFilled(['search', 'status'])): ?>
                <span class="ml-2 text-cyan-600 font-medium"><i class="fas fa-filter text-xs"></i> Filtered</span>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if($groups->count()): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden border border-gray-100">
                <!-- Image -->
                <div class="relative h-48 overflow-hidden bg-gradient-to-br from-cyan-100 to-blue-100">
                    <?php if($group->image): ?>
                        <img src="<?php echo e(asset('storage/' . $group->image)); ?>" alt="<?php echo e($group->name); ?>" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-cyan-400">
                            <i class="fas fa-users text-6xl opacity-30"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-2"><?php echo e($group->name); ?></h3>
                    <?php if($group->description): ?>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2"><?php echo e($group->description); ?></p>
                    <?php endif; ?>

                    <!-- Status and Order -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold <?php echo e($group->active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'); ?>">
                            <i class="fas <?php echo e($group->active ? 'fa-check-circle' : 'fa-times-circle'); ?> mr-1"></i>
                            <?php echo e($group->active ? 'Active' : 'Inactive'); ?>

                        </span>
                        <span class="text-xs text-gray-500">Order: <?php echo e($group->display_order); ?></span>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 pt-4 border-t border-gray-100">
                        <a href="<?php echo e(route('dashboard.group-leadership.edit', $group)); ?>" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="<?php echo e(route('dashboard.group-leadership.toggle-active', $group)); ?>" method="POST" class="flex-1">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="w-full <?php echo e($group->active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700'); ?> text-white px-3 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                                <i class="fas <?php echo e($group->active ? 'fa-ban' : 'fa-check'); ?>"></i> <?php echo e($group->active ? 'Deactivate' : 'Activate'); ?>

                            </button>
                        </form>
                        <form action="<?php echo e(route('dashboard.group-leadership.destroy', $group)); ?>" method="POST" class="flex-1" onsubmit="return confirm('Delete this group?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        <?php echo e($groups->links()); ?>

    </div>
<?php else: ?>
    <div class="bg-cyan-50 border-2 border-cyan-200 rounded-lg p-12 text-center">
        <i class="fas fa-users text-5xl text-cyan-400 mb-4"></i>
        <p class="text-gray-700 text-lg mb-6">No group leadership created yet. Start by adding one!</p>
        <a href="<?php echo e(route('dashboard.group-leadership.create')); ?>" class="inline-block bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition">
            <i class="fas fa-plus"></i> Add First Group
        </a>
    </div>
<?php endif; ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/group-leadership/index.blade.php ENDPATH**/ ?>