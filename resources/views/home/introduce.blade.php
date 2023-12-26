<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Giới thiệu</title>
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
    <link rel="stylesheet" href="{{ asset('home/css/gioithieu.css?version=1.1') }}">

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
            <p><a href="/"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Giới thiệu </b></a></p>
        </div>
        <div class="contaniner">
            <div class="page-gt">
                <!-- <h4 class="page-header">
                Giới thiệu công ty chúng tôi
            </h4> -->
                <div class="page-info">
                    <p>Được thành lập từ năm 2010, chúng tôi là một trong những nhà phân phối ĐTDĐ chính thức phân phối ĐTDĐ Samsung duy nhất
                        tại 55 Giải Phóng.
                    </p>
                    <br />

                    <p>
                        Với bề dày hơn 10 năm kinh nghiệm và uy tín đã tạo được trong những năm vừa qua, chúng tôi luôn đem
                        lại cho khách hàng sự hài lòng và thỏa mãn với tất cả các sản phẩm của mình.<br />
                        Bên cạnh đó là đội ngũ nhân viên nhiệt tình chu đáo và đầy kinh nghiệm của chúng tôi luôn đưa được
                        ra cho khách hàng những thông tin có giá trị và giúp khách hàng lựa chọn được những sản phẩm phù
                        hợp nhất.<br />
                        Để nâng cao thương hiệu của mình, mục tiêu của chúng tôi trong thời gian tới là cung cấp đến tận
                        tay khách hàng những sản phẩm chính hãng với chất lượng đảm bảo và uy tín cũng như giá cả hợp lý
                        nhất.<br />
                    </p>
                    <div class="img">
                        <img class="img" src="{{asset('home\img\24_800x450.png')}}" alt="">
                    </div>
                    <p>
                        Chúng tôi mong muốn sự đóng góp của khách hàng sẽ giúp chúng tôi ngày một phát triển để từ đó củng
                        cố thêm lòng tin của khách hàng với chúng tôi. Chúng tôi rất biết ơn sự tin tưởng của khách hàng
                        trong suốt gần 10 năm qua và chúng tôi luôn tâm niệm rằng cần phải cố gắng hơn nữa để xứng đáng với
                        phương châm đề ra “Nếu những gì chúng tôi không có, nghĩa là bạn không cần .<br />
                        Chúng tôi xin chân thành cảm ơn tất cả các khách hàng đã, đang và sẽ ủng hộ chúng tôi.
                    </p>
                </div>
            </div>
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