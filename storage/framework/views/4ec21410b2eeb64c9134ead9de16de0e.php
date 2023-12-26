<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Thông tin tài khoản</title>
    <link rel="shortcut icon" href="home/img/favicon.ico" />

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
    <link rel="stylesheet" href="<?php echo e(asset('home/css/chitietsanpham.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/footer.css?version=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/account_management.css?version=1.0')); ?>">

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

        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href="<?php echo e(url('thong-tin-tai-khoan')); ?>"><b> Quản lý tài khoản </b></a>><a href="<?php echo e(url('thong-tin-tai-khoan')); ?>"><b style="color: blue;"> Thông tin tài khoản </b></a></p>
        </div>
        <div class="contaniner">
            <div class="sidebar">
                <div class="menu"><b>Quản lý tài khoản</b></div>
                <a href="<?php echo e(url('thong-tin-tai-khoan')); ?>"><div class="sidebar_item"><b>Thông tin tài khoản</b></div></a>
                <a href="<?php echo e(url('thong-tin-tai-khoan')); ?>"><div class="sidebar_item"><b>Chỉnh sửa thông tin</b></div></a>
                <a href="<?php echo e(url('thong-tin-tai-khoan')); ?>"><div class="sidebar_item"><b>Đổi mật khẩu</b></div></a>
                <a href="<?php echo e(url('thong-tin-tai-khoan')); ?>"><div class="sidebar_item"><b>Thống kê chi tiêu</b></div></a>
            </div>
            <div>
                <div class="div_center">
                    <div class="div_design">
                        <p><b>Thông tin tài khoản</b></p>
                        <label><b>Tên khách hàng:</b></label>
                        <input class="text_color" type="text" name="name" placeholder="Nhập tên của bạn" required="" value="<?php echo e($user->name); ?>" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Email:</b></label>
                        <input class="text_color" type="text" name="email" placeholder="Nhập email của bạn" required="" value="<?php echo e($user->email); ?>" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Địa chỉ:</b></label>
                        <input class="text_color" type="text" name="address" placeholder="Nhập địa chỉ giao hàng" required="" value="<?php echo e($user->address); ?>" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Số điện thoại:</b></label>
                        <input class="text_color" type="text" name="phone" placeholder="Nhập số điện thoại của bạn" required="" value="<?php echo e($user->phone); ?>" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Thời gian tạo:</b></label>
                        <input class="text_color" type="text" name="phone" placeholder="" value="<?php echo e(\Carbon\Carbon::parse($user->created_at)->format('H:i:s d-m-Y')); ?>" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Lần cập nhật gần nhất:</b></label>
                        <input class="text_color" type="text" name="phone" placeholder="" value="<?php echo e(\Carbon\Carbon::parse($user->created_at)->format('H:i:s d-m-Y')); ?>" readonly>
                    </div>

                    
                </div>
            </div>

            <!-- <div>
            <form action="<?php echo e(url('/update_user_info',$user->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="div_center">
                    <div class="div_design">
                        <p><b>Thông tin tài khoản</b></p>
                        <label><b>Tên khách hàng:</b></label>
                        <input class="text_color" type="text" name="name" placeholder="Nhập tên của bạn" required="" value="<?php echo e($user->name); ?>" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Email:</b></label>
                        <input class="text_color" type="text" name="email" placeholder="Nhập email của bạn" required="" value="<?php echo e($user->email); ?>" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Địa chỉ giao hàng:</b></label>
                        <input class="text_color" type="text" name="address" placeholder="Nhập địa chỉ giao hàng" required="" value="<?php echo e($user->address); ?>">
                    </div>

                    <div class="div_design">
                        <label><b>Số điện thoại:</b></label>
                        <input class="text_color" type="text" name="phone" placeholder="Nhập số điện thoại của bạn" required="" value="<?php echo e($user->phone); ?>">
                    </div>

                    <input type="submit" class="button" name="submit" value="Cập nhật thông tin tài khoản">
                </div>

            </form>
            </div> -->
            
        </div>
    </section> <!-- End Section -->

    <script>
        // addContainTaiKhoan();
        // addPlc();
    </script>
    <?php echo $__env->make('home.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/account_management.blade.php ENDPATH**/ ?>