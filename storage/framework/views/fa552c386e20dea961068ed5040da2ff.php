<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Thế giới điện thoại</title>
    <link rel="shortcut icon" href="home/img/favicon.ico" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">

    <!-- owl carousel libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('home/js/owlcarousel/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/js/owlcarousel/owl.theme.default.min.css')); ?>">
    <script src="<?php echo e(asset('home/js/Jquery/Jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home/js/owlcarousel/owl.carousel.min.js')); ?>"></script>

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
    <link rel="stylesheet" href="<?php echo e(asset('home/css/home_products.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/pagination_phantrang.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/chitietsanpham.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/footer.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/carousel_home.css?version=1.1')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="<?php echo e(asset('home/js/home.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('home/data/products.js')); ?>"></script> -->
    <!-- <script src="home/js/classes.js"></script> -->
    <script src="<?php echo e(asset('home/js/dungchung.js')); ?>"></script>
    <script src="<?php echo e(asset('home/js/trangchu.js')); ?>"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

</head>

<body>
    <?php echo $__env->make('home.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section>
        <?php echo $__env->make('home.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Header -->

        <?php echo $__env->make('home.brand', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('home.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Banner -->
        <br>
        <!-- Bộ lọc -->

        <?php echo $__env->make('home.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- End khung chọn bộ lọc -->



        <!-- Div hiển thị khung sp hot, khuyến mãi, mới ra mắt ... -->
        <div class="contain-khungSanPham">
            <!-- SẢN PHẨM MỚI -->
            <?php echo $__env->make('home.new_product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <hr>
            <!-- GIÁ RẺ CHO MỌI NHÀ  -->
            <?php echo $__env->make('home.cheap_price', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <hr>
            <!-- NỔI BẬT NHẤT -->
            <?php echo $__env->make('home.bestseller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <hr>
            <!-- TRẢ GÓP 0% -->
            <!-- <?php echo $__env->make('home.installment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <hr> -->
            <!-- GIÁ SỐC ONLINE -->
            <!-- <?php echo $__env->make('home.price_shock', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <hr> -->
            <!-- GIẢM GIÁ LỚN -->
            <!-- <?php echo $__env->make('home.discount', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <hr> -->

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

        //Carousel

        let currentIndex = 0;

        function showSlide(index) {
            const carouselInner = document.querySelector('.carousel-inner');
            const totalSlides = document.querySelectorAll('.carousel-item').length;

            if (index >= totalSlides) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = totalSlides - 1;
            } else {
                currentIndex = index;
            }

            const transformValue = -currentIndex * 100 + '%';
            carouselInner.style.transform = 'translateX(' + transformValue + ')';
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        // Autoplay example
        setInterval(nextSlide, 3000);
    </script>
    <?php echo $__env->make('home.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/userpage.blade.php ENDPATH**/ ?>