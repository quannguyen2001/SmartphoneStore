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
    <link rel="stylesheet" href="{{ asset('home/js/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/js/owlcarousel/owl.theme.default.min.css') }}">
    <script src="{{ asset('home/js/Jquery/Jquery.min.js') }}"></script>
    <script src="{{ asset('home/js/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- tidio - live chat -->
    <!-- <script src="//code.tidio.co/bfiiplaaohclhqwes5xivoizqkq56guu.js"></script> -->

    <!-- our files -->
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('home/css/style.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/topnav.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/header.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/banner.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/taikhoan.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/trangchu.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/home_products.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/pagination_phantrang.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/chitietsanpham.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/footer.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/carousel_home.css?version=1.1') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('home/js/home.js') }}"></script>
    <!-- <script src="{{ asset('home/data/products.js') }}"></script> -->
    <!-- <script src="home/js/classes.js"></script> -->
    <script src="{{ asset('home/js/dungchung.js') }}"></script>
    <script src="{{ asset('home/js/trangchu.js') }}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

</head>

<body>
    @include('home.header')
    <section>
        @include('home.navbar')
        <!-- End Header -->

        @include('home.brand')

        @include('home.banner')
        <!-- End Banner -->
        <br>
        <!-- Bộ lọc -->

        @include('home.filter')

        <!-- End khung chọn bộ lọc -->



        <!-- Div hiển thị khung sp hot, khuyến mãi, mới ra mắt ... -->
        <div class="contain-khungSanPham">
            <!-- SẢN PHẨM MỚI -->
            @include('home.new_product')
            <hr>
            <!-- GIÁ RẺ CHO MỌI NHÀ  -->
            @include('home.cheap_price')
            <hr>
            <!-- NỔI BẬT NHẤT -->
            @include('home.bestseller')
            <hr>
            <!-- TRẢ GÓP 0% -->
            <!-- @include('home.installment')
            <hr> -->
            <!-- GIÁ SỐC ONLINE -->
            <!-- @include('home.price_shock')
            <hr> -->
            <!-- GIẢM GIÁ LỚN -->
            <!-- @include('home.discount')
            <hr> -->

        </div>

        @include('home.chat_messenger')

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
    @include('home.footer')


</body>

</html>