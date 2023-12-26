<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sản phẩm bán chạy</title>
    <link rel="shortcut icon" href="<?php echo e(asset('home/img/favicon.ico')); ?>" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">


    <!-- owl carousel libraries -->
    <link rel="stylesheet" href="home/js/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="home/js/owlcarousel/owl.theme.default.min.css">
    <script src="home/js/Jquery/Jquery.min.js"></script>
    <script src="home/js/owlcarousel/owl.carousel.min.js"></script>

    <!-- tidio - live chat -->
    <!-- <script src="//code.tidio.co/bfiiplaaohclhqwes5xivoizqkq56guu.js"></script> -->

    <!-- our files -->
    <!-- css -->
    <link rel="stylesheet" href="<?php echo e(asset('home/css/style.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/topnav.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/header.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/banner.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/taikhoan.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/trangchu.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/home_products.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/chitietsanpham.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/pagination_phantrang.css?version=1.0')); ?>">
    <link rel=" stylesheet" href="<?php echo e(asset('home/css/footer.css?version=1.0')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script src="home/data/products.js"></script>
    <!-- <script src="home/js/classes.js"></script>
    <script src="home/js/dungchung.js"></script>
    <script src="home/js/trangchu.js"></script> -->

</head>

<body>
    <?php echo $__env->make('home.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section>
        <?php echo $__env->make('home.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Header -->
        <div class="companyMenu group flexContain">
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brands): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(url('dien-thoai',$brands->slug)); ?>"><img src="<?php echo e(asset('brand_img/' . $brands->image)); ?>"></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- <a href="index.html?company=Apple"><img src="home/img/company/Apple.jpg"></a> -->
        </div>

        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href="<?php echo e(url('dien-thoai-chinh-hang')); ?>"><b> Điện thoại </b></a>><a href=""><b style="color: blue;"> Sản phẩm điện thoại bán chạy </b></a></p>
        </div>

        <div class="filterName">
            <h1 style="font-size: 25px;"><b>Danh sách sản phẩm điện thoại bán chạy</b></h1>
        </div> <!-- End FilterName -->

        <ul id="products" class="homeproduct group flexContain">
            <!-- <div id="khongCoSanPham">
                <i class="fa fa-times-circle"></i>
                Không có sản phẩm nào
            </div>  -->
            <!-- End Khong co san pham -->
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="rom_ram">
                        <h3><b>RAM:</b> <?php echo e($product->ram); ?> &nbsp<b>ROM:</b> <?php echo e($product->rom); ?></h3>
                    </div>
                    <label class="tragop">
                        Trả góp 0%
                    </label>
                    <div class="tooltip">
                        <form action="<?php echo e(url('add_cart',$product->id)); ?>" method="post" id="add-to-cart-form">
                            <?php echo csrf_field(); ?>
                            <input type="number" name="quantity" value="1" min="1" style="width: 100px;" hidden>

                            <input class="themvaogio" type="submit" value="+" <?php if(Auth::id()): ?> data-product-name="<?php echo e($product->name); ?>" <?php else: ?> onclick="submitForm()" <?php endif; ?>>
                            <span class="tooltiptext" style="font-size: 15px;">Thêm vào giỏ</span>

                        </form>
                    </div>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        </ul><!-- End products -->

        <div class="pagination">
            <?php if($products->currentPage() > 1): ?>
            <a href="<?php echo e($products->previousPageUrl()); ?>">
                <i class="fa fa-angle-left"></i>
            </a>
            <?php endif; ?>

            <?php for($i = 1; $i <= $products->lastPage(); $i++): ?>
                <a href="<?php echo e($products->url($i)); ?>" class="<?php echo e($i == $products->currentPage() ? 'current' : ''); ?>"><?php echo e($i); ?></a>
                <?php endfor; ?>

                <?php if($products->currentPage() < $products->lastPage()): ?>
                    <a href="<?php echo e($products->nextPageUrl()); ?>">
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <?php endif; ?>
        </div>


    </section> <!-- End Section -->

    <script>
        // addContainTaiKhoan();
        // addPlc();
        // Di chuyển lên đầu trang
        function gotoTop() {
            if (window.jQuery) {
                jQuery('html,body').animate({
                    scrollTop: 0
                }, 100);
            } else {
                document.getElementsByClassName('top-nav')[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }
        }

        //Them gio hang
        function submitForm() {
            // Submit the form if the user is not logged in
            document.getElementById('add-to-cart-form').submit();
        }

        $(document).ready(function() {
            $(".themvaogio").click(function(event) {
                event.preventDefault(); // Ngăn chặn sự kiện mặc định của form

                var productName = $(this).data('product-name');

                if (productName && !$(this).data('clicked')) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thêm sản phẩm vào giỏ hàng thành công',
                        text: 'Bạn đã thêm sản phẩm ' + productName + ' vào giỏ hàng',
                        timer: 2000, // Tự động đóng sau 3 giây
                        showConfirmButton: false
                    });

                    $(this).data('clicked', true);

                    $(this).closest('form').submit();
                }
            });
        });
    </script>
    <?php echo $__env->make('home.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/bestseller_detail.blade.php ENDPATH**/ ?>