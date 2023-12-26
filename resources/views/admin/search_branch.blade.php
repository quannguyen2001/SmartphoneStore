<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý chi nhánh</title>
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
            <!-- Thêm mới hãng -->
            <div id="addBranchModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <!-- Your existing form content goes here -->
                    <form id="addBranchForm" action="{{url('/add_branch')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- Your existing form fields go here -->
                        <div class="div_modal_center">
                            <h2 style="font-size: 25px;">Thêm mới chi nhánh</h2>

                            <form action="{{url('/add_branch')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="content">
                                    <div class="div_design">
                                        <label>Địa chỉ:</label>
                                        <input class="text_color" type="text" name="address" placeholder="Nhập địa chỉ cửa hàng" required="">
                                    </div>

                                    <div class="div_design">
                                        <label>Thành phố</label>
                                        <select class="text_color" name="city" id="citySelect" required="">
                                            <option value="" disabled selected>Chọn tên thành phố</option>
                                            <option value="Hà Nội">Hà Nội</option>
                                            <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                            <option value="Đà Nẵng">Đà Nẵng</option>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>Quận:</label>
                                        <select class="text_color" name="district" id="districtSelect" required="">
                                            <option value="" disabled selected>Chọn tên quận</option>
                                            <!-- Các option của quận sẽ được cập nhật bằng JavaScript -->
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>Số điện thoại:</label>
                                        <input class="text_color" type="text" name="phone" placeholder="Nhập số điện thoại" required="">
                                    </div>

                                    <div class="div_design">
                                        <label>Link bản đồ:</label>
                                        <input class="text_color" type="text" name="link_map" placeholder="Nhập link bản đồ" required="">
                                    </div>

                                </div>
                                <br>
                                <input type="submit" class="btn btn-primary" name="submit" style="background-color: lightgray;" value="Thêm mới">
                            </form>

                        </div>

                        <br>

                    </form>
                </div>
            </div>
            <!-- Hết thêm mới hãng -->

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
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-chi-nhanh')}}"><b style="color: blue;"> Quản lý chi nhánh </b></a></p>
                    </div>

                    <div class="div_center">
                        <h2 class="h2_font">Danh sách chi nhánh</h2>
                        <div>
                            <input type="text" id="searchInput" style="color: black;" placeholder="Nhập thông tin cần tìm">
                            <button id="searchButton" class="btn btn-outline-primary" style="color: black; background-color: lightgreen; font-weight: bold; width: 100px; height: 38px;">Tìm kiếm</button>
                        </div>

                        <div class="center">
                            <table class="center">
                                <tr>
                                    <td><b>ID</b></td>
                                    <td><b>Chi nhánh</b></td>
                                    <td><b>Quận</b></td>
                                    <td><b>Thành phố</b></td>
                                    <td><b>Số điện thoại</b></td>
                                    <td><b>Link bản đồ</b></td>

                                    <td><a id="addBranchButton" class="btn btn-primary" href="javascript:void(0);"><b>Thêm mới</b></a></td>
                                </tr>

                                @foreach($branches as $branch)
                                <tr>
                                    <td>{{$branch->id}}</td>
                                    <td>{{$branch->address}}</td>
                                    <td>{{$branch->district}}</td>
                                    <td>{{$branch->city}}</td>
                                    <td>{{$branch->phone}}</td>
                                    <td style="max-width: 400px; overflow: hidden;  white-space: nowrap; text-overflow: ellipsis;">{{$branch->link_map}}</td>
                                    <td>
                                        <div class="button">
                                            <a class="btn btn-primary" href="{{url('chinh-sua-chi-nhanh',$branch->id)}}"><b>Chỉnh sửa</b></a>
                                        </div>
                                        <div class="button">
                                            <a class="btn btn-danger delete_branch" href="{{url('xoa-hang',$branch->id)}}" data-branch-name="{{$branch->address}}"><b>Xóa</b></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach


                            </table>
                            <div class="pagination">
                                @if ($branches->previousPageUrl())
                                <a href="{{ $branches->previousPageUrl() }}{{ $branches->total() > 1 ? '&search=' . $searchText : '' }}">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                @endif

                                @for ($i = 1; $i <= $branches->lastPage(); $i++)
                                    <a href="{{ $branches->url($i) }}{{ $branches->total() > 1 ? '&search=' . $searchText : '' }}" class="{{ $i == $branches->currentPage() ? 'current' : '' }}">
                                        {{ $i }}
                                    </a>
                                    @endfor

                                    @if ($branches->nextPageUrl())
                                    <a href="{{ $branches->nextPageUrl() }}{{ $branches->total() > 1 ? '&search=' . $searchText : '' }}">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    @endif
                            </div>
                            <!-- <div class="pagination">
                                {{ $branches->links('pagination::bootstrap-4') }}
                            </div> -->
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
        // Handle search button click
        $('#searchButton').on('click', function() {
            // Get the search input value
            var searchValue = $('#searchInput').val();

            // Perform the search action using JavaScript or redirect to the search URL
            // You can adjust this part based on your application's requirements

            // For example, redirect to the search URL
            window.location.href = '{{url("search_branch")}}?search=' + encodeURIComponent(searchValue);
        });
    });

    // $(document).ready(function() {
    //     $('#brand_id').on('change', function() {
    //         var brand_id = $(this).val();
    //         if (brand_id) {
    //             $.ajax({
    //                 type: "GET",
    //                 url: '/get-products/' + brand_id, // Thay đổi đường dẫn tới route xử lý
    //                 dataType: "json",
    //                 success: function(data) {
    //                     $('#product_id').empty();
    //                     $.each(data, function(key, value) {
    //                         $('#product_id').append('<option value="' + key + '">' + value + '</option>');
    //                     });
    //                     $('#product_id').attr('size', 1); // Điều chỉnh chiều cao tùy ý
    //                 }
    //             });
    //         } else {
    //             $('#product_id').empty();
    //             $('#product_id').attr('size', 1); // Điều chỉnh chiều cao tùy ý
    //         }
    //     });
    // });

    //Modal thêm mới hãng
    // Get the modal
    var modal = document.getElementById('addBranchModal');

    // Get the button that opens the modal
    var addButton = document.getElementById('addBranchButton'); // Add an id to your "Thêm mới" button

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName('close')[0];

    // When the user clicks the button, open the modal
    addButton.onclick = function() {
        modal.style.display = 'block';
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    //Xóa hãng
    $(document).ready(function() {
        $(".delete_branch").click(function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

            var brandName = $(this).data('brand-name');
            var deleteUrl = $(this).attr('href'); // Lấy địa chỉ URL để xóa

            if (brandName && !$(this).data('clicked')) {
                Swal.fire({
                    title: 'Xác nhận xóa ',
                    text: 'Bạn có muốn xóa hãng ' + brandName + ' không?',
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
                                    'Bạn đã xóa hãng ' + brandName + ' thành công' +
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

    //Thong bao
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
                    showNotification('Thêm mới thành công!');
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