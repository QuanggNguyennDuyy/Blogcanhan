<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Chào mừng đến với Blog Cá Nhân</h1>
        <p class="text-gray-600">Nơi chia sẻ kiến thức và kinh nghiệm.</p>
    </div>

    <!-- Bài viết mới nhất -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Bài viết mới nhất</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <?php if($post->thumbnail): ?>
                        <img src="<?php echo e(Storage::url($post->thumbnail)); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">Không có ảnh</span>
                        </div>
                    <?php endif; ?>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">
                            <a href="<?php echo e(route('posts.show', $post->slug)); ?>" class="text-gray-900 hover:text-blue-600">
                                <?php echo e($post->title); ?>

                            </a>
                        </h3>
                        <div class="text-sm text-gray-500 mb-4">
                            <span><?php echo e($post->created_at->format('d/m/Y')); ?></span>
                            <span class="mx-2">•</span>
                            <span><?php echo e($post->category->name); ?></span>
                        </div>
                        <p class="text-gray-600 mb-4">
                            <?php echo e(Str::limit(strip_tags($post->content), 150)); ?>

                        </p>
                        <a href="<?php echo e(route('posts.show', $post->slug)); ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                            Đọc thêm →
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-3 text-center py-12 text-gray-500">
                    Chưa có bài viết nào.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Phân trang -->
    <div class="mt-6">
        <?php echo e($posts->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Desktop\blogcanhan\resources\views/home.blade.php ENDPATH**/ ?>