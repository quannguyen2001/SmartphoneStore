<div class="plc">
    <section>
        <div class="flex_contain">
            <div class="block_footer">
                <p style="font-size: 15px;"><b>CÔNG TY CỔ PHẦN THẾ GIỚI ĐIỆN THOẠI</b></p>
                <p>Địa chỉ: 55 Giải Phóng, Hai Bà Trưng, Hà Nội</p>
                <p>Email: thegioidienthoaicorp@gmail.com</p>
                <!-- <p>Facebook: <a href="https://www.facebook.com/thegioidienthoaicorp">https://www.facebook.com/thegioidienthoaicorp</a></p>
                <p>Instagram: <a href="https://www.instagram.com/thegioidienthoaicorp">https://www.instagram.com/thegioidienthoaicorp</a></p> -->
                <p>Hotline: 1900 6688</p>
            </div>
            <div class="block_footer">
                <p style="font-size: 15px;"><b>SẢN PHẨM ĐIỆN THOẠI</b></p>
                <?php $__currentLoopData = $keyword; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><a href="<?php echo e(url('dien-thoai',$brand->slug)); ?>">Điện thoại <?php echo e($brand->title); ?></a></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="block_footer">
                <p style="font-size: 15px;"><b>THÔNG TIN</b></p>
                <p><a href="<?php echo e(url('gioi-thieu')); ?>">Giới thiệu</a></p>
                <p><a href="<?php echo e(url('he-thong-cua-hang')); ?>">Cửa hàng</a></p>
                <p><a href="<?php echo e(url('lien-he')); ?>">Liên hệ</a></p>
            </div>

        </div>
    </section>
    <!-- <section>
        <ul class="flexContain">
            <li>Giao hàng hỏa tốc trong 1 giờ</li>
            <li>Thanh toán linh hoạt: tiền mặt, visa / master, trả góp</li>
            <li>Trải nghiệm sản phẩm tại nhà</li>
            <li>Lỗi đổi tại nhà trong 1 ngày</li>
            <li>Hỗ trợ suốt thời gian sử dụng.
                <br>
                <p style="color: #288ad6;">Hotline: 19006688</p>
            </li>
        </ul>
    </section> -->
</div>

<div class="footer">
    <!-- ============== Alert Box ============= -->
    <div id="alert">
        <span id="closebtn">&otimes;</span>
    </div>

    <!-- ============== Footer ============= -->
    <div class="copy-right">
        <p><a href="index.html">Thế giới điện thoại</a> - All rights reserved © 2023 - Designed by
            <span style="color: #eee; font-weight: bold">QuanNguyen</span>
        </p>
    </div>
</div><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/footer.blade.php ENDPATH**/ ?>