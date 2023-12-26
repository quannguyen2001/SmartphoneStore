<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Giỏ hàng</title>
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
    <link rel="stylesheet" href="{{ asset('home/css/trangchu.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/taikhoan.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/gioHang.css?version=1.1') }}">
    <link rel="stylesheet" href="{{ asset('home/css/footer.css?version=1.1') }}">


    <!-- js -->
    <script src="home/data/products.js"></script>
    <script src="home/js/classes.js"></script>
    <script src="home/js/dungchung.js"></script>
    <script src="js/giohang.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    @include('home.header')
    <section>
        @include('home.navbar')

        @include('home.brand')

        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Giỏ hàng </b></a></p>
        </div>

        <h1 style="text-align: center; font-weight: bold; font-size: 30px;">Thông tin giỏ hàng</h1>

        <div class="table_product" style="min-height: 300px">
            <table class="listSanPham">
                <tbody>
                    @if(count($cart) > 0)
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Màu sắc</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                        <th>Thời gian mua</th>
                        <th>Xóa</th>
                    </tr>

                    <?php $totalprice = 0;  ?>
                    <?php $totalproduct = 0;  ?>
                    <?php $total = 0;  ?>
                    @foreach($cart as $key => $carts)
                    <tr>
                        <td style="min-width: 40px;">{{$key+1}}</td>
                        <td class="noPadding imgHide" style="min-width: 210px;">
                            <a target="_blank" href="{{url('chi-tiet-san-pham/' .$carts->product->slug)}}" title="Xem chi tiết">
                                {{$carts->product->name}}
                                <img src="{{ asset('product_img/' . $carts->product->image) }}">
                            </a>
                        </td>

                        <td class="soluong noPadding" style="min-width: 170px;">
                            <a href="{{url('/decrease_product_cart',$carts->id)}}"><button onclick="giamSoLuong('Xia2')"><i class="fa fa-minus"></i></button></a>
                            <input size="1" value="{{$carts->quantity}}" readonly>
                            <a href="{{url('/increase_product_cart',$carts->id)}}"><button onclick="tangSoLuong('Xia2')"><i class="fa fa-plus"></i></button></a>
                        </td>
                        <td class="noPadding" style="min-width: 150px; text-align:center;">
                            {{$carts->color}}
                        </td>
                        <td class="alignRight" style="min-width: 150px;">{{ number_format($carts->product->price, 0, ',', '.') }}₫</td>
                        <?php $total = $carts->product->price * $carts->quantity;  ?>
                        <td class="alignRight" style="min-width: 150px;">{{ number_format($total, 0, ',', '.') }}₫</td>
                        <td class="alignRight" style="min-width: 190px;">{{ \Carbon\Carbon::parse($carts->time)->format('H:i:s d-m-Y') }}</td>
                        <td class="noPadding"> <a href="{{url('/remove_cart',$carts->id)}}" class="delete_cart" data-product-name="{{$carts->product->name}}" data-color-name="{{$carts->color}}"><i class="fa fa-trash"></i></a> </td>
                    </tr>
                    <?php $totalprice = $totalprice + $total ?>
                    <?php $totalproduct = $totalproduct + $carts->quantity ?>
                    @endforeach

                    <tr style="font-weight:bold; text-align:center">
                        <td colspan="2"> TỔNG SỐ LƯỢNG: </td>
                        <td>{{$totalproduct}}</td>
                        <td colspan="2">TỔNG TIỀN: </td>
                        <td class="alignRight">{{ number_format($totalprice, 0, ',', '.') }}₫</td>
                        <td colspan="3"></td>
                    </tr>
                    @else
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                        <th>Thời gian mua</th>
                        <th>Xóa</th>
                    </tr>
                    <tr>
                        <td colspan="7">Giỏ hàng chưa có sản phẩm nào!!!</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>

        @if(count($cart) > 0)
        <h2 style="text-align: center;" class="h2_font"><b>Thông tin giao hàng</b></h2>
        <form action="{{url('/update_user_info',$user_id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="div_center">
                <div class="div_design">
                    <label><b>Tên khách hàng:</b></label>
                    <input class="text_color" type="text" name="name" placeholder="Nhập tên của bạn" required="" value="{{$user_name}}" readonly>
                </div>

                <div class="div_design">
                    <label><b>Email:</b></label>
                    <input class="text_color" type="text" name="email" placeholder="Nhập email của bạn" required="" value="{{$user_email}}" readonly>
                </div>

                <div class="div_design">
                    <label><b>Địa chỉ giao hàng:</b></label>
                    <input class="text_color" type="text" name="address" placeholder="Nhập địa chỉ giao hàng" required="" value="{{$user_address}}">
                </div>

                <div class="div_design">
                    <label><b>Số điện thoại:</b></label>
                    <input class="text_color" type="text" name="phone" placeholder="Nhập số điện thoại của bạn" required="" value="{{$user_phone}}">
                </div>

                <input type="submit" class="button" name="submit" value="Cập nhật thông tin giao hàng">
            </div>

        </form>
        @endif
        @if(count($cart) > 0)
        <div class="div_button">
            <a href="{{url('cash_order')}}" onclick="notification(); return false;" class="button_cash">Thanh toán trả sau</a>
            <a href="javascript:void(0);" class="button_vnpay">
                <form action="{{url('/vnpay_payment')}}" method="POST">
                    @csrf

                    <input type="hidden" name="total" value="{{$totalprice}}">
                    <button type="submit" name="redirect" style="color: black;">Thanh toán VNPAY</button>
                </form>
            </a>
            <!-- <a href="#" class="button_vnpay">Thanh toán VNPAY</a> -->
        </div>
        @endif

        <!-- <div class="div_center">
            <a href="" class="button_vnpay">Thanh toán VNPAY</a>
        </div> -->



        @include('home.chat_messenger')

    </section> <!-- End Section -->


    @include('home.footer')


</body>

</html>
<script>
    //Xoa san pham trong gio hang
    $(document).ready(function() {
        $(".delete_cart").click(function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

            var productName = $(this).data('product-name');

            var colorName = $(this).data('color-name');

            if (productName && colorName && !$(this).data('clicked')) {
                Swal.fire({
                    title: 'Xác nhận xóa sản phẩm',
                    text: 'Bạn có muốn xóa sản phẩm ' + productName + ' màu ' + colorName + ' khỏi giỏ hàng không?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Sử dụng SweetAlert thay vì thông báo thông thường
                        Swal.fire({

                            title: 'Đã xóa thành công !!!',
                            text: 'Bạn đã xóa sản phẩm ' + productName + ' màu ' + colorName + ' khỏi giỏ hàng',
                            showConfirmButton: false,
                            timer: 2500
                        });

                        $(this).data('clicked', true);

                        // Tiếp tục với việc xóa sản phẩm khỏi giỏ hàng
                        window.location.href = $(this).attr('href');
                    }
                });
            }
        });
    });

    //Cap nhat thong tin giao hang
    $(document).ready(function() {
        $(".button").click(function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của biểu mẫu

            var form = $(this).closest('form');
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(response) {
                    showNotification('Đã cập nhật thông tin giao hàng thành công');
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    console.log(errorMessage); // Ghi lỗi vào console để kiểm tra
                }
            });
        });
    });

    function showNotification(message) {
        var notification = $("<div class='alert'>" +
            "<span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>" +
            message +
            "</div>");
        $("body").append(notification);

        setTimeout(function() {
            notification.remove(); // Xóa thông báo sau 3 giây
        }, 3000);
    }

    //Dat hang
    function showNotification(message, onConfirm) {
        let swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'button_vnpay',
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons.fire({
            title: message,
            icon: 'success',
            timer: 1500,
            timerProgressBar: true,
            onBeforeOpen: function() {
                // Chờ 1.5 giây trước khi tự đóng
                setTimeout(function() {
                    swalWithBootstrapButtons.close();
                }, 1500);
            },
        }).then(function() {
            if (onConfirm) {
                onConfirm();
            }
        });
    }

    function notification() {
        showNotification('Đã đặt hàng thành công', function() {
            // Sau khi hoàn tất, chuyển hướng đến URL `{{url('cash_order')}}`
            setTimeout(function() {
                window.location.href = 'cash_order';
            }, 1500); // Chờ 1.5 giây trước khi chuyển hướng
        });
    }
</script>