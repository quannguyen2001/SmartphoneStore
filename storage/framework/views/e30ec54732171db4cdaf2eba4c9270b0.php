<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Điện thoại cũ</title>
    <link rel="shortcut icon" href="<?php echo e(asset('home/img/favicon.ico')); ?>" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">


    <!-- owl carousel libraries -->
    <!-- <link rel="stylesheet" href="home/js/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="home/js/owlcarousel/owl.theme.default.min.css">
    <script src="home/js/Jquery/Jquery.min.js"></script>
    <script src="home/js/owlcarousel/owl.carousel.min.js"></script> -->

    <!-- tidio - live chat -->
    <!-- <script src="//code.tidio.co/bfiiplaaohclhqwes5xivoizqkq56guu.js"></script> -->

    <!-- our files -->
    <!-- css -->
    <link rel="stylesheet" href="<?php echo e(asset('home/css/style.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/topnav.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/header.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/banner.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/taikhoan.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/trangchu.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/dienthoaicu.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/pagination_phantrang.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/chitietsanpham.css?version=1.1')); ?>">
    <link rel=" stylesheet" href="<?php echo e(asset('home/css/footer.css?version=1.1')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="<?php echo e(asset('home/js/home.js')); ?>"></script>
    <script src="home/data/products.js"></script>
    <!-- <script src="home/js/classes.js"></script>
    <script src="home/js/dungchung.js"></script>
    <script src="home/js/trangchu.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <p><a href="/"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Điện thoại cũ</b></a></p>
        </div>

        <div class="filterName">
            <h1 style="font-size: 25px;"><b>Danh sách sản phẩm điện thoại cũ</b></h1>
        </div> <!-- End FilterName -->


        <ul id="products" class="homeproduct group flexContain">
            <!-- <div id="khongCoSanPham">
                <i class="fa fa-times-circle"></i>
                Không có sản phẩm nào
            </div>  -->
            <!-- End Khong co san pham -->
            <?php $__currentLoopData = $old_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="sanPham">
                <a href="<?php echo e(url('chi-tiet-san-pham-cu/'.$old_product->product->slug. '/' .$old_product->id)); ?>">
                    <img src="<?php echo e(asset('old_product_img/' . $old_product->image1)); ?>" alt="">
                    <?php
                        $discountPercentage = round(($old_product->product->price - $old_product->new_price) / $old_product->product->price * 100);
                    ?>
                    <h3><b><?php echo e($old_product->product->name); ?></b></h3>
                    <div class="price">
                        <div>
                            <strong><?php echo e(number_format($old_product->new_price, 0, ',', '.')); ?>₫ </strong> <b class="price_percent">-<?php echo e($discountPercentage); ?>%</b>
                        </div>
                    </div>
                    <div class="rom_ram">
                        <h3><b>Giá sản phẩm mới:</b> <?php echo e(number_format($old_product->product->price, 0, ',', '.')); ?>₫</h3>
                        <?php
                            $discountPrice = $old_product->product->price - $old_product->new_price;
                        ?>
                        <h3><b>Tiết kiệm:</b> <?php echo e(number_format($discountPrice, 0, ',', '.')); ?>₫</h3>
                        <h3><b>Màu sắc:</b> <?php echo e($old_product->color->color); ?></h3>
                        <h3><b>Thời hạn bảo hành:</b> <?php echo e($old_product->time_guarantee); ?></h3>
                        <h3><b>Có tại:</b> <?php echo e($old_product->branch->address); ?>, <?php echo e($old_product->branch->district); ?>, <?php echo e($old_product->branch->city); ?></h3>
                    </div>
                  
                   
                    <label class="tragop">
                        Trả góp 0%
                    </label>
                    
                  
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




        </ul><!-- End products -->

        <div class="pagination">
            <?php if($old_products->currentPage() > 1): ?>
            <a href="<?php echo e($old_products->previousPageUrl()); ?>">
                <i class="fa fa-angle-left"></i>
            </a>
            <?php endif; ?>

            <?php for($i = 1; $i <= $old_products->lastPage(); $i++): ?>
                <a href="<?php echo e($old_products->url($i)); ?>" class="<?php echo e($i == $old_products->currentPage() ? 'current' : ''); ?>"><?php echo e($i); ?></a>
                <?php endfor; ?>

                <?php if($old_products->currentPage() < $old_products->lastPage()): ?>
                    <a href="<?php echo e($old_products->nextPageUrl()); ?>">
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <?php endif; ?>
        </div>

        <?php echo $__env->make('home.chat_messenger', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

     
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/all_old_product.blade.php ENDPATH**/ ?>