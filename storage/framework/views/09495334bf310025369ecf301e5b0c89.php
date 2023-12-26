<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo e($old_product->product->name); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('home/img/favicon.ico')); ?>" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">

    <!-- tidio - live chat -->
    <!-- <script src="//code.tidio.co/bfiiplaaohclhqwes5xivoizqkq56guu.js"></script> -->

    <!-- our files -->
    <!-- css -->
    <link rel="stylesheet" href="<?php echo e(asset('home/css/style.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/topnav.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/header.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/banner.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/taikhoan.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/trangchu.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/home_products.css?version=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/chitietsanphamcu.css?version=1.2')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('home/css/footer.css?version=1.1')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="<?php echo e(asset('home/js/home.js')); ?>"></script>
    <script src="<?php echo e(asset('home/data/products.js')); ?>"></script>
    <script src="<?php echo e(asset('home/js/classes.js')); ?>"></script>
    <script src="<?php echo e(asset('home/js/dungchung.js')); ?>"></script>
    <script src="<?php echo e(asset('js/chitietsanpham.js')); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php echo $__env->make('home.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section>
        <?php echo $__env->make('home.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Header -->

        <?php echo $__env->make('home.brand', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if(Route::has('login')): ?>
        <?php if(auth()->guard()->check()): ?>
        <!-- Modal -->
        <div id="Modal" class="modal" style="overflow: hidden;">
            <div class="modal-content" style="margin: 10% auto !important;">
                <span class="close">&times;</span>
                <!-- Your existing form content goes here -->
                <form id="Form" action="<?php echo e(url('/order_old_product',$old_product->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <!-- Your existing form fields go here -->
                    <div class="div_modal_center">
                        <h2 style="font-size: 25px;"><b>Thông tin khách hàng</b></h2>
                        <div class="content">
                            <div class="div_design">
                                <label style="width: 27%;"><b>Tên khách hàng:</b></label>
                                <input class="text_color" type="text" style="width: 65%;" id="user_name" name="user_name" value="<?php echo e($user_name); ?>">
                            </div>

                            <div class="div_design">
                                <label style="width: 27%;"><b>Số điện thoại:</b></label>
                                <input class="text_color" type="text" style="width: 65%;" id="phone" name="phone" value="<?php echo e($user_phone); ?>">
                            </div>

                            <input type="submit" class="button_store" name="submit" style="background-color: gray;border: 0px transparent;color: black;cursor: pointer;" value="Đặt giữ hàng">


                        </div>

                    </div>

                    <br>

                </form>
            </div>
        </div>
        <!-- End Modal -->
        <?php endif; ?>
        <?php endif; ?>

        <div class="breadcrumb">
            <p><a href="/"><b>Trang chủ </b></a>><a href="<?php echo e(url('dien-thoai-cu')); ?>"><b> Điện thoại cũ </b></a>><a href="<?php echo e(url('dien-thoai-cu-gia-re',$old_product->product->slug)); ?>"><b style="color: blue;"> Điện thoại <?php echo e($old_product->product->name); ?> cũ</b></a></p>
        </div>

        <!-- Div hiển thị khung sp hot, khuyến mãi, mới ra mắt ... -->
        <div class="chitietSanpham" style="margin-bottom: 10px; display: flex; gap: 5px; flex-wrap: wrap;">
            <div>
                <h1><b>Điện thoại <?php echo e($old_product->product->name); ?> cũ</b>
            </div>
            <div class="old_product_color"><b>Màu: <?php echo e($old_product->color->color); ?></b></div>
            <?php if($old_product->status_sale==1): ?>
            <div class="old_product_used"><b>Sản phẩm đã qua sử dụng</b></div>
            <?php else: ?>
            <div class="old_product_sold"><b>Sản phẩm này đã được bán</b></div>
            <?php endif; ?>

            </h1>

            <!-- <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><span> 230 đánh giá</span> -->

        </div>
        <div class="rowdetail group border_product">
            <div class="picture">
                <div class="arrow_buttons arrow_left" onclick="changeImageByArrow('prev')"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                <img src="<?php echo e(asset('old_product_img/' . $old_product->image1)); ?>" id="mainImage" style="object-fit: contain;">
                <div class="arrow_buttons arrow_right" onclick="changeImageByArrow('next')"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                <div class="area_picture_small">
                    <div class="area_picture_small_container">
                        <div class="area_picture_small_item">
                            <img src="<?php echo e(asset('old_product_img/' . $old_product->image1)); ?>" onclick="changeImage('<?php echo e($old_product->image1); ?>')">
                        </div>
                        <div class="area_picture_small_item">
                            <img src="<?php echo e(asset('old_product_img/' . $old_product->image2)); ?>" onclick="changeImage('<?php echo e($old_product->image2); ?>')">
                        </div>
                        <div class="area_picture_small_item">
                            <img src="<?php echo e(asset('old_product_img/' . $old_product->image3)); ?>" onclick="changeImage('<?php echo e($old_product->image3); ?>')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="price_sale">
                <div class="area_price"><strong><?php echo e(number_format($old_product->new_price, 0, ',', '.')); ?>₫</strong>

                    <b class="price_old">
                        <?php echo e(number_format($old_product->product->price, 0, ',', '.')); ?>₫
                    </b>
                    <?php
                    $discountPercentage = round(($old_product->product->price - $old_product->new_price) / $old_product->product->price * 100);
                    ?>
                    <b class="price_percent">-<?php echo e($discountPercentage); ?>%</b>

                    <label class="tragop">
                        Trả góp 0%
                    </label>
                </div>
                <div class="ship" style="display: none;">
                    <img src="<?php echo e(asset('home/img/chitietsanpham/clock-152067_960_720.png')); ?>">
                    <div>NHẬN HÀNG TRONG 1 GIỜ</div>
                </div>
                <div class="area_info">
                    <div class="info">

                        <div>
                            <p><i class="fa fa-money" aria-hidden="true"></i><b> Giá sản phẩm mới: </b><?php echo e(number_format($old_product->product->price, 0, ',', '.')); ?>₫</p>
                        </div>
                        <?php
                        $discountPrice = $old_product->product->price - $old_product->new_price;
                        ?>
                        <div>
                            <p><i class="fa fa-usd" aria-hidden="true"></i><b> Tiết kiệm: </b><?php echo e(number_format($discountPrice, 0, ',', '.')); ?>₫</p>
                        </div>
                        <div>
                            <p><i class="fa fa-shopping-bag" aria-hidden="true"></i><b> Sản phẩm đang có tại cửa hàng: </b></p>
                            <a href="<?php echo e(url('cua-hang/' .$old_product->branch->slug)); ?>" target="_blank"> <?php echo e($old_product->branch->address); ?>, <?php echo e($old_product->branch->district); ?>, <?php echo e($old_product->branch->city); ?></a>
                        </div>
                        <div>
                            <p><i class="fa fa-hand-o-right" aria-hidden="true"></i><a href="<?php echo e(url('chi-tiet-san-pham/' .$old_product->product->slug)); ?>" target="_blank"> Xem sản phẩm mới</a></p>
                        </div>
                    </div>
                </div>
                <div class="area_info">
                    <strong>Thông tin bảo hành sản phẩm</strong>
                    <div class="info">
                        <!-- <div id="detailPromo">Khách hàng có thể mua trả góp sản phẩm với <span style="font-weight: bold"> lãi suất 0% </span>với thời hạn 6 tháng kể từ khi mua hàng.</div> -->

                        <div>
                            <p>Thời hạn bảo hành: <b><?php echo e($old_product->time_guarantee); ?> chính hãng</b></p>
                        </div>
                        <div>
                            <p>Đổi trả tháng đầu tiên (phí 10%) </p>
                        </div>
                        <div>
                            <p>Không áp dụng bảo hành phụ kiện kèm theo</p>
                        </div>
                        <div>
                            <p>Tình trạng sản phẩm: <b><?php echo e($old_product->status_product); ?></b></p>
                        </div>
                        <div>
                            <p>IMEI: <b><?php echo e(substr($old_product->imei, 0, 4) . '***' . substr($old_product->imei, -4)); ?></b></p>
                        </div>


                    </div>
                </div>


                    <?php if($old_product->status_sale==1): ?>
                        <?php if($existingOrderOldProduct): ?>
                        <div class="area_order">
                            <a class="buy_now" href="javascript:void(0);">
                                <b><i class="fa fa-thumbs-up" aria-hidden="true"></i> Bạn đã đặt giữ sản phẩm này</b>
                                <p><b>Đặt giữ hàng chỉ có hiệu lực trong 24h</b></p>
                            </a>
                        </div>
                        
                        <?php elseif(count($order)>0): ?> 
                        <div class="area_order">
                            <a class="buy_now" href="javascript:void(0);">
                                <b><i class="fa fa-thumbs-up" aria-hidden="true"></i> Sản phẩm đã có khách đặt</b>
                                <p><b>Bạn hãy chọn sản phẩm khác</b></p>
                            </a>
                        </div>
                        <?php else: ?>
                        <div class="area_order">
                            <?php if(Route::has('login')): ?>
                                <?php if(auth()->guard()->check()): ?>
                                <a class="buy_now" id="Button" href="javascript:void(0);">
                                    <b><i class="fa fa-cart-plus"></i> Đặt giữ hàng</b><br>
                                    <p> Tại siêu thị tối đa 24h</p>
                                </a>
                                <?php else: ?>
                                <a class="buy_now" id="Button" href="<?php echo e(url('login')); ?>">
                                    <b><i class="fa fa-cart-plus"></i> Đặt giữ hàng</b><br>
                                    <p> Tại siêu thị tối đa 24h</p>
                                </a>

                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                    <div class="area_order">
                        <a class="buy_now" href="javascript:void(0);">
                            <b><i class="fa fa-cart-plus"></i> Sản phẩm đã được bán</b><br>
                            <p> Bạn vui lòng chọn sản phẩm khác</p>

                        </a>
                    </div>
                    <?php endif; ?>


                    <div class="fb_like_share">
                        <?php
                        $current_url = Request::url();
                        ?>
                        <div class="fb-like" data-href="<?php echo e($current_url); ?>" data-width="100" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
                    </div>
            </div>
            <div class="info_product">
                <h2><b>Thông số kỹ thuật</b></h2>
                <ul class="info">
                    <li>
                        <p><b>Màn hình</b></p>
                        <div><?php echo e($old_product->product->screen); ?></div>
                    </li>
                    <li>
                        <p><b>Hệ điều hành</b></p>
                        <div><?php echo e($old_product->product->software); ?></div>
                    </li>
                    <li>
                        <p><b>Camera sau</b></p>
                        <div><?php echo e($old_product->product->camera_sau); ?></div>
                    </li>
                    <li>
                        <p><b>Camera trước</b></p>
                        <div><?php echo e($old_product->product->camera_truoc); ?></div>
                    </li>
                    <li>
                        <p><b>CPU</b></p>
                        <div><?php echo e($old_product->product->chip); ?></div>
                    </li>
                    <li>
                        <p><b>RAM</b></p>
                        <div><?php echo e($old_product->product->ram); ?></div>
                    </li>
                    <li>
                        <p><b>ROM</b></p>
                        <div><?php echo e($old_product->product->rom); ?></div>
                    </li>
                    <li>
                        <p><b>Cổng sạc</b></p>
                        <div><?php echo e($old_product->product->port); ?></div>
                    </li>
                    <li>
                        <p><b>SIM</b></p>
                        <div><?php echo e($old_product->product->sim); ?></div>
                    </li>
                    <li>
                        <p><b>PIN</b></p>
                        <div><?php echo e($old_product->product->pin); ?> mAh</div>
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
                    <p><?php echo e($old_product->product->description); ?></p>
                    <br>
                    <iframe width="780px" height="500px" src="https://www.youtube.com/embed/<?php echo e($old_product->product->link); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>

        </div>

        <div class="chitietSanpham" style="margin-bottom: 20px;">
            <h1><b>Đánh giá điện thoại</b></h1>
            <div class="rowdetail_comment group">

                <div class="comment">
                    <!-- <div class="fb-comments" data-href="<?php echo e($current_url); ?>" data-width="770" data-numposts="5"></div> -->
                    <div class="fb-comments" data-href="<?php echo e($current_url); ?>" data-numposts="10" width="100%" data-colorscheme="light"></div>
                </div>


            </div>
        </div>
        <div class="chitietSanpham" style="margin-bottom: 20px;">



            <div id="goiYSanPham">
                <div class="khungSanPham" style="border-color: #434aa8">
                    <h3 class="tenKhung" style="background-image: linear-gradient(120deg, #434aa8 0%, #ec1f1f 50%, #434aa8 100%);">* Bạn có thể thích *</h3>
                    <div class="listSpTrongKhung flexContain">
                        <?php $__currentLoopData = $product_suggestion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="sanPham">
                            <a href="<?php echo e(url('chi-tiet-san-pham/' .$product->slug)); ?>">
                                <img src="<?php echo e(asset('product_img/' . $product->image)); ?>" alt="">
                                <h3><b><?php echo e($product->name); ?></b></h3>
                                <div class="price">
                                    <strong><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫</strong>
                                </div>
                                <div class="rom_ram">
                                    <h3><b>RAM:</b> <?php echo e($product->ram); ?> &nbsp<b>ROM:</b> <?php echo e($product->rom); ?></h3>
                                </div>
                                <label class="tragop">
                                    Trả góp 0%
                                </label>
                                <!-- <div class="tooltip">
                                    <form action="<?php echo e(url('add_cart',$product->id)); ?>" method="post" id="add-to-cart-form">
                                        <?php echo csrf_field(); ?>
                                        <input type="number" name="quantity" value="1" min="1" style="width: 100px;" hidden>

                                        <input class="themvaogio" type="submit" value="+" <?php if(Auth::id()): ?> data-product-name="<?php echo e($product->name); ?>" <?php else: ?> onclick="submitForm()" <?php endif; ?>>
                                        <span class="tooltiptext" style="font-size: 15px;">Thêm vào giỏ</span>

                                    </form>
                                </div> -->
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
            <?php echo $__env->make('home.chat_messenger', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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


        //Chuyển ảnh

        var currentImageIndex = 0;
        var imagePaths = [
            '<?php echo e($old_product->image1); ?>',
            '<?php echo e($old_product->image2); ?>',
            '<?php echo e($old_product->image3); ?>'
        ];

        document.addEventListener('DOMContentLoaded', function() {
            // Thêm class 'selected' cho ảnh đầu tiên
            var firstImage = document.querySelector('.area_picture_small_item img');
            firstImage.closest('.area_picture_small_item').classList.add('selected');
        });

        function changeImage(imagePath) {
            // Loại bỏ 'selected' class từ tất cả các mục
            var items = document.querySelectorAll('.area_picture_small_item');
            items.forEach(item => item.classList.remove('selected'));

            // Thêm 'selected' class cho mục được chọn
            var selectedItem = document.querySelector(`.area_picture_small_item img[src="<?php echo e(asset('old_product_img/')); ?>/${imagePath}"]`);
            selectedItem.closest('.area_picture_small_item').classList.add('selected');

            document.getElementById('mainImage').src = "<?php echo e(asset('old_product_img/')); ?>" + "/" + imagePath;
            currentImageIndex = imagePaths.indexOf(imagePath);
        }

        function changeImageByArrow(direction) {
            // Loại bỏ 'selected' class từ tất cả các mục
            var items = document.querySelectorAll('.area_picture_small_item');
            items.forEach(item => item.classList.remove('selected'));

            // Thêm 'selected' class cho mục tiếp theo
            if (direction === 'prev') {
                currentImageIndex = (currentImageIndex - 1 + imagePaths.length) % imagePaths.length;
            } else {
                currentImageIndex = (currentImageIndex + 1) % imagePaths.length;
            }

            var nextImagePath = imagePaths[currentImageIndex];
            var nextItem = document.querySelector(`.area_picture_small_item img[src="<?php echo e(asset('old_product_img/')); ?>/${nextImagePath}"]`);
            nextItem.closest('.area_picture_small_item').classList.add('selected');

            document.getElementById('mainImage').src = "<?php echo e(asset('old_product_img/')); ?>" + "/" + nextImagePath;
        }

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

        //Thong bao dat thanh cong
        // Wait for the document to be ready
        document.addEventListener("DOMContentLoaded", function() {
            // Get the form element
            var form = document.getElementById("Form");

            // Add a submit event listener to the form
            form.addEventListener("submit", function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Make an AJAX request to submit the form data
                // Replace the following code with your actual AJAX request
                // For example, you can use Fetch API or jQuery AJAX
                fetch(form.action, {
                        method: form.method,
                        body: new FormData(form),
                    })
                    .then(function(response) {
                        // Check if the request was successful (you might need to adjust this based on your backend response)
                        if (response.ok) {
                            // Show SweetAlert success message
                            Swal.fire({
                                title: "Đặt hàng thành công",
                                text: "Cảm ơn bạn đã đặt giữ hàng!",
                                icon: "success",
                                showConfirmButton: false, // Remove the "OK" button
                            });

                            // Reload the page after 2 seconds
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            // Show SweetAlert error message
                            Swal.fire({
                                title: "Đặt hàng không thành công",
                                text: "Đã xảy ra lỗi. Vui lòng thử lại!",
                                icon: "error",
                                confirmButtonColor: "#d33",
                                confirmButtonText: "OK",
                            });
                        }
                    })
                    .catch(function(error) {
                        // Handle errors here
                        console.error("Error:", error);
                    });
            });
        });


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
    <?php echo $__env->make('home.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/old_product_detail.blade.php ENDPATH**/ ?>