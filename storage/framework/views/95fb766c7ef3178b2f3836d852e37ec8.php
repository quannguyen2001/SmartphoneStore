<?php if($errors->any()): ?>
    <div <?php echo e($attributes); ?>>
    <!-- <div class="font-medium text-red-600"><?php echo e(__('Whoops! Something went wrong.')); ?></div> -->
        <div class="font-medium text-red-600"><?php echo e(__('Tài khoản hoặc mật khẩu của bạn không đúng!')); ?></div>

        <!-- <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul> -->
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/components/validation-errors.blade.php ENDPATH**/ ?>