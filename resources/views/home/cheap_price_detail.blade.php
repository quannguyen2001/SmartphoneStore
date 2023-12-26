<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sản phẩm giá rẻ</title>
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
    <link rel="stylesheet" href="{{ asset('home/css/home_products.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/chitietsanpham.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/pagination_phantrang.css?version=1.1') }}">
    <link rel=" stylesheet" href="{{ asset('home/css/footer.css?version=1.1') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <!-- <script src="home/data/products.js"></script> -->
    <!-- <script src="home/js/classes.js"></script>
    <script src="home/js/dungchung.js"></script>
    <script src="home/js/trangchu.js"></script> -->

</head>

<body>
    @include('home.header')
    <section>
        @include('home.navbar')
        <!-- End Header -->
        <div class="companyMenu group flexContain">
            @foreach($brands as $brands)
            <a href="{{url('dien-thoai',$brands->slug)}}"><img src="{{ asset('brand_img/' . $brands->image) }}"></a>
            @endforeach
            <!-- <a href="index.html?company=Apple"><img src="home/img/company/Apple.jpg"></a> -->
        </div>

        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href="{{url('dien-thoai-chinh-hang')}}"><b> Điện thoại </b></a>><a href=""><b style="color: blue;"> Sản phẩm điện thoại giá rẻ </b></a></p>
        </div>

        <div class="filterName">
            <h1 style="font-size: 25px;"><b>Danh sách sản phẩm điện thoại giá rẻ</b></h1>
        </div> <!-- End FilterName -->

        <ul id="products" class="homeproduct group flexContain">
            <!-- <div id="khongCoSanPham">
                <i class="fa fa-times-circle"></i>
                Không có sản phẩm nào
            </div>  -->
            <!-- End Khong co san pham -->
            @foreach($products as $product)
            <li class="sanPham">
                <a href="{{url('chi-tiet-san-pham/' .$product->slug)}}">
                    <img src="{{ asset('product_img/' . $product->image) }}" alt="">
                    <h3><b>{{$product->name}}</b></h3>
                    <div class="price">
                        @if($product->old_price > $product->price)
                        <b class="price_old_product">
                            {{ number_format($product->old_price, 0, ',', '.') }}₫
                        </b>
                        <?php
                        $discountPercentage = round(($product->old_price - $product->price) / $product->old_price * 100);
                        ?>
                        <b class="price_percent_product">-{{ $discountPercentage }}%</b>
                        @endif
                        <div>
                            <strong>{{ number_format($product->price, 0, ',', '.') }}₫</strong>
                        </div>
                    </div>
                    <div class="rom_ram">
                        <h3><b>RAM:</b> {{$product->ram}} &nbsp<b>ROM:</b> {{$product->rom}}</h3>
                    </div>
                    <label class="tragop">
                        Trả góp 0%
                    </label>
                    <!-- <div class="tooltip">
                        <form action="{{url('add_cart',$product->id)}}" method="post" id="add-to-cart-form">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" style="width: 100px;" hidden>

                            <input class="themvaogio" type="submit" value="+" @if(Auth::id()) data-product-name="{{$product->name}}" @else onclick="submitForm()" @endif>
                            <span class="tooltiptext" style="font-size: 15px;">Thêm vào giỏ</span>

                        </form>
                    </div> -->
                </a>
            </li>
            @endforeach



        </ul><!-- End products -->

        <div class="pagination">
            @if ($products->currentPage() > 1)
            <a href="{{ $products->previousPageUrl() }}">
                <i class="fa fa-angle-left"></i>
            </a>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <a href="{{ $products->url($i) }}" class="{{ $i == $products->currentPage() ? 'current' : '' }}">{{ $i }}</a>
                @endfor

                @if ($products->currentPage() < $products->lastPage())
                    <a href="{{ $products->nextPageUrl() }}">
                        <i class="fa fa-angle-right"></i>
                    </a>
                    @endif
        </div>


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
    </script>
    @include('home.footer')

     
</body>

</html>