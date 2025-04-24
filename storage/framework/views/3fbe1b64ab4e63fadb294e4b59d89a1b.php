<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold mb-4">Liên hệ</h1>
                <p class="text-xl text-gray-600">Chúng tôi luôn sẵn sàng lắng nghe ý kiến của bạn</p>
            </div>

            <!-- Contact Form -->
            <div class="card p-8">
                <form action="<?php echo e(route('contact.send')); ?>" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
                        <input type="text" name="name" id="name" required
                               class="form-control mt-1" placeholder="Nhập họ và tên của bạn">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                               class="form-control mt-1" placeholder="example@gmail.com">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Chủ đề</label>
                        <input type="text" name="subject" id="subject" required
                               class="form-control mt-1" placeholder="Nhập chủ đề">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Nội dung</label>
                        <textarea name="message" id="message" rows="5" required
                                  class="form-control mt-1" placeholder="Nhập nội dung tin nhắn"></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Gửi tin nhắn
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto bg-primary-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium">Email</h3>
                    <p class="mt-2 text-gray-600">contact@example.com</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 mx-auto bg-primary-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium">Điện thoại</h3>
                    <p class="mt-2 text-gray-600">(+84) 123 456 789</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 mx-auto bg-primary-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium">Địa chỉ</h3>
                    <p class="mt-2 text-gray-600">123 Đường ABC, Quận XYZ<br>TP. Hồ Chí Minh</p>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\HP\Desktop\blogcanhan\resources\views/contact.blade.php ENDPATH**/ ?>