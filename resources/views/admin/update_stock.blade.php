<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cập nhật kho</title>
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
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-kho')}}"><b> Quản lý kho </b></a>><a href=""><b style="color: blue;"> Cập nhật thông tin kho</b></a></p>
                    </div>
                    <div class="div_center">
                        <h2 class="h2_font">Cập nhật kho</h2>

                        <form action="{{url('/update_stock_confirm',$stock->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="content">
                                <div class="div_design">
                                    <label>Tên chi nhánh:</label>
                                    <select class="text_color" id="branch_id" name="branch_id"" required="">
                                            <option value=" {{$stock->branch_id}}">{{$stock->branch->address}}</option>
                                        @foreach($branch as $branch)
                                        <option value="{{$branch->id}}">{{$branch->address}}, {{$branch->district}}, {{$branch->city}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="div_design">
                                    <label>Hãng sản xuất:</label>
                                    <select class="text_color" id="brand_id" name="brand_id">
                                        <option value="" disabled selected>Chọn hãng sản xuất</option>
                                        @foreach($brand as $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="div_design">
                                    <label>Tên điện thoại:</label>
                                    <select class="text_color" id="product_id" name="product_id"" required="">
                                            <option value=" {{$stock->product_id}}">{{$stock->product->name}}</option>
                                    </select>
                                </div>

                                <div class="div_design">
                                    <label>Màu sắc:</label>
                                    <select class="text_color" id="color_id" name="color_id" required="">
                                        <option value="{{$stock->color->id}}">{{$stock->color->color}}</option>
                                    </select>
                                </div>

                                <div class="div_design">
                                    <label>Số lượng:</label>
                                    <input class="text_color" type="text" name="quantity" placeholder="Nhập số lượng" value="{{$stock->quantity}}" required="">
                                </div>

                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary" name="submit" style="background-color: lightgray;" value="Cập nhật">
                        </form>


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
        $('#brand_id').on('change', function() {
            var brand_id = $(this).val();
            if (brand_id) {
                $.ajax({
                    type: "GET",
                    url: '/get-products/' + brand_id, // Thay đổi đường dẫn tới route xử lý
                    dataType: "json",
                    success: function(data) {
                        $('#product_id').empty();
                        $.each(data, function(key, value) {
                            $('#product_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#product_id').attr('size', 1); // Điều chỉnh chiều cao tùy ý
                    }
                });
            } else {
                $('#product_id').empty();
                $('#product_id').attr('size', 1); // Điều chỉnh chiều cao tùy ý
            }
        });
    });

    $(document).ready(function() {
        // Function to show notification
        function showNotification(message) {
            var notification = $("<div class='notification'>" +
                "<span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>" +
                message +
                "</div>");
            $("body").append(notification);
        }

        // Function to handle form submission
        $("form").submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    showNotification('Cập nhật thành công!');
                    // Reload the page to display updated data
                    location.reload();
                },
                error: function(xhr, status, error) {
                    showNotification('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            });
        });
    });
</script>