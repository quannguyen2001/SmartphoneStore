<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lý sản phẩm</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href="<?php echo e(url('quan-ly-san-pham')); ?>"><b style="color: blue;"> Quản lý sản phẩm </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Danh sách sản phẩm</h2>
            <div>
              <form action="<?php echo e(url('search_product')); ?>" method="get">
                <?php echo csrf_field(); ?>
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
                  <td><a onclick="" class="btn btn-primary" href="<?php echo e(url('them-moi-san-pham')); ?>"><b>Thêm mới</b></a></td>
                </tr>

                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($startKey++); ?></td>
                  <!-- <td style="padding-left: 10px;">
                    <img style="width: 360px; height: 150px; object-fit: cover;" src="/product_img/<?php echo e($product->image); ?>">
                  </td> -->
                  <td><?php echo e($product->name); ?></td>
                  <td><?php echo e($product->brand->title); ?></td>
                  <td><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫</td>
                  <td><?php echo e($product->year); ?></td>
                  <td><?php echo e($product->camera_sau); ?></td>
                  <td><?php echo e($product->camera_truoc); ?></td>
                  <td><?php echo e($product->chip); ?></td>
                  <td><?php echo e($product->ram); ?></td>
                  <td><?php echo e($product->rom); ?></td>
                  <td><?php echo e($product->pin); ?> mAh</td>
                  <td style="width: 120px; padding-left: 5px;">
                    <div class="button">
                      <a class="btn btn-success" href="<?php echo e(url('thong-tin-chi-tiet',$product->id)); ?>"><b>Chi tiết</b></a>
                    </div>
                    <div class="button">
                      <a class="btn btn-primary" href="<?php echo e(url('chinh-sua-san-pham',$product->id)); ?>"><b>Chỉnh sửa</b></a>
                    </div>
                    <div class="button">
                      <a class="btn btn-danger delete_product" href="<?php echo e(url('xoa-san-pham',$product->id)); ?>" data-product-name="<?php echo e($product->name); ?>"><b>Xóa</b></a>
                    </div>


                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


              </table>
              <div class="pagination">
                <?php if($products->currentPage() > 1): ?>
                <a href="<?php echo e($products->previousPageUrl()); ?>">
                  <i class="fa fa-angle-left"></i>
                </a>
                <?php endif; ?>

                <?php
                $start = max(1, $products->currentPage() - 4);
                $end = min($products->lastPage(), $products->currentPage() + 4);
                ?>

                <?php if($start > 1): ?>
                <span>...</span>
                <?php endif; ?>

                <?php for($i = $start; $i <= $end; $i++): ?> <a href="<?php echo e($products->url($i)); ?>" class="<?php echo e($i == $products->currentPage() ? 'current' : ''); ?>"><?php echo e($i); ?></a>
                  <?php endfor; ?>

                  <?php if($end < $products->lastPage()): ?>
                    <span>...</span>
                    <?php endif; ?>

                    <?php if($products->currentPage() < $products->lastPage()): ?>
                      <a href="<?php echo e($products->nextPageUrl()); ?>">
                        <i class="fa fa-angle-right"></i>
                      </a>
                      <?php endif; ?>
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
  <?php echo $__env->make('admin.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
</script><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/admin/product.blade.php ENDPATH**/ ?>