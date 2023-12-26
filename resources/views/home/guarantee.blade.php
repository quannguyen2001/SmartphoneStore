<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Bảo hành</title>
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
    <link rel="stylesheet" href="{{ asset('home/css/baohanh.css?version=1.1') }}">
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
            <p><a href="/"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Bảo hành </b></a></p>
        </div>
        <table>
            <tr>
                <td colspan="4" class="header-table">
                    <marquee behavior="scroll" direction=left>Các trung tâm bảo hành của Thế giới điện thoại</marquee>
                </td>
            </tr>
            <tr>
                <th class="col1">STT</th>
                <th class="col2">Địa chỉ</th>
                <th class="col3">Điện thoại</th>
                <th class="col4">Thời gian làm việc</th>
            </tr>

            <script>
                var trungtam = [
                    ["10F2, Hồ Trung Thành, P7 – Tp. Cà Mau, Tỉnh Cà Mau"       , "(0780)-2212 158" , "8h00 - 17h00"],
                    ["14A2 Trần Nguyên Hãn, P.Mỹ Long, Long Xuyên, An Giang"    , "076.3841649"     , "8h00 - 17h00"],
                    ["114 Tô Hiệu, Quận Lê Chân, Tp. Hải Phòng"                 , "(031)-384 7689"  , "8h00 - 17h00"],
                    ["32 Lương Khánh Thiện, Tp. Hải phòng"                      , "0924713257"      , "8h00 - 17h00"],
                    ["123 Nam Kỳ Khởi Nghĩa, Tp. Vũng Tàu, Tỉnh BRVT"           , "(064)-3531 248"  , "8h00 - 17h00"],
                    ["157 Ngô Gia Tự, Phường Ngô Quyền, TP Bắc Giang"           , "(0240)-3820 349" , "8h00 - 17h00"],
                    ["32 Lương Khánh Thiện, Tp. Hải phòng"                      , "(0781)-3827 676" , "8h00 - 17h00"],
                    ["139 Nguyễn Văn Cừ, Tp. Bắc Ninh, Tỉnh Bắc Ninh"           , "(0241)-3812767"  , "8h00 - 17h00"],
                    ["39 Nguyễn Đình Chiểu, P 1, Tx. Bến Tre, Tỉnh Bến Tre"     , "(075)-3814 701"  , "8h00 - 17h00"],
                    ["10A, Lý Thường Kiệt, Tp. Quy Nhơn, Tỉnh Bình Định"        , "(056)-3821 788"  , "8h00 - 17h00"],
                    ["42 Phố 11 Vân Giang, P. Vân Giang, Tp. Ninh Bình"         , "(030)-389 3408"  , "8h00 - 17h00"],
                    ["283 Cách Mạng Tháng Tám, TX.Thủ Dầu Một, Tỉnh Bình Dương" , "0650.3831528"    , "8h00 - 17h00"],
                    ["47 Khu 2, P. Phước Bình, Tx. Phước Long, Bình Phước"      , "(0651)-3774 789" , "8h00 - 17h00"],
                    ["20 Nguyễn Hội P.Phú Trinh Tp.Phan Thiết, Tỉnh Bình Thuận" , "062.382853"      , "8h00 - 17h00"],
                    ["76 Nguyễn Đình Chiểu, P 2, Tp. Cao Lãnh, Đồng Tháp"       , "(067)-3874 686"  , "8h00 - 17h00"]
                ]

                // for (var i = 0; i < trungtam.length; i++) {
                //     var link = 'https://maps.google.com/maps?q=' + trungtam[i][0];
                //     document.write(`
                //         <tr>
                //             <td class="col1">` + (i + 1) + `</td>
                //             <td class="col2"> 
                //                 <a href="`+link+`" target="_blank" title="Xem bản đồ">
                //                     ` + trungtam[i][0] +`
                //                 </a>
                //             </td>
                //             <td class="col3">` + trungtam[i][1] +`</td>
                //             <td class="col4">` + trungtam[i][2] +`</td>
                //         </tr>
                //     `)
                // }
            </script>
        </table>
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