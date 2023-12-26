<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cập nhật chi nhánh</title>
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
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-chi-nhanh')}}"><b> Quản lý chi nhánh </b></a>><a href=""><b style="color: blue;"> Cập nhật thông tin chi nhánh</b></a></p>
                    </div>
                    <div class="div_center">
                        <h2 class="h2_font">Cập nhật chi nhánh</h2>

                        <form action="{{url('/update_branch_confirm',$branch->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="content">
                                <div class="div_design">
                                    <label>Địa chỉ:</label>
                                    <input class="text_color" type="text" name="address" placeholder="Nhập địa chỉ cửa hàng" value="{{$branch->address}}" required="">
                                </div>

                                <div class="div_design">
                                    <label>Thành phố</label>
                                    <select class="text_color" name="city" id="citySelect" required="">
                                        <option value="{{$branch->city}}">{{$branch->city}}</option>
                                        <option value="Hà Nội">Hà Nội</option>
                                        <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                        <option value="Đà Nẵng">Đà Nẵng</option>
                                    </select>
                                </div>

                                <div class="div_design">
                                    <label>Quận:</label>
                                    <select class="text_color" name="district" id="districtSelect" required="">
                                        <option value="{{$branch->district}}">{{$branch->district}}</option>
                                        <!-- Các option của quận sẽ được cập nhật bằng JavaScript -->
                                    </select>
                                </div>

                                <div class="div_design">
                                    <label>Số điện thoại:</label>
                                    <input class="text_color" type="text" name="phone" placeholder="Nhập số điện thoại" value="{{$branch->phone}}" required="">
                                </div>

                                <div class="div_design">
                                    <label>Link bản đồ:</label>
                                    <input class="text_color" type="text" name="link_map" placeholder="Nhập link bản đồ" value="{{$branch->link_map}}" required="">
                                </div>

                                <div class="div_design">
                                    <label>Slug:</label>
                                    <input class="text_color" type="text" name="slug" placeholder="Nhập slug" value="{{$branch->slug}}" required="" readonly>
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
    //Lấy danh sách quận từ tên thành phố
    document.getElementById('citySelect').addEventListener('change', function() {
        var citySelect = document.getElementById('citySelect');
        var districtSelect = document.getElementById('districtSelect');

        // Xóa tất cả các option hiện tại trong select quận
        districtSelect.innerHTML = '<option value="" disabled selected>Chọn tên quận</option>';

        // Lấy giá trị thành phố đã chọn
        var selectedCity = citySelect.value;

        // Thêm các option mới tương ứng với thành phố đã chọn
        if (selectedCity === 'Hà Nội') {
            var hanoiDistricts = ["Quận Ba Đình", "Quận Bắc Từ Liêm", "Quận Nam Từ Liêm", "Quận Cầu Giấy", "Quận Đống Đa", "Quận Hà Đông", "Quận Hai Bà Trưng", "Quận Hoàn Kiếm", "Quận Hoàng Mai", "Quận Long Biên", "Quận Tây Hồ", "Quận Thanh Xuân"];
            addOptionsToSelect(hanoiDistricts);
        } else if (selectedCity === 'Hồ Chí Minh') {
            var hcmcDistricts = ["Quận 1", "Quận 2", "Quận 3", "Quận 4", "Quận 5", "Quận 6", "Quận 7", "Quận 8", "Quận 9", "Quận 10", "Quận 11", "Quận 12"];
            addOptionsToSelect(hcmcDistricts);
        } else if (selectedCity === 'Đà Nẵng') {
            var danangDistricts = ["Quận Cẩm Lệ", "Quận Hải Châu", "Quận Liên Chiểu", "Quận Ngũ Hành Sơn", "Quận Sơn Trà", "Quận Thanh Khê"];
            addOptionsToSelect(danangDistricts);
        }
    });

    function addOptionsToSelect(districts) {
        var districtSelect = document.getElementById('districtSelect');
        // Thêm các option mới vào select quận
        for (var i = 0; i < districts.length; i++) {
            var option = document.createElement('option');
            option.value = districts[i];
            option.text = districts[i];
            districtSelect.add(option);
        }
    }

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