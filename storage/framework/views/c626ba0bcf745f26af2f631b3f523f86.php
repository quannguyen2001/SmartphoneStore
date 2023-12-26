<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách hãng bán chạy</title>
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
            <div class="menu-select-item"><a href="<?php echo e(url('thong-ke-doanh-thu')); ?>">Thống kê doanh thu</a></div>
            <!-- <div class="menu-select-item"><a href="<?php echo e(url('thong-ke-doanh-thu')); ?>">Thống kê doanh thu</a></div>
      <div class="menu-select-item"><a href="<?php echo e(url('thong-ke-doanh-thu')); ?>">Thống kê doanh thu</a></div> -->
          </div>
          <div class="breadcrumb">
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Hãng bán chạy </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Danh sách hãng bán chạy</h2>

            <div class="center">
              <table class="center">
                <tr>
                  <td><b>TOP</b></td>
                  <td><b>Hình ảnh</b></td>
                  <td><b>Tên hãng</b></td>
                  <td><b>Số lượng bán ra</b></td>
                  <td><b>Doanh thu đạt được</b></td>

                </tr>

                <?php $__currentLoopData = $total_brand_sale;
                $__env->addLoop($__currentLoopData);
                foreach ($__currentLoopData as $key => $totals) : $__env->incrementLoopIndices();
                  $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td>
                      <img width="150px" src="<?php echo e(asset('brand_img/' . $totals->brand_image)); ?>" alt="image" />
                    </td>
                    <td><?php echo e($totals->brand_title); ?></td>
                    <td><?php echo e($totals->product_count); ?></td>
                    <td><?php echo e(number_format($totals->product_price, 0, ',', '.')); ?>₫</td>
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
<!-- <script>
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
</script> --><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/admin/brand_bestseller.blade.php ENDPATH**/ ?>