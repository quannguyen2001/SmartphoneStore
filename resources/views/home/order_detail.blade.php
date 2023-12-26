<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Đơn hàng {{$order_id}}</title>
    <link rel="shortcut icon" href="home/img/favicon.ico" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">

    <!-- tidio - live chat -->
    <!-- <script src="//code.tidio.co/bfiiplaaohclhqwes5xivoizqkq56guu.js"></script> -->

    <!-- our files -->
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('home/css/style.css?version=1.1') }}">
	<link rel="stylesheet" href="{{ asset('home/css/topnav.css?version=1.1') }}">
	<link rel="stylesheet" href="{{ asset('home/css/header.css?version=1.1') }}">
	<link rel="stylesheet" href="{{ asset('home/css/banner.css?version=1.1') }}">
	<link rel="stylesheet" href="{{ asset('home/css/trangchu.css?version=1.1') }}">
	<link rel="stylesheet" href="{{ asset('home/css/taikhoan.css?version=1.1') }}">
	<link rel="stylesheet" href="{{ asset('home/css/gioHang.css?version=1.1') }}">
	<link rel="stylesheet" href="{{ asset('home/css/footer.css?version=1.1') }}">
    <!-- js -->
    <script src="{{ asset('home/data/products.js') }}"></script>
    <script src="{{ asset('home/js/classes.js') }}"></script>
    <script src="{{ asset('home/js/dungchung.js') }}"></script>
    <script src="{{ asset('home/js/trangchu.js') }}"></script>
    <!-- <script src="{{ asset('home/js/giohang.js') }}"></script> -->

</head>

<body>
    @include('home.header')
    <section>
        @include('home.navbar')

        @include('home.brand')

		<div class="breadcrumb">
			<p><a href="/"><b>Trang chủ </b></a>><a href="{{url('don-hang')}}"><b> Đơn hàng </b></a>><a href=""><b style="color: blue;"> Đơn hàng mã số {{$order_id}}</b></a></p>
		</div>
        <h1 style="text-align: center; font-weight: bold; font-size: 30px;">Thông tin chi tiết đơn hàng mã số {{$order_id}}</h1>
        <div class="table_product" style="min-height: 350px">
            <table class="listSanPham">
                <tbody>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Thành tiền</th>
                        <th>Thời gian đặt hàng</th>
                        <th>Thông tin sản phẩm</th>
                    </tr>
                    <?php $totalprice = 0;  ?>
                    <?php $totalproduct = 0;  ?>
                    @foreach($order as $order)
                    <tr>
                        <td style="padding-left: 5px; min-width: 110px;"><img width="100px" height="150px" src="{{ asset('product_img/' . $order->product->image) }}"></td>
                        <td class="noPadding" style="min-width: 200px;">{{ $order->product->name }}</td>
                        <td class="noPadding" style="min-width: 120px; text-align: center;">{{ $order->color }}</td>
                        <td class="soluong" style="min-width: 100px;">

                            <input size="1" value="{{ $order->quantity }}" readonly>

                        </td>
                        <td class="noPadding" style="min-width: 150px; text-align: center;">{{ number_format($order->price, 0, ',', '.') }}₫</td>
                        <td class="noPadding" style="min-width: 170px; text-align: center;">{{ number_format($order->total, 0, ',', '.') }}₫</td>
                        <td class="noPadding" style="min-width: 170px;">{{ \Carbon\Carbon::parse($order->time)->format('H:i:s d-m-Y') }}</td>
                        <td class="noPadding" style="min-width: 150px;"> <a href="{{url('/chi-tiet-san-pham',$order->product->slug)}}">Xem thông tin</a></td>


                    </tr>
                    <?php $totalprice = $totalprice + $order->total ?>
                    <?php $totalproduct = $totalproduct + $order->quantity ?>
                    @endforeach
                    <tr style="font-weight:bold; text-align:center">
                        <td colspan="5">TỔNG TIỀN: </td>
                        <td class="alignRight">{{ number_format($totalprice, 0, ',', '.') }}₫</td>
                        <td> TỔNG SỐ LƯỢNG: </td>
                        <td>{{$totalproduct}}</td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
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
    </script>
    @include('home.footer')

     
</body>

</html>