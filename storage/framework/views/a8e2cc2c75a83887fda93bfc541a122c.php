<?php $__env->startSection('title', 'Leadership Management'); ?>
<?php $__env->startSection('page-title', 'Leadership Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Leadership Team</h1>
    <a href="<?php echo e(route('dashboard.leadership.create')); ?>" class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Add Member
    </a>
</div>

<!-- Search and Filter Section -->
<div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl shadow-sm border border-cyan-100 p-5 mb-6">
    <form method="GET" action="<?php echo e(route('dashboard.leadership.index')); ?>" id="filterForm">
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
            <div class="flex-grow md:flex-grow-0 md:min-w-48">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                    <input type="text" name="search" placeholder="Search name or email..." value="<?php echo e(request('search')); ?>" class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-sm transition-all bg-white">
                </div>
            </div>

            <!-- Position Dropdown -->
            <div class="flex-grow md:flex-grow-0 md:min-w-40">
                <div class="relative">
                    <i class="fas fa-briefcase absolute left-3 top-3 text-gray-400 text-sm pointer-events-none"></i>
                    <select name="title_id" class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-sm appearance-none bg-white transition-all cursor-pointer">
                        <option value="">Position</option>
                        <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($title->id); ?>" <?php echo e(request('title_id') == $title->id ? 'selected' : ''); ?>>
                                <?php echo e($title->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>

            <!-- Year Range Dropdown -->
            <div class="flex-grow md:flex-grow-0 md:min-w-40">
                <div class="relative">
                    <i class="fas fa-calendar absolute left-3 top-3 text-gray-400 text-sm pointer-events-none"></i>
                    <select name="year" class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-sm appearance-none bg-white transition-all cursor-pointer">
                        <option value="">Year Range</option>
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($year->year); ?>" <?php echo e(request('year') == $year->year ? 'selected' : ''); ?>>
                                <?php echo e($year->yearRange); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 text-sm pointer-events-none"></i>
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
                        <option value="current" <?php echo e(request('status') === 'current' ? 'selected' : ''); ?>>Current Term</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2 md:ml-auto">
                <button type="submit" class="px-6 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg font-medium text-sm transition-all shadow-sm hover:shadow-md flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-search text-xs"></i> Search
                </button>
                <?php if(request()->anyFilled(['search', 'title_id', 'year', 'status'])): ?>
                    <a href="<?php echo e(route('dashboard.leadership.index')); ?>" class="px-5 py-2.5 bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 rounded-lg font-medium text-sm transition-all shadow-sm flex items-center gap-2 whitespace-nowrap">
                        <i class="fas fa-redo text-xs"></i> Reset
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Active Filters Badges -->
        <?php if(request()->anyFilled(['search', 'title_id', 'year', 'status'])): ?>
            <div class="mt-3 pt-3 border-t border-cyan-200 flex flex-wrap gap-2 items-center">
                <span class="text-xs font-semibold text-gray-600">Applied:</span>
                <?php if(request('search')): ?>
                    <span class="inline-flex items-center gap-1.5 bg-white border border-blue-200 text-blue-700 px-2.5 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-search text-xs"></i> <?php echo e(request('search')); ?>

                    </span>
                <?php endif; ?>
                <?php if(request('title_id')): ?>
                    <?php $selectedTitle = $titles->find(request('title_id')); ?>
                    <?php if($selectedTitle): ?>
                        <span class="inline-flex items-center gap-1.5 bg-white border border-purple-200 text-purple-700 px-2.5 py-1 rounded-full text-xs font-medium">
                            <i class="fas fa-briefcase text-xs"></i> <?php echo e($selectedTitle->title); ?>

                        </span>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(request('year')): ?>
                    <?php $selectedYear = $years->firstWhere('year', request('year')); ?>
                    <?php if($selectedYear): ?>
                        <span class="inline-flex items-center gap-1.5 bg-white border border-green-200 text-green-700 px-2.5 py-1 rounded-full text-xs font-medium">
                            <i class="fas fa-calendar text-xs"></i> <?php echo e($selectedYear->yearRange); ?>

                        </span>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(request('status')): ?>
                    <span class="inline-flex items-center gap-1.5 bg-white border border-orange-200 text-orange-700 px-2.5 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-circle text-xs"></i> <?php echo e(ucfirst(request('status'))); ?>

                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </form>
</div>

<!-- Results Summary -->
<?php if($leadership->count()): ?>
    <div class="mb-4 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            <span class="font-semibold text-cyan-600"><?php echo e($leadership->total()); ?></span>
            <span class="text-gray-600">result<?php echo e($leadership->total() != 1 ? 's' : ''); ?> found</span>
            <?php if(request()->anyFilled(['search', 'title_id', 'year', 'status'])): ?>
                <span class="ml-2 text-cyan-600 font-medium"><i class="fas fa-filter text-xs"></i> Filtered</span>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if($leadership->count()): ?>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-cyan-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-cyan-900">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-cyan-900">Title</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-cyan-900">Year</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-cyan-900">Order</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-cyan-900">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-cyan-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php $__currentLoopData = $leadership; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <?php if($member->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $member->image)); ?>" alt="<?php echo e($member->name); ?>" class="w-10 h-10 rounded-full object-cover">
                                <?php else: ?>
                                    <div class="w-10 h-10 rounded-full bg-cyan-200 flex items-center justify-center text-cyan-700 font-semibold">
                                        <?php echo e(substr($member->name, 0, 1)); ?>

                                    </div>
                                <?php endif; ?>
                                <div>
                                    <span class="font-semibold text-gray-900"><?php echo e($member->name); ?></span>
                                    <?php if($member->is_current): ?>
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-gradient-to-r from-blue-600 to-purple-600 text-white">
                                            <i class="fas fa-star mr-1"></i> CURRENT
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700"><?php echo e($member->displayTitle); ?></td>
                        <td class="px-6 py-4 text-center font-semibold text-cyan-700"><?php echo e($member->yearRange); ?></td>
                        <td class="px-6 py-4 text-center text-gray-700"><?php echo e($member->display_order); ?></td>
                        <td class="px-6 py-4 text-center">
                            <form action="<?php echo e(route('dashboard.leadership.toggle-active', $member)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold transition <?php echo e($member->active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                                    <i class="fas <?php echo e($member->active ? 'fa-check-circle' : 'fa-times-circle'); ?> mr-1"></i>
                                    <?php echo e($member->active ? 'Active' : 'Inactive'); ?>

                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="<?php echo e(route('dashboard.leadership.edit', $member)); ?>" class="text-blue-600 hover:text-blue-900 hover:bg-blue-50 px-3 py-2 rounded transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('dashboard.leadership.destroy', $member)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-900 hover:bg-red-50 px-3 py-2 rounded transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        <?php echo e($leadership->links()); ?>

    </div>
<?php else: ?>
    <div class="bg-cyan-50 border-2 border-cyan-200 rounded-lg p-8 text-center">
        <i class="fas fa-users text-4xl text-cyan-400 mb-4"></i>
        <p class="text-gray-700 text-lg">No leadership members yet. Start by adding one!</p>
        <a href="<?php echo e(route('dashboard.leadership.create')); ?>" class="inline-block mt-4 bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition">
            <i class="fas fa-plus"></i> Add First Member
        </a>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/dashboard/leadership/index.blade.php ENDPATH**/ ?>