<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cửa hàng <?php echo e($branch->address); ?>, <?php echo e($branch->district); ?>, <?php echo e($branch->city); ?></title>
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
    <link rel="stylesheet" href="<?php echo e(asset('home/css/style.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/topnav.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/header.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/banner.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/taikhoan.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/trangchu.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/chitietsanpham.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/footer.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/gioithieu.css?version=1.1')); ?>">

    <!-- js -->
    <script src="home/data/products.js"></script>
    <script src="home/js/classes.js"></script>
    <script src="home/js/dungchung.js"></script>
    <script src="home/js/trangchu.js"></script>

</head>

<body>
    <?php echo $__env->make('home.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section>
        <?php echo $__env->make('home.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Header -->

        <?php echo $__env->make('home.brand', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href="<?php echo e(url('he-thong-cua-hang')); ?>"><b> Hệ thống cửa hàng </b></a>><a href=""><b style="color: blue;"> Cửa hàng <?php echo e($branch->address); ?>, <?php echo e($branch->district); ?>, <?php echo e($branch->city); ?> </b></a></p>
        </div>
        <div class="contaniner">
            <div class="page-gt">
                <!-- <h4 class="page-header">
                Giới thiệu công ty chúng tôi
            </h4> -->
                <div class="page-info">
                    <p><b><i class="fa fa-shopping-bag" aria-hidden="true" style="color: gray;"></i> Tên cửa hàng:</b> Cửa hàng <?php echo e($branch->address); ?></p>
                    <p><b><i class="fa fa-info-circle" aria-hidden="true" style="color: gray;"></i> Địa chỉ:</b> <?php echo e($branch->address); ?>, <?php echo e($branch->district); ?>, <?php echo e($branch->city); ?></p>
                    <p><b><i class="fa fa-phone" aria-hidden="true" style="color: gray;"></i> Số điện thoại liên hệ:</b> <?php echo e($branch->phone); ?></p>
                    <br />
                    
                    <div>
                    <iframe src="<?php echo e($branch->link_map); ?>" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('home.chat_messenger', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section> <!-- End Section -->

    <script>
        // addContainTaiKhoan();
        // addPlc();
    </script>
    <?php echo $__env->make('home.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/branch_location.blade.php ENDPATH**/ ?>