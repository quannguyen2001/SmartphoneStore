<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý kho</title>
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
            <!-- Thêm mới kho -->
            <div id="addBranchModal" class="modal" style="overflow: hidden;">
                <div class="modal-content" style="margin: 10% auto !important;">
                    <span class="close">&times;</span>
                    <!-- Your existing form content goes here -->
                    <form id="addBranchForm" action="<?php echo e(url('/add_stock')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <!-- Your existing form fields go here -->
                        <div class="div_modal_center">
                            <h2 style="font-size: 25px;">Thêm mới kho</h2>

                            <form action="<?php echo e(url('/add_stock')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="content">
                                    <div class="div_design">
                                        <label style="width: 30%;">Tên chi nhánh:</label>
                                        <select class="text_color" id="branch_id" name="branch_id" style="width: 60%;" required="">
                                            <option value="" disabled selected>Chọn chi nhánh</option>
                                            <?php $__currentLoopData = $branch;
                                            $__env->addLoop($__currentLoopData);
                                            foreach ($__currentLoopData as $branch) : $__env->incrementLoopIndices();
                                                $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->address); ?>, <?php echo e($branch->district); ?>, <?php echo e($branch->city); ?></option>
                                            <?php endforeach;
                                            $__env->popLoop();
                                            $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label style="width: 30%;">Hãng sản xuất:</label>
                                        <select class="text_color" id="brand_id" name="brand_id" style="width: 60%;" required="">
                                            <option value="" disabled selected>Chọn hãng sản xuất</option>
                                            <?php $__currentLoopData = $brand;
                                            $__env->addLoop($__currentLoopData);
                                            foreach ($__currentLoopData as $brand) : $__env->incrementLoopIndices();
                                                $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->title); ?></option>
                                            <?php endforeach;
                                            $__env->popLoop();
                                            $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label style="width: 30%;">Tên điện thoại:</label>
                                        <select class="text_color" id="product_id" name="product_id" style="width: 60%;" required="">
                                            <option value="" disabled selected>Hãy chọn hãng sản xuất trước</option>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label style="width: 30%;">Màu sắc:</label>
                                        <select class="text_color" id="color_id" name="color_id" style="width: 60%;" required="">
                                            <option value="" disabled selected>Hãy chọn tên điện thoại trước</option>
                                        </select>
                                    </div>

                                    <div class="div_design">
                                        <label style="width: 30%;">Số lượng:</label>
                                        <input class="text_color" type="text" name="quantity" placeholder="Nhập số lượng" style="width: 60%;" required="">
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
            <!-- Hết thêm mới kho -->

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
                        <div class="menu-select-item"><a href="<?php echo e(url('thong-ke-doanh-thu')); ?>">Thống kê doanh thu</a></div>
                        <!-- <div class="menu-select-item"><a href="<?php echo e(url('thong-ke-doanh-thu')); ?>">Thống kê doanh thu</a></div>
      <div class="menu-select-item"><a href="<?php echo e(url('thong-ke-doanh-thu')); ?>">Thống kê doanh thu</a></div> -->
                    </div>
                    <div class="breadcrumb">
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="<?php echo e(url('quan-ly-kho')); ?>"><b style="color: blue;"> Quản lý kho </b></a></p>
                    </div>

                    <div class="div_center">
                        <h2 class="h2_font">Danh sách các sản phẩm trong kho</h2>

                        <div class="center">
                            <table class="center">
                                <tr>
                                    <td><b>ID</b></td>
                                    <td><b>Chi nhánh</b></td>
                                    <td><b>Sản phẩm</b></td>
                                    <td><b>Màu sắc</b></td>
                                    <td><b>Số lượng</b></td>

                                    <td><a id="addBranchButton" class="btn btn-primary" href="javascript:void(0);"><b>Thêm mới</b></a></td>
                                </tr>

                                <?php $__currentLoopData = $stock;
                                $__env->addLoop($__currentLoopData);
                                foreach ($__currentLoopData as $key => $stock) : $__env->incrementLoopIndices();
                                    $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td style="min-width: 150px;"><?php echo e($stock->branch->address); ?>, <?php echo e($stock->branch->district); ?>, <?php echo e($stock->branch->city); ?></td>
                                        <td><?php echo e($stock->product->name); ?></td>
                                        <td><?php echo e($stock->color->color); ?></td>
                                        <td><?php echo e($stock->quantity); ?></td>
                                        <td>
                                            <div class="button">
                                                <a class="btn btn-primary" href="<?php echo e(url('chinh-sua-kho', $stock->id)); ?>"><b>Chỉnh sửa</b></a>
                                            </div>
                                            <div class="button">
                                                <a class="btn btn-danger delete_branch" href="<?php echo e(url('xoa-kho', $stock->id)); ?>" data-branch-name="<?php echo e($branch->address); ?>"><b>Xóa</b></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach;
                                $__env->popLoop();
                                $loop = $__env->getLastLoop(); ?>


                            </table>
                        </div>
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
</script><?php /**PATH /var/www/html/SmartphoneStore/resources/views/admin/stock.blade.php ENDPATH**/ ?>