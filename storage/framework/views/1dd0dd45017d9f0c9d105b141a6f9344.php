<div class="companyMenu group flexContain">
        <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brands): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(url('dien-thoai',$brands->slug)); ?>"><img src="<?php echo e(asset('brand_img/' . $brands->image)); ?>"></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- <a href="index.html?company=Apple"><img src="home/img/company/Apple.jpg"></a> -->
</div><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/brand.blade.php ENDPATH**/ ?>