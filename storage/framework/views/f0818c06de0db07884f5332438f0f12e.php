<div class="khungSanPham" style="border-color: #ff9c00">
    <h3 class="tenKhung" style="background-image: linear-gradient(120deg, #ff9c00 0%, #ec1f1f 50%, #ff9c00 100%);">* SẢN PHẨM BÁN CHẠY *</h3>
    <div class="listSpTrongKhung flexContain">
        <?php $__currentLoopData = $bestseller_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="sanPham">
            <a href="<?php echo e(url('chi-tiet-san-pham/' .$product->slug)); ?>">
                <img src="<?php echo e(asset('product_img/' . $product->image)); ?>" alt="">
                <h3><b><?php echo e($product->name); ?></b></h3>
                <div class="price">
                    <?php if($product->old_price > $product->price): ?>
                    <b class="price_old_product">
                        <?php echo e(number_format($product->old_price, 0, ',', '.')); ?>₫
                    </b>
                    <?php
                    $discountPercentage = round(($product->old_price - $product->price) / $product->old_price * 100);
                    ?>
                    <b class="price_percent_product">-<?php echo e($discountPercentage); ?>%</b>
                    <?php endif; ?>
                    <div>
                        <strong><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫</strong>
                    </div>
                </div>
                <!-- <div class="ratingresult">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><span>372 đánh giá</span>
                </div> -->
                <div class="rom_ram">
                    <h3><b>RAM:</b> <?php echo e($product->ram); ?> &nbsp<b>ROM:</b> <?php echo e($product->rom); ?></h3>
                </div>
                <label class="tragop">
                    Trả góp 0%
                </label>
                <!-- <div class="tooltip">
                    <form action="<?php echo e(url('add_cart',$product->id)); ?>" method="post" id="add-to-cart-form">
                        <?php echo csrf_field(); ?>
                        <input type="number" name="quantity" value="1" min="1" style="width: 100px;" hidden>

                        <input class="themvaogio" type="submit" value="+" <?php if(Auth::id()): ?> data-product-name="<?php echo e($product->name); ?>" <?php else: ?> onclick="submitForm()" <?php endif; ?>>
                        <span class="tooltiptext" style="font-size: 15px;">Thêm vào giỏ</span>

                    </form>
                </div> -->
            </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <a class="xemTatCa" href="<?php echo e(url('san-pham-ban-chay')); ?>" style="	border-left: 2px solid #ff9c00;
					border-right: 2px solid #ff9c00;">
        Xem tất cả <?php echo e($count_bestseller); ?> sản phẩm
    </a>
</div><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/bestseller.blade.php ENDPATH**/ ?>