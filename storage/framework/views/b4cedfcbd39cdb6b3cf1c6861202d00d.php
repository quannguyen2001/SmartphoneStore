<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm mới sản phẩm cũ</title>
    <?php echo $__env->make('admin.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
        <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="menu-select">
                        <div class="menu-select-item"><a href="/redirect">Trang chủ</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-tai-khoan')); ?>">Quản lý tài khoản</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-hang')); ?>">Quản lý hãng</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-banner')); ?>">Quản lý banner</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-san-pham')); ?>">Quản lý sản phẩm</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-hinh-anh')); ?>">Quản lý hình ảnh</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-don-hang')); ?>">Quản lý đơn hàng</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-chi-nhanh')); ?>">Quản lý chi nhánh</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-kho')); ?>">Quản lý kho</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-dien-thoai-cu')); ?>">Quản lý điện thoại cũ</a></div>
                        <!-- <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-dien-thoai-cu')); ?>">Quản lý điện thoại cũ</a></div>
      <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-dien-thoai-cu')); ?>">Quản lý điện thoại cũ</a></div> -->
                    </div>
                    <div class="breadcrumb">
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="<?php echo e(url('quan-ly-dien-thoai-cu')); ?>"><b> Quản lý sản phẩm cũ </b></a>><a href=""><b style="color: blue;"> Thêm mới sản phẩm cũ</b></a></p>
                    </div>
                    <div class="div_center">
                        <h2 class="h2_font">Thêm mới sản phẩm cũ</h2>

                        <form action="<?php echo e(url('/add_old_product')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="column_content">
                                <div>
                                    <div class="div_design">
                                        <label>Hãng sản xuất:</label>
                                        <select class="text_color" id="brand_id" name="brand_id" required="">
                                            <option value="" disabled selected>Chọn hãng sản xuất</option>
                                            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>Tên điện thoại:</label>
                                        <select class="text_color" id="product_id" name="product_id" required="">
                                            <option value="" disabled selected>Hãy chọn hãng sản xuất trước</option>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>Màu sắc:</label>
                                        <select class="text_color" id="color_id" name="color_id" required="">
                                            <option value="" disabled selected>Hãy chọn tên điện thoại trước</option>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>IMEI:</label>
                                        <input class="text_color" type="text" name="imei" placeholder="Nhập IMEI của máy" required="">
                                    </div>

                                    <div class="div_design">
                                        <label>Giá sản phẩm:</label>
                                        <input class="text_color" type="text" name="new_price" placeholder="Nhập giá sản phẩm" required="">
                                    </div>

                                    <div class="div_design">
                                        <label>Thời điểm mua lại:</label>
                                        <input class="text_color" type="date" name="time_buy" placeholder="Nhập thời điểm bán" required="">
                                    </div>


                                </div>

                                <div>
                                    <div class="div_design">
                                        <label>Thời hạn bảo hành:</label>
                                        <input class="text_color" type="text" name="time_guarantee" placeholder="Nhập thời hạn bảo hành" required="">
                                    </div>

                                    <div class="div_design">
                                        <label>Tình trạng sản phẩm:</label>
                                        <input class="text_color" type="text" name="status_product" placeholder="Nhập tình trạng sản phẩm" required="">
                                    </div>

                                    <div class="div_design">
                                        <label>Tình trạng bán:</label>
                                        <select class="text_color" name="status_sale" required="">
                                            <option value="" disabled selected>Chọn tình trạng bán</option>
                                            <option value="1">Chưa bán</option>
                                            <option value="2">Đã bán</option>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>Cửa hàng có sản phẩm:</label>
                                        <select class="text_color" id="branch_id" name="branch_id" required="">
                                            <option value="" disabled selected>Chọn cửa hàng</option>
                                            <?php $__currentLoopData = $branch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->address); ?>, <?php echo e($branch->district); ?>, <?php echo e($branch->city); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label>Hình ảnh 1:</label>
                                        <input type="file" name="image1" required="">
                                    </div>

                                    <div class="div_design">
                                        <label>Hình ảnh 2:</label>
                                        <input type="file" name="image2">
                                    </div>

                                    <div class="div_design">
                                        <label>Hình ảnh 3:</label>
                                        <input type="file" name="image3">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary" name="submit" style="background-color: gray;" value="Thêm mới">
                        </form>

                    </div>
                </div>
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php echo $__env->make('admin.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        $('#product_id').on('change', function() {
            var product_id = $(this).val();
            if (product_id) {
                $.ajax({
                    type: "GET",
                    url: '/get-colors/' + product_id, // Thay đổi đường dẫn tới route xử lý
                    dataType: "json",
                    success: function(data) {
                        $('#color_id').empty();
                        $.each(data, function(key, value) {
                            $('#color_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#color_id').attr('size', 1); // Điều chỉnh chiều cao tùy ý
                    }
                });
            } else {
                $('#color_id').empty();
                $('#color_id').attr('size', 1); // Điều chỉnh chiều cao tùy ý
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
</script><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/admin/add_old_product.blade.php ENDPATH**/ ?>