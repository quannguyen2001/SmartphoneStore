<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Thông tin banner</title>
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
    <link rel="stylesheet" href="{{ asset('home/css/style.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/topnav.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/header.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/banner.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/taikhoan.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/trangchu.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/chitietsanpham.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/footer.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/khuyenmai.css?version=1.1') }}">
    <!-- js -->
    <script src="home/data/products.js"></script>
    <script src="home/js/classes.js"></script>
    <script src="home/js/dungchung.js"></script>
    <script src="home/js/trangchu.js"></script>

</head>

<body>
    @include('home.header')
    <section>
        @include('home.navbar')
        <!-- End Header -->
        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> banner </b></a></p>
        </div>
        <h1 style="text-align: center; font-size: 30px;"><b>Thông tin các banner</b></h1>

        <div class="body-tintuc">

            @foreach($banner as $banner)
            <div class="tintuc-info">
                <a href="{{$banner->link}}" target="_blank">
                    <img src="banner_img/{{$banner->image}}">
                    <h2><b>{{$banner->title}}</b></h2>
                </a>
                <br />
                <h5>{{$banner->description}}</h5>
            </div>
            @endforeach

            <!-- <div class="tintuc-info">
                <a href="https://thanhnien.vn/cong-nghe/kham-pha-smartphone-man-hinh-gap-duoc-dau-tien-cua-samsung-1027111.html" target="_blank">
                    <img src="home/img/tintuc/tintuc2.png">
                    <h2>Khám phá smartphone màn hình gập được đầu tiên của Samsung</h2>
                </a>
                <br/>
                <h5>Thanh niên &emsp; 6 giờ</h5>
            </div>
            <div class="tintuc-info">
                <a href="https://vov.vn/cong-nghe/doanh-so-iphone-xs-va-iphone-xr-tham-hai-apple-san-xuat-lai-iphone-x-843717.vov" target="_blank">
                    <img src="home/img/tintuc/tintuc3.png">
                    <h2>Doanh số iPhone XS và iPhone XR thảm hại, Apple sản xuất lại iPhone X</h2>
                </a>
                <br/>
                <h5>VOV &emsp; 6 giờ</h5>
            </div>
            <div class="tintuc-info">
                <a href="http://vietq.vn/chiec-dien-thoai-thong-minh-nay-cua-lg-se-co-toi-16-camera-d151674.html" target="_blank">
                    <img src="home/img/tintuc/tintuc4.png">
                    <h2>Chiếc điện thoại thông minh này của LG sẽ có tới 16 Camera</h2>
                </a>
                <br/>
                <h5>VietQ &emsp; 13 giờ</h5>
            </div>
            <div class="tintuc-info" style="border-bottom: 0;">
                <a href="https://news.zing.vn/nhung-tieu-chi-ban-khong-nen-bo-qua-khi-mua-smartphone-2018-post894509.html" target="_blank">
                    <img src="home/img/tintuc/tintuc5.png" height="148px" width="224px;">
                    <h2>Những tiêu chí bạn không nên bỏ qua khi mua smartphone 2018</h2>
                </a>
                <br/>
                <h5>Zing &emsp; 9 giờ</h5>
            </div>  -->

        </div>
        @include('home.chat_messenger')
    </section> <!-- End Section -->

    <script>
        // addContainTaiKhoan();
        // addPlc();
    </script>
    @include('home.footer')


</body>

</html>