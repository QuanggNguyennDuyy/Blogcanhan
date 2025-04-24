<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'Blog Cá Nhân')); ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="<?php echo e(route('home')); ?>" class="text-xl font-bold text-indigo-600">
                            Blog Cá Nhân
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="<?php echo e(route('home')); ?>" class="nav-link">Trang chủ</a>
                        <a href="<?php echo e(route('blog')); ?>" class="nav-link">Blog</a>
                        <a href="<?php echo e(route('about')); ?>" class="nav-link">Giới thiệu</a>
                        <a href="<?php echo e(route('contact')); ?>" class="nav-link">Liên hệ</a>
                    </div>
                </div>

                <!-- Auth Links -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-secondary mr-2">Đăng nhập</a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Đăng ký</a>
                    <?php else: ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="btn btn-secondary">
                                <?php echo e(Auth::user()->name); ?>

                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="<?php echo e(route('posts.create')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Tạo bài viết mới
                                </a>
                                <a href="<?php echo e(route('posts.index')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Quản lý bài viết
                                </a>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Trang cá nhân
                                </a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-12">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Về chúng tôi</h3>
                    <p class="text-gray-400">Blog chia sẻ kiến thức và kinh nghiệm.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Liên kết</h3>
                    <div class="space-y-2">
                        <a href="<?php echo e(route('home')); ?>" class="block text-gray-400 hover:text-white">Trang chủ</a>
                        <a href="<?php echo e(route('blog')); ?>" class="block text-gray-400 hover:text-white">Blog</a>
                        <a href="<?php echo e(route('about')); ?>" class="block text-gray-400 hover:text-white">Giới thiệu</a>
                        <a href="<?php echo e(route('contact')); ?>" class="block text-gray-400 hover:text-white">Liên hệ</a>
                    </div>
                </div>


                <div>
                    <h3 class="text-lg font-semibold mb-4">Theo dõi</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-700 pt-8 text-center">
                <p class="text-gray-400">&copy; <?php echo e(date('Y')); ?> Blog Cá Nhân. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\Users\HP\Desktop\blogcanhan\resources\views/layouts/app.blade.php ENDPATH**/ ?>