<div id="myCarousel" class="carousel">
    <div class="carousel-inner">
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item">
            <a target="_blank" href="<?php echo e($banner->link); ?>">
                <img src="<?php echo e(asset('banner_img/' . $banner->image)); ?>" alt="Image 1">
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="carousel-controls">
        <div class="carousel-prev" onclick="prevSlide()">&#10094;</div>
        <div class="carousel-next" onclick="nextSlide()">&#10095;</div>
    </div>
</div>
<div>
    <img src="home/img/banners/blackFriday.gif" alt="" style="width: 100%;">
</div><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/banner.blade.php ENDPATH**/ ?>