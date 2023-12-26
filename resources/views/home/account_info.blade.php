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
    <link rel="stylesheet" href="{{ asset('home/css/style.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/topnav.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/header.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/banner.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/taikhoan.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/trangchu.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/chitietsanpham.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/footer.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/account_management.css?version=1.1') }}">

    <!-- js -->
    <script src="home/data/products.js"></script>
    <script src="home/js/classes.js"></script>
    <script src="home/js/dungchung.js"></script>
    <!-- <script src="home/js/trangchu.js"></script> -->

</head>

<body>
    @include('home.header')
    <section>
        @include('home.navbar')
        <!-- End Header -->

        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href="{{url('thong-tin-tai-khoan')}}"><b> Quản lý tài khoản </b></a>><a href="{{url('thong-tin-tai-khoan')}}"><b style="color: blue;"> Thông tin tài khoản </b></a></p>
        </div>
        <div class="contaniner">
            <div class="sidebar">
                <div class="menu"><b>Quản lý tài khoản</b></div>
                <a href="{{url('thong-tin-tai-khoan')}}" class="menu-item" id="thong-tin-tai-khoan">
                    <div class="sidebar_item"><b><i class="fa fa-list" aria-hidden="true"></i> Thông tin tài khoản</b></div>
                </a>
                <a href="{{url('chinh-sua-thong-tin')}}" class="menu-item" id="chinh-sua-thong-tin">
                    <div class="sidebar_item"><b><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa thông tin</b></div>
                </a>
                <a href="{{url('doi-mat-khau')}}" class="menu-item" id="doi-mat-khau">
                    <div class="sidebar_item"><b><i class="fa fa-exchange" aria-hidden="true"></i> Đổi mật khẩu</b></div>
                </a>
                <a href="{{url('thong-tin-don-hang')}}" class="menu-item" id="thong-tin-don-hang">
                    <div class="sidebar_item"><b><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin đơn hàng</b></div>
                </a>
                <a href="{{ route('logout') }}" class="menu-item" id="dang-xuat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="sidebar_item"><b><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</b></div>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <div>
                <div class="div_center">
                    <p><b style="font-size: 20px; ">Thông tin tài khoản</b></p>
                    <div class="div_design">
                        <label><b>Tên khách hàng:</b></label>
                        <input class="text_color" type="text" name="name" placeholder="Nhập tên của bạn" required="" value="{{$user->name}}" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Email:</b></label>
                        <input class="text_color" type="text" name="email" placeholder="Nhập email của bạn" required="" value="{{$user->email}}" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Địa chỉ:</b></label>
                        <input class="text_color" type="text" name="address" placeholder="Nhập địa chỉ giao hàng" required="" value="{{$user->address}}" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Số điện thoại:</b></label>
                        <input class="text_color" type="text" name="phone" placeholder="Nhập số điện thoại của bạn" required="" value="{{$user->phone}}" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Thời gian tạo:</b></label>
                        <input class="text_color" type="text" name="phone" placeholder="" value="{{ \Carbon\Carbon::parse($user->created_at)->format('H:i:s d-m-Y') }}" readonly>
                    </div>

                    <div class="div_design">
                        <label><b>Lần cập nhật gần nhất:</b></label>
                        <input class="text_color" type="text" name="phone" placeholder="" value="{{ \Carbon\Carbon::parse($user->created_at)->format('H:i:s d-m-Y') }}" readonly>
                    </div>
                </div>
            </div>

        </div>
        @include('home.chat_messenger')
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
    @include('home.footer')

     
</body>



</html>