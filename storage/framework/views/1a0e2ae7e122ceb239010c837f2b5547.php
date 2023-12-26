<?php if($branches->isEmpty()): ?>
    <p><b>Không cửa hàng nào có sản phẩm!</b></p>
<?php else: ?>
    <div style="border: 1px solid black; text-align: left; padding-left: 5px; color: red;">
        <b><i>Đã tìm thấy <?php echo e($count_branch); ?> cửa hàng</i></b>
    </div>
    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="border: 1px solid black; text-align: left; ">
        <p style="padding-left: 5px;">
            <b>Cửa hàng <?php echo e($branch->branch->address); ?>, <?php echo e($branch->branch->district); ?>, <?php echo e($branch->branch->city); ?> </b>
        </p>
        <p style="color: blue; padding-left: 5px;">Hiện đang có: <b><?php echo e($branch->quantity); ?></b> sản phẩm - <b style="color: brown;"><a href="<?php echo e(url('cua-hang/' .$branch->branch->slug)); ?>" target="_blank">Xem bản đồ</a></b></p>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/branch_list.blade.php ENDPATH**/ ?>