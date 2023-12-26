<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Thông tin thanh toán VNPAY</title>
    <link rel="shortcut icon" href="{{ asset('home/img/favicon.ico') }}" />

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
    <link rel="stylesheet" href="{{ asset('home/css/chitietsanpham.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/footer.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/vnpay_return.css?version=1.1') }}">

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

        <?php
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        /*
        * To change this license header, choose License Headers in Project Properties.
        * To change this template file, choose Tools | Templates
        * and open the template in the editor.
        */

        $vnp_TmnCode = ""; //Website ID in VNPAY System
        $vnp_HashSecret = ""; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        ?>

        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Thông tin thanh toán VNPAY </b></a></p>
        </div>
        <div class="container">
            <div class="header_payment">
                <h3><b>Thông tin thanh toán VNPAY</b></h3>
            </div>
            <div class="payment_info">
                <div class="payment_info_item">
                    <label><b>Mã đơn hàng:</b></label>

                    <label><?php echo $_GET['vnp_TxnRef'] ?></label>
                </div>
                <div class="payment_info_item">

                    <label><b>Số tiền:</b></label>
                    <label>{{ number_format($_GET['vnp_Amount']/100, 0, ',', '.') }}₫</label>
                </div>
                <div class="payment_info_item">
                    <label><b>Nội dung thanh toán:</b></label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div>
                <!-- <div class="payment_info_item">
                    <label ><b>Mã phản hồi (vnp_ResponseCode):</b></label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div>  -->
                <div class="payment_info_item">
                    <label><b>Mã giao dịch tại VNPAY:</b></label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div>
                <div class="payment_info_item">
                    <label><b>Mã ngân hàng:</b></label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div>
                <div class="payment_info_item">
                    <label><b>Thời gian thanh toán:</b></label>
                    <label>{{ \Carbon\Carbon::parse($_GET['vnp_PayDate'])->format('H:i:s d-m-Y') }}</label>
                </div>
                <div class="payment_info_item">
                    <label><b>Kết quả:</b></label>
                    <label>
                        <?php

                        if ($_GET['vnp_ResponseCode'] == 00) {
                            echo "<span style='color:blue'><b>Giao dịch thành công</b></span>";
                        } else {
                            echo "<span style='color:red'><b>Giao dịch không thành công</b></span>";
                        }

                        ?>

                    </label>
                </div>
                @if ($_GET['vnp_ResponseCode'] == 00) 
                <div class="payment_thanks">
                    <p><b>Cảm ơn khách hàng đã mua sản phẩm của chúng tôi!</b></p>
                    <a href="/" class="return"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Quay lại trang chủ</a>
                </div>

                 @else 
                    <div class="payment_thanks">
                    <p><b>Giao dịch của quý khách không thành công!</b></p>
                    <a href="/" class="return"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Quay lại trang chủ</a>
                </div>
                
                @endif

            </div>
            <p>
                &nbsp;
            </p>
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