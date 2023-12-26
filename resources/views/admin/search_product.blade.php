<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý sản phẩm</title>
    @include('admin.css')

</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="menu-select">
                        <div class="menu-select-item"><a href="/redirect">Trang chủ</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-tai-khoan')}}">Quản lý tài khoản</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-hang')}}">Quản lý hãng</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-banner')}}">Quản lý banner</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-san-pham')}}">Quản lý sản phẩm</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-hinh-anh')}}">Quản lý hình ảnh</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-don-hang')}}">Quản lý đơn hàng</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-chi-nhanh')}}">Quản lý chi nhánh</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-kho')}}">Quản lý kho</a></div>
                        <div class="menu-select-item"><a href="{{url('quan-ly-dien-thoai-cu')}}">Quản lý điện thoại cũ</a></div>
                        <!-- <div class="menu-select-item"><a href="{{url('quan-ly-dien-thoai-cu')}}">Quản lý điện thoại cũ</a></div>
      <div class="menu-select-item"><a href="{{url('quan-ly-dien-thoai-cu')}}">Quản lý điện thoại cũ</a></div> -->
                    </div>
                    <div class="breadcrumb">
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-san-pham')}}"><b style="color: blue;"> Quản lý sản phẩm </b></a></p>
                    </div>
                    <div class="div_center">
                        <h2 class="h2_font">Danh sách sản phẩm</h2>
                        <div>
                            <form action="{{url('search_product')}}" method="get">
                                @csrf
                                <input type="text" style="color: black;" name="search" placeholder="Nhập thông tin cần tìm">
                                <input type="submit" value="Tìm kiếm" class="btn btn-outline-primary" style="color: black; background-color: lightgreen; font-weight: bold; width: 100px; height: 38px;">
                            </form>
                        </div>

                        <div class="center"> <!-- Đổi thẻ div để bọc bảng -->
                            <table class="center">
                                <tr>
                                    <td><b>STT</b></td>
                                    <td><b>Tên sản phẩm</b></td>
                                    <td><b>Hãng sản xuất</b></td>
                                    <td><b>Giá sản phẩm</b></td>
                                    <td><b>Năm sản xuât</b></td>
                                    <td><b>Camera sau</b></td>
                                    <td><b>Camera trước</b></td>
                                    <td><b>Chip</b></td>
                                    <td><b>RAM</b></td>
                                    <td><b>ROM</b></td>
                                    <td><b>Dung lượng PIN</b></td>
                                    <td><a onclick="" class="btn btn-primary" href="{{url('them-moi-san-pham')}}"><b>Thêm mới</b></a></td>
                                </tr>

                                @foreach($products as $product)
                                <tr>
                                    <td>{{$startKey++}}</td>
                                    <!-- <td style="padding-left: 10px;">
                    <img style="width: 360px; height: 150px; object-fit: cover;" src="/product_img/{{$product->image}}">
                  </td> -->
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->brand->title}}</td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }}₫</td>
                                    <td>{{$product->year}}</td>
                                    <td>{{$product->camera_sau}}</td>
                                    <td>{{$product->camera_truoc}}</td>
                                    <td>{{$product->chip}}</td>
                                    <td>{{$product->ram}}</td>
                                    <td>{{$product->rom}}</td>
                                    <td>{{$product->pin}} mAh</td>
                                    <td style="width: 120px; padding-left: 5px;">
                                        <div class="button">
                                            <a class="btn btn-success" href="{{url('thong-tin-chi-tiet',$product->id)}}"><b>Chi tiết</b></a>
                                        </div>
                                        <div class="button">
                                            <a class="btn btn-primary" href="{{url('chinh-sua-san-pham',$product->id)}}"><b>Chỉnh sửa</b></a>
                                        </div>
                                        <div class="button">
                                            <a class="btn btn-danger delete_product" href="{{url('xoa-san-pham',$product->id)}}" data-product-name="{{$product->name}}"><b>Xóa</b></a>
                                        </div>


                                    </td>
                                </tr>
                                @endforeach


                            </table>
                            <div class="pagination">
                                @if ($old_products->previousPageUrl())
                                <a href="{{ $old_products->previousPageUrl() }}{{ $old_products->total() > 1 ? '&search=' . $searchText : '' }}">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                @endif

                                @for ($i = 1; $i <= $old_products->lastPage(); $i++)
                                    <a href="{{ $old_products->url($i) }}{{ $old_products->total() > 1 ? '&search=' . $searchText : '' }}" class="{{ $i == $old_products->currentPage() ? 'current' : '' }}">
                                        {{ $i }}
                                    </a>
                                    @endfor

                                    @if ($old_products->nextPageUrl())
                                    <a href="{{ $old_products->nextPageUrl() }}{{ $old_products->total() > 1 ? '&search=' . $searchText : '' }}">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>
<script>
    $(document).ready(function() {
        $(".delete_product").click(function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

            var productName = $(this).data('product-name');
            var deleteUrl = $(this).attr('href'); // Lấy địa chỉ URL để xóa

            if (productName && !$(this).data('clicked')) {
                Swal.fire({
                    title: 'Xác nhận xóa sản phẩm',
                    text: 'Bạn có muốn xóa sản phẩm ' + productName + ' không?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl, // Sử dụng địa chỉ URL lấy được ở trên
                            type: 'GET',
                            success: function(response) {
                                var notification = $("<div class='alert'>" +
                                    "<span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>" +
                                    'Bạn đã xóa sản phẩm ' + productName + ' thành công' +
                                    "</div>");
                                $("body").append(notification);

                                setTimeout(function() {
                                    notification.remove(); // Xóa thông báo sau 3 giây
                                }, 3000);

                                $(this).data('clicked', true);
                                // Reload the page to display updated data
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                var errorMessage = xhr.status + ': ' + xhr.statusText
                                Swal.fire('Có lỗi xảy ra!', errorMessage, 'error');
                            }
                        });
                    }
                });
            }
        });
    });
</script>