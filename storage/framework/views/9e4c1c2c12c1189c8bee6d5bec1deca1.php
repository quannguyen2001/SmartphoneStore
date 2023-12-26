<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Đổi mật khẩu</title>
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
    <!-- <script src="home/js/trangchu.js"></script> -->

</head>

<body>
    <?php echo $__env->make('home.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section>
        <?php echo $__env->make('home.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Header -->

        <?php if(session('success')): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                html: '<?php echo session('
                success '); ?>',
            });
        </script>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Đã có lỗi xảy ra!',
                html: '<?php echo session('
                error '); ?>',
            });
        </script>
        <?php endif; ?>
        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href="<?php echo e(url('thong-tin-tai-khoan')); ?>"><b> Quản lý tài khoản </b></a>><a href=""><b style="color: blue;"> Đổi mật khẩu </b></a></p>
        </div>
        <div class="contaniner">
            <div class="sidebar">
                <div class="menu"><b>Quản lý tài khoản</b></div>
                <a href="<?php echo e(url('thong-tin-tai-khoan')); ?>" class="menu-item" id="thong-tin-tai-khoan">
                    <div class="sidebar_item"><b><i class="fa fa-list" aria-hidden="true"></i> Thông tin tài khoản</b></div>
                </a>
                <a href="<?php echo e(url('chinh-sua-thong-tin')); ?>" class="menu-item" id="chinh-sua-thong-tin">
                    <div class="sidebar_item"><b><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa thông tin</b></div>
                </a>
                <a href="<?php echo e(url('doi-mat-khau')); ?>" class="menu-item" id="doi-mat-khau">
                    <div class="sidebar_item"><b><i class="fa fa-exchange" aria-hidden="true"></i> Đổi mật khẩu</b></div>
                </a>
                <a href="<?php echo e(url('thong-tin-don-hang')); ?>" class="menu-item" id="thong-tin-don-hang">
                    <div class="sidebar_item"><b><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin đơn hàng</b></div>
                </a>
                <a href="<?php echo e(route('logout')); ?>" class="menu-item" id="dang-xuat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="sidebar_item"><b><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</b></div>
                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>

            <div>
                <form action="<?php echo e(url('/change-password',$user->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="div_center" style="height: 300px;">
                        <p><b style="font-size: 20px;">Đổi mật khẩu</b></p>
                        <div class="div_design">
                            <label for="current_password"><b>Mật khẩu hiện tại:</b></label>
                            <input type="password" name="current_password" placeholder="Nhập mật khẩu hiện tại" required>
                        </div>
                        <div class="div_design">
                            <label for="new_password"><b>Mật khẩu mới:</b></label>
                            <input type="password" name="new_password" placeholder="Nhập mật khẩu mới (trên 8 ký tự)" required>
                        </div>
                        <div class="div_design">
                            <label for="new_password_confirmation"><b>Xác nhận mật khẩu mới:</b></label>
                            <input type="password" name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới (trên 8 ký tự)" required>
                        </div>
                        <?php if($errors->any()): ?>
                        <div class="message">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><b><?php echo e($error); ?></b></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                        <input type="submit" class="button" value="Cập nhật mật khẩu mới">
                    </div>
                </form>


            </div>

        </div>
    </section> <!-- End Section -->

    <script>
        // Lấy đường dẫn URL hiện tại
        var currentURL = window.location.href;

        // Tách phần path từ URL
        var pathArray = window.location.pathname.split('/');

        // Lấy phần cuối cùng của path (tên trang)
        var currentPage = pathArray[pathArray.length - 1];

        // Kiểm tra từng liên kết và thêm class 'active' nếu href giống với trang hiện tại
        var menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(function(item) {
            var itemURL = item.getAttribute('href');
            if (currentURL.indexOf(itemURL) !== -1 || currentPage === itemURL) {
                item.classList.add('active');
            }
        });
    </script>
    <?php echo $__env->make('home.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/account_change_pass.blade.php ENDPATH**/ ?>