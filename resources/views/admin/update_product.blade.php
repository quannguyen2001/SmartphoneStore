<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cập nhật sản phẩm</title>
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
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-san-pham')}}"><b> Quản lý sản phẩm </b></a>><a href=""><b style="color: blue;"> Cập nhật sản phẩm {{$product->name}} </b></a></p>
                    </div>
                    <div class="div_center">
                        <h2 class="h2_font">Cập nhật sản phẩm {{$product->name}}</h2>

                        <form action="{{url('/update_product_confirm',$product->id)}}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="column_content">
                                <div>
                                    <div class="div_design">
                                        <label>Tên sản phẩm:</label>
                                        <input class="text_color" type="text" name="name" placeholder="Nhập tên sản phẩm" required="" value="{{$product->name}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Hãng sản xuất:</label>
                                        <select class="text_color" name="brand_id" required="">
                                            <option value="{{$product->brand_id}}" selected>
                                                {{$product->brand->title}}
                                            </option>

                                            @foreach($brand as $brand)
                                            @if($product->brand_id!=$brand->id)
                                            <option value="{{$brand->id}}">{{$brand->title}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>Giá sản phẩm:</label>
                                        <input class="text_color" type="text" name="price" placeholder="Nhập giá sản phẩm" required="" value="{{$product->price}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Giá cũ của sản phẩm:</label>
                                        <input class="text_color" type="text" name="old_price" placeholder="Nhập giá sản phẩm" required="" value="{{$product->old_price}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Năm sản xuất:</label>
                                        <input class="text_color" type="text" name="year" placeholder="Nhập năm sản xuất" required="" value="{{$product->year}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Màn hình:</label>
                                        <input class="text_color" type="text" name="screen" placeholder="Nhập thống số màn hình" required="" value="{{$product->screen}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Cổng sạc:</label>
                                        <input class="text_color" type="text" name="port" placeholder="Nhập loại cổng sạc" required="" value="{{$product->port}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Phần mềm:</label>
                                        <input class="text_color" type="text" name="software" placeholder="Nhập thông số phần mềm" required="" value="{{$product->software}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Camera sau:</label>
                                        <input class="text_color" type="text" name="camera_sau" placeholder="Nhập thông số camera" required="" value="{{$product->camera_sau}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Camera trước:</label>
                                        <input class="text_color" type="text" name="camera_truoc" placeholder="Nhập thông số camera" required="" value="{{$product->camera_truoc}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Chip:</label>
                                        <input class="text_color" type="text" name="chip" placeholder="Nhập tên chip" required="" value="{{$product->chip}}">
                                    </div>

                                    <div class="div_design">
                                        <label>RAM:</label>
                                        <select class="text_color" name="ram" required="">
                                            <option value="{{$product->ram}}" selected>
                                                @if($product->ram=='Không có')
                                                Không có
                                                @elseif($product->ram=='2 GB')
                                                2 GB
                                                @elseif($product->ram=='4 GB')
                                                4 GB
                                                @elseif($product->ram=='6 GB')
                                                6 GB
                                                @elseif($product->ram=='8 GB')
                                                8 GB
                                                @else
                                                12 GB
                                                @endif
                                            </option>
                                            @if($product->ram=='Không có')
                                            <option value="2 GB">2 GB</option>
                                            <option value="4 GB">4 GB</option>
                                            <option value="6 GB">6 GB</option>
                                            <option value="8 GB">8 GB</option>
                                            <option value="12 GB">12 GB</option>
                                            @elseif($product->ram=='2 GB')
                                            <option value="Không có">Không có</option>
                                            <option value="4 GB">4 GB</option>
                                            <option value="6 GB">6 GB</option>
                                            <option value="8 GB">8 GB</option>
                                            <option value="12 GB">12 GB</option>
                                            @elseif($product->ram=='4 GB')
                                            <option value="Không có">Không có</option>
                                            <option value="2 GB">2 GB</option>
                                            <option value="6 GB">6 GB</option>
                                            <option value="8 GB">8 GB</option>
                                            <option value="12 GB">12 GB</option>
                                            @elseif($product->ram=='6 GB')
                                            <option value="Không có">Không có</option>
                                            <option value="2 GB">2 GB</option>
                                            <option value="4 GB">4 GB</option>
                                            <option value="8 GB">8 GB</option>
                                            <option value="12 GB">12 GB</option>
                                            @elseif($product->ram=='8 GB')
                                            <option value="Không có">Không có</option>
                                            <option value="2 GB">2 GB</option>
                                            <option value="4 GB">4 GB</option>
                                            <option value="6 GB">6 GB</option>
                                            <option value="12 GB">12 GB</option>
                                            @else
                                            <option value="Không có">Không có</option>
                                            <option value="2 GB">2 GB</option>
                                            <option value="4 GB">4 GB</option>
                                            <option value="6 GB">6 GB</option>
                                            <option value="8 GB">8 GB</option>
                                            @endif

                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>ROM:</label>
                                        <select class="text_color" name="rom" required="">
                                            <option value="{{$product->rom}}" selected>
                                                @if($product->rom=='Không có')
                                                Không có
                                                @elseif($product->rom=='64 GB')
                                                64 GB
                                                @elseif($product->rom=='128 GB')
                                                128 GB
                                                @elseif($product->rom=='256 GB')
                                                256 GB
                                                @elseif($product->rom=='512 GB')
                                                512 GB
                                                @else
                                                1 TB
                                                @endif
                                            </option>
                                            @if($product->rom=='Không có')
                                            <option value="64 GB">64 GB</option>
                                            <option value="128 GB">128 GB</option>
                                            <option value="256 GB">256 GB</option>
                                            <option value="512 GB">512 GB</option>
                                            <option value="1 TB">1 TB</option>
                                            @elseif($product->rom=='64 GB')
                                            <option value="Không có">Không có</option>
                                            <option value="128 GB">128 GB</option>
                                            <option value="256 GB">256 GB</option>
                                            <option value="512 GB">512 GB</option>
                                            <option value="1 TB">1 TB</option>
                                            @elseif($product->rom=='128 GB')
                                            <option value="Không có">Không có</option>
                                            <option value="64 GB">64 GB</option>
                                            <option value="256 GB">256 GB</option>
                                            <option value="512 GB">512 GB</option>
                                            <option value="1 TB">1 TB</option>
                                            @elseif($product->rom=='256 GB')
                                            <option value="Không có">Không có</option>
                                            <option value="64 GB">64 GB</option>
                                            <option value="128 GB">128 GB</option>
                                            <option value="512 GB">512 GB</option>
                                            <option value="1 TB">1 TB</option>
                                            @elseif($product->rom=='512 GB')
                                            <option value="Không có">Không có</option>
                                            <option value="64 GB">64 GB</option>
                                            <option value="128 GB">128 GB</option>
                                            <option value="256 GB">256 GB</option>
                                            <option value="1 TB">1 TB</option>
                                            @else
                                            <option value="Không có">Không có</option>
                                            <option value="64 GB">64 GB</option>
                                            <option value="128 GB">128 GB</option>
                                            <option value="256 GB">256 GB</option>
                                            <option value="512 GB">512 GB</option>
                                            @endif

                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>SIM:</label>
                                        <input class="text_color" type="text" name="sim" placeholder="Nhập thông số SIM (số khe SIM)" required="" value="{{$product->sim}}">
                                    </div>
                                </div>
                                <div>
                                    <div class="div_design">
                                        <label>Dung lượng PIN (mAh):</label>
                                        <input class="text_color" type="text" name="pin" placeholder="Nhập dung lượng PIN" required="" value="{{$product->pin}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Link youtube:</label>
                                        <input class="text_color" type="text" name="link" placeholder="Nhập link youtube" required="" value="{{$product->link}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Hộp phụ kiện:</label>
                                        <input class="text_color" type="text" name="accessories" placeholder="Nhập thông tin" required="" value="{{$product->accessories}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Khuyến mại:</label>
                                        <input class="text_color" type="text" name="promotion" placeholder="Nhập thông tin khuyến mại" required="" value="{{$product->promotion}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Loại sản phẩm:</label>
                                        <select class="text_color" name="type" required="">
                                            <option value="{{$product->type}}" selected>
                                                @if($product->type==1)
                                                Sản phẩm mới
                                                @elseif($product->type==2)
                                                Sản phẩm bán chạy
                                                @else
                                                Sản phẩm giá rẻ
                                                @endif
                                            </option>
                                            @if($product->type==1)
                                            <option value="2">Sản phẩm bán chạy</option>
                                            <option value="3">Sản phẩm giá rẻ</option>
                                            @elseif($product->type==2)
                                            <option value="1">Sản phẩm mới</option>
                                            <option value="3">Sản phẩm giá rẻ</option>
                                            @else
                                            <option value="1">Sản phẩm mới</option>
                                            <option value="2">Sản phẩm bán chạy</option>
                                            @endif

                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>Mô tả sản phẩm:</label>
                                        <input class="text_color" type="text" name="description" placeholder="Nhập mô tả sản phẩm" required="" value="{{$product->description}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Slug:</label>
                                        <input class="text_color" type="text" name="slug" placeholder="Slug" value="{{$product->slug}}" readonly>
                                    </div>

                                    <div class="div_design">
                                        <label></label>
                                        <img style="margin: auto" height="200" width="200" src="/product_img/{{$product->image}}">
                                    </div>

                                    <div class="div_design">
                                        <label>Hình ảnh sản phẩm mới:</label>
                                        <input type="file" name="image">
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div>
                                <input type="submit" class="btn btn-primary button" name="submit" value="Cập nhât">
                            </div>

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