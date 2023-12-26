<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{$product->name}}</title>
    <link rel="shortcut icon" href="{{ asset('home/img/favicon.ico') }}" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">

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
    <link rel="stylesheet" href="{{ asset('home/css/chitietsanpham.css?version=1.2') }}">
    <link rel="stylesheet" href="{{ asset('home/css/footer.css?version=1.1') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('home/js/home.js') }}"></script>
    <script src="{{ asset('home/data/products.js') }}"></script>
    <script src="{{ asset('home/js/classes.js') }}"></script>
    <script src="{{ asset('home/js/dungchung.js') }}"></script>
    <script src="{{ asset('js/chitietsanpham.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    @include('home.header')
    <section>
        @include('home.navbar')
        <!-- End Header -->

        @include('home.brand')

        <!-- Modal -->
        <div id="Modal" class="modal" style="overflow: hidden;">
            <div class="modal-content" style="margin: 10% auto !important;">
                <span class="close">&times;</span>
                <!-- Your existing form content goes here -->
                <form id="Form">

                    <!-- Your existing form fields go here -->
                    <div class="div_modal_center">
                        <h2 style="font-size: 25px;"><b>Xem cửa hàng có sản phẩm</b></h2>


                        <div class="content">
                            <div class="div_design">
                                <label style="width: 27%;"><b>Thành phố:</b></label>
                                <select class="text_color" name="city" id="citySelect" style="width: 65%;" required="">
                                    <option value="" disabled selected>Chọn tên thành phố</option>
                                    <option value="Hà Nội">Hà Nội</option>
                                    <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                    <option value="Đà Nẵng">Đà Nẵng</option>
                                </select>
                            </div>

                            <div class="div_design">
                                <label style="width: 27%;"><b>Quận:</b></label>
                                <select class="text_color" name="district" id="districtSelect" style="width: 65%;" required="">
                                    <option value="" disabled selected>Chọn tên quận</option>
                                    <!-- Các option của quận sẽ được cập nhật bằng JavaScript -->
                                </select>
                            </div>

                            <div class="div_design">
                                <label style="width: 27%;"><b>Tên điện thoại:</b></label>
                                <input class="text_color" type="text" style="width: 65%;" id="product_id" name="product_id" value="{{$product->id}}" hidden>
                                <input class="text_color" type="text" style="width: 65%;" id="product_id" name="product_id" value="{{$product->name}}" readonly>
                            </div>

                            <div class="div_design">
                                <label style="width: 27%;"><b>Màu sắc:</b></label>
                                <select class="text_color" id="color_id" name="color_id" style="width: 65%;" required="">
                                    <option value="" disabled selected>Hãy chọn màu điện thoại</option>
                                    @if(count($colors)>0)
                                    <div class="buttons">
                                        <strong>Màu sắc</strong>
                                        <div class="button_color">
                                            @foreach($colors as $key => $color)
                                            <option value="{{$color->id}}">{{$color->color}}</option>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </select>
                            </div>

                            <button id="showBranchesButton" type="button" onclick="showBranches()" class="button_store"><b>Xuất danh sách cửa hàng</b></button>

                            <div class="div_design">
                                <div class="store_list" id="storeList"></div>
                            </div>

                        </div>

                    </div>

                    <br>

                </form>
            </div>
        </div>
        <!-- End Modal -->

        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href="{{url('dien-thoai-chinh-hang')}}"><b> Điện thoại </b></a>><a href="{{url('dien-thoai',$product->brand->slug)}}"><b> Điện thoại {{$product->brand->title}} </b></a>><a href=""><b style="color: blue;"> Điện thoại {{$product->name}} </b></a></p>
        </div>

        <!-- Div hiển thị khung sp hot, khuyến mãi, mới ra mắt ... -->
        <div class="chitietSanpham" style="margin-bottom: 10px">
            <h1><b>Điện thoại {{$product->name}}</b></h1>
            <b class="store"><a id="Button" class="btn btn-primary" href="javascript:void(0);" style="color: #2f80ed;"><i class="fa fa-suitcase" aria-hidden="true"></i> Xem cửa hàng có sản phẩm</a></b>
            <!-- <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><span> 230 đánh giá</span> -->

        </div>
        <div class="rowdetail group border_product">
            @if(count($colors)>0)
            <div class="picture">
                <img id="productImage" width="400px" height="400px" style="object-fit: contain;" src="{{ asset('product_color_img/' . $colors[0]->image) }}">
                @if($old_product_price_min)
                <div class="area_old_product">
                    <strong>Điện thoại cũ giá rẻ</strong>
                    <div class="old_product">
                        <div class="old_product_img">
                            <img src="{{ asset('product_img/' . $product->image) }}">
                        </div>
                        <div class="old_product_content">
                            <p><a href="{{url('dien-thoai-cu-gia-re',$product->slug)}}"><b class="old_product_name">Điện thoại {{$product->name}}</b></a></p>
                            <p><b>Giá chỉ từ:</b> <b class="old_product_price">{{ number_format($old_product_price_min, 0, ',', '.') }}₫</b></p>
                            <?php
                                $discountPercentage_OldProduct = round(($product->price - $old_product_price_min) / $product->price * 100);
                            ?>
                            <p style="margin-top: 5px;"><b><span class="old_product_percent">Tiết kiệm: {{$discountPercentage_OldProduct}}%</span></b>  Bảo hành chính hãng</p>
                           
                        </div>
                        <!-- <img src="{{ asset('home/img/chitietsanpham/icon-tick.png') }}"> -->
                        <!-- <div id="detailPromo">Khách hàng có thể mua trả góp sản phẩm với <span style="font-weight: bold"> lãi suất 0% </span>với thời hạn 6 tháng kể từ khi mua hàng.</div> -->
                        <!-- <div id="detailPromo">{{$product->promotion}}</div> -->
                    </div>
                </div>
                @endif
            </div>
            @else
            <div class="picture">
                <img src="{{ asset('product_img/' . $product->image) }}">
                @if($old_product)
                <div class="area_old_product">
                    <strong>Điện thoại cũ giá rẻ</strong>
                    <div class="old_product">
                        <div class="old_product_img">
                            <img src="{{ asset('product_img/' . $product->image) }}">
                        </div>
                        <div class="old_product_content">
                            <p><a href="{{url('dien-thoai-cu-gia-re',$product->slug)}}"><b class="old_product_name">Điện thoại {{$product->name}}</b></a></p>
                            <p><b>Giá chỉ từ:</b> <b class="old_product_price">{{ number_format($old_product->new_price, 0, ',', '.') }}₫</b></p>
                            <p style="margin-top: 5px;"><b><span class="old_product_percent">Tiết kiệm: 10%</span></b>  Bảo hành: 1 năm</p>
                           
                        </div>
                        <!-- <img src="{{ asset('home/img/chitietsanpham/icon-tick.png') }}"> -->
                        <!-- <div id="detailPromo">Khách hàng có thể mua trả góp sản phẩm với <span style="font-weight: bold"> lãi suất 0% </span>với thời hạn 6 tháng kể từ khi mua hàng.</div> -->
                        <!-- <div id="detailPromo">{{$product->promotion}}</div> -->
                    </div>
                </div>
                @endif
            </div>
            @endif

            <div class="price_sale">
                <div class="area_price"><strong>{{ number_format($product->price, 0, ',', '.') }}₫</strong>
                    @if($product->old_price > $product->price)
                    <b class="price_old">
                        {{ number_format($product->old_price, 0, ',', '.') }}₫
                    </b>
                    <?php
                    $discountPercentage = round(($product->old_price - $product->price) / $product->old_price * 100);
                    ?>
                    <b class="price_percent">-{{ $discountPercentage }}%</b>
                    @endif
                    <label class="tragop">
                        Trả góp 0%
                    </label>
                </div>
                <div class="ship" style="display: none;">
                    <img src="{{ asset('home/img/chitietsanpham/clock-152067_960_720.png') }}">
                    <div>NHẬN HÀNG TRONG 1 GIỜ</div>
                </div>
                <div class="area_promo">
                    <strong>Khuyến mãi</strong>
                    <div class="promo">
                        <img src="{{ asset('home/img/chitietsanpham/icon-tick.png') }}">
                        <!-- <div id="detailPromo">Khách hàng có thể mua trả góp sản phẩm với <span style="font-weight: bold"> lãi suất 0% </span>với thời hạn 6 tháng kể từ khi mua hàng.</div> -->
                        <div id="detailPromo">{{$product->promotion}}</div>
                    </div>
                </div>
                @if(count($colors)>0)
                <div class="buttons">
                    <strong>Màu sắc</strong>
                    <div class="button_color">
                        @foreach($colors as $key => $color)
                        <button class="color-button @if($key === 0) active @endif" data-image="{{ asset('product_color_img/' . $color->image) }}" data-color="{{ $color->color }}"><b class="name_color">{{$color->color}}</b></button>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="policy">
                    <div>
                        <img src="{{ asset('home/img/chitietsanpham/box.png') }}">
                        <p>Bộ sản phẩm gồm: {{$product->accessories}} </p>
                    </div>
                    <div>
                        <img src="{{ asset('home/img/chitietsanpham/icon-baohanh.png') }}">
                        <p>Bảo hành chính hãng 12 tháng.</p>
                    </div>
                    <div class="last">
                        <img src="{{ asset('home/img/chitietsanpham/1-1.jpg') }}">
                        <p>1 đổi 1 trong 1 tháng nếu lỗi, đổi sản phẩm tại nhà trong 1 ngày.</p>
                    </div>
                </div>

                <div class="area_order">
                    <!-- nameProduct là biến toàn cục được khởi tạo giá trị trong phanTich_URL_chiTietSanPham -->
                    <a class="buy_now">
                        <b><i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng</b>
                        <form action="{{url('add_cart',$product->id)}}" method="post" id="add-to-cart-form">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" style="width: 100px;" hidden>
                            @if(count($colors)>0)
                            <input type="hidden" name="color" id="selectedColor" value="{{ $colors[0]->color }}"> <!-- Sửa tên biến thành $colors -->
                            @endif
                            <input type="submit" value="Giao trong 1 giờ hoặc nhận tại cửa hàng" class="add_product" style="background-color: transparent;border: 0px transparent;color: white;cursor: pointer;" @if(Auth::id()) data-product-name="{{$product->name}}" @else onclick="submitForm()" @endif>
                        </form>
                    </a>
                </div>

                <div class="fb_like_share">
                    @php
                    $current_url = Request::url();
                    @endphp
                    <div class="fb-like" data-href="{{ $current_url }}" data-width="100" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
                </div>
            </div>
            <div class="info_product">
                <h2><b>Thông số kỹ thuật</b></h2>
                <ul class="info">
                    <li>
                        <p><b>Màn hình</b></p>
                        <div>{{$product->screen}}</div>
                    </li>
                    <li>
                        <p><b>Hệ điều hành</b></p>
                        <div>{{$product->software}}</div>
                    </li>
                    <li>
                        <p><b>Camera sau</b></p>
                        <div>{{$product->camera_sau}}</div>
                    </li>
                    <li>
                        <p><b>Camera trước</b></p>
                        <div>{{$product->camera_truoc}}</div>
                    </li>
                    <li>
                        <p><b>CPU</b></p>
                        <div>{{$product->chip}}</div>
                    </li>
                    <li>
                        <p><b>RAM</b></p>
                        <div>{{$product->ram}}</div>
                    </li>
                    <li>
                        <p><b>ROM</b></p>
                        <div>{{$product->rom}}</div>
                    </li>
                    <li>
                        <p><b>Cổng sạc</b></p>
                        <div>{{$product->port}}</div>
                    </li>
                    <li>
                        <p><b>SIM</b></p>
                        <div>{{$product->sim}}</div>
                    </li>
                    <li>
                        <p><b>PIN</b></p>
                        <div>{{$product->pin}} mAh</div>
                    </li>
                </ul>
            </div>
        </div>





        </div>
        <br><br>
        <div class="chitietSanpham" style="margin-bottom: 20px">
            <h2 style="font-size: 20px;"><b>Giới thiệu sản phẩm</b></h2>
            <div class="rowdetail_youtube group">
                <div class="youtube">
                    <p>{{$product->description}}</p>
                    <br>
                    <iframe width="780px" height="500px" src="https://www.youtube.com/embed/{{$product->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>

        </div>

        <div class="chitietSanpham" style="margin-bottom: 20px;">
            <h1><b>Đánh giá điện thoại</b></h1>
            <div class="rowdetail_comment group">

                <div class="comment">
                    <!-- <div class="fb-comments" data-href="{{$current_url}}" data-width="770" data-numposts="5"></div> -->
                    <div class="fb-comments" data-href="{{$current_url}}" data-numposts="10" width="100%" data-colorscheme="light"></div>
                </div>


            </div>
        </div>
        <div class="chitietSanpham" style="margin-bottom: 20px;">



            <div id="goiYSanPham">
                <div class="khungSanPham" style="border-color: #434aa8">
                    <h3 class="tenKhung" style="background-image: linear-gradient(120deg, #434aa8 0%, #ec1f1f 50%, #434aa8 100%);">* Bạn có thể thích *</h3>
                    <div class="listSpTrongKhung flexContain">
                        @foreach($product_suggestion as $product)
                        <li class="sanPham">
                            <a href="{{url('chi-tiet-san-pham/' .$product->slug)}}">
                                <img src="{{ asset('product_img/' . $product->image) }}" alt="">
                                <h3><b>{{$product->name}}</b></h3>
                                <div class="price">
                                    <strong>{{ number_format($product->price, 0, ',', '.') }}₫</strong>
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

                    </div>
                </div>
            </div>
            @include('home.chat_messenger')

    </section> <!-- End Section -->

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="LA5qhmzD"></script>
    <script>
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

        //Chuyen anh san pham theo button
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.color-button');
            const productImage = document.getElementById('productImage');
            const selectedColorInput = document.getElementById('selectedColor');

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    buttons.forEach(function(btn) {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');

                    const newImage = this.getAttribute('data-image');
                    const color = this.getAttribute('data-color');

                    productImage.src = newImage;
                    selectedColorInput.value = color;
                });
            });
        });

        // Get the modal
        var modal = document.getElementById('Modal');

        // Get the button that opens the modal
        var addButton = document.getElementById('Button'); // Add an id to your "Thêm mới" button

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


        //Xuat danh sach cua hang
        function showBranches() {
            var product_id = document.getElementById('product_id').value;
            var color_id = document.getElementById('color_id').value;
            var district = document.getElementById('districtSelect').value; // Lấy giá trị từ thẻ select district

            // Kiểm tra xem đã chọn product_id, color_id và district chưa
            if (!product_id || !color_id || !district) {
                // Hiển thị thông báo bằng SweetAlert
                Swal.fire({
                    icon: 'warning',
                    title: 'Khách hàng chú ý!',
                    text: 'Bạn hãy chọn tên thành phố, quận và màu sản phẩm để xem danh sách cửa hàng.'
                });
                return;
            }

            // Gửi yêu cầu Ajax đến Controller để lấy danh sách branch
            $.ajax({
                type: 'GET',
                url: '/getBranches', // Thay đổi đường dẫn tùy vào cấu hình của bạn
                data: {
                    product_id: product_id,
                    color_id: color_id,
                    district: district
                },
                success: function(data) {
                    // Hiển thị danh sách branch trong div storeList
                    document.getElementById('storeList').innerHTML = data;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        //Them gio hang
        function submitForm() {
            // Submit the form if the user is not logged in
            document.getElementById('add-to-cart-form').submit();
        }

        $(document).ready(function() {
            $(".add_product").click(function(event) {
                event.preventDefault(); // Ngăn chặn sự kiện mặc định của form

                var productName = $(this).data('product-name');

                var colorName = $('.button_color button.active').data('color');

                if (productName && colorName && !$(this).data('clicked')) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thêm sản phẩm vào giỏ hàng thành công',
                        text: 'Bạn đã thêm sản phẩm ' + productName + ' màu ' + colorName + ' vào giỏ hàng',
                        timer: 2000, // Tự động đóng sau 3 giây
                        showConfirmButton: false
                    });

                    $(this).data('clicked', true);

                    $(this).closest('form').submit();
                }
            });
        });


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