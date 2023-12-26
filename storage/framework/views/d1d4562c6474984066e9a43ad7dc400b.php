<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Hệ thống cửa hàng</title>
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
    <link rel="stylesheet" href="<?php echo e(asset('home/css/all_branches.css?version=1.1')); ?>">

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
            <p><a href="/"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Hệ thống cửa hàng </b></a></p>
        </div>
        <div class="contaniner">
            <div class="page-gt"> 
                <h1 style="text-align: center; font-size: 20px;"><b>Hệ thống cửa hàng của THẾ GIỚI ĐIỆN THOẠI trên toàn quốc</b></h1>
                    <div class="branch">
                        <?php $__currentLoopData = $branch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="branch_item">
                            <div class="picture">
                            <i class="fa fa-university" aria-hidden="true"></i>
                            </div>
                            <div class="content">
                                <div class="name">
                                    <p><b>Cửa hàng <?php echo e($branch->address); ?></b></p>
                                </div>
                                <div class="address">
                                    <p><b>Địa chỉ: </b><?php echo e($branch->address); ?>, <?php echo e($branch->district); ?>, <?php echo e($branch->city); ?></p>
                                </div>
                                <div class="phone">
                                    <p><b>Số điện thoại:</b> <?php echo e($branch->phone); ?></p>
                                </div>
                                <div class="link">
                                    <a href="<?php echo e(url('cua-hang/' .$branch->slug)); ?>"><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Xem bản đồ</b></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
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

    <!-- <i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i> -->
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/all_branches.blade.php ENDPATH**/ ?>