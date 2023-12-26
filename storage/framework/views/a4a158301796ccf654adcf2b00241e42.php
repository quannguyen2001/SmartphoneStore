<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lý đơn hàng</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Quản lý đơn hàng </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Quản lý đơn hàng</h2>

            <div class="center">
              <table class="center">
                <tr>
                  <td><b>Mã số đơn hàng</b></td>
                  <td><b>Số sản phẩm</b></td>
                  <td><b>Tổng tiền</b></td>
                  <td><b>Thời gian mua</b></td>
                  <td><b>Trạng thái đơn hàng</b></td>
                  <td><b>Trạng thái thanh toán</b></td>
                  <td colspan="4"><b>Nút chức năng</b></td>
                </tr>

                <?php $__currentLoopData = $mergedorders;
                $__env->addLoop($__currentLoopData);
                foreach ($__currentLoopData as $key => $order) : $__env->incrementLoopIndices();
                  $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="width: 100px;"><?php echo e($key); ?></td>
                    <td><?php echo e($order['total_quantity']); ?></td>
                    <td><?php echo e(number_format($order['total_amount'], 0, ',', '.')); ?>₫</td>
                    <td style="width: 170px;"><?php echo e(\Carbon\Carbon::parse($order['time'])->format('H:i:s d-m-Y')); ?></td>
                    <td style="width: 150px;">
                      <?php if ($order['delivery_status'] == 0) : ?>
                        Đang chờ duyệt
                      <?php elseif ($order['delivery_status'] == 1) : ?>
                        Đang vận chuyển
                      <?php elseif ($order['delivery_status'] == 2) : ?>
                        Đã giao hàng
                      <?php else : ?>
                        <b style="color: blue;">Đơn hàng đã bị hủy</b>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($order['delivery_status'] == 3) : ?>
                        <b style="color: blue;">Đơn hàng đã bị hủy</b>
                      <?php else : ?>
                        <?php if ($order['payment_status'] == 0) : ?>
                          Thanh toán trả sau khi giao hàng
                        <?php elseif ($order['payment_status'] == 1) : ?>
                          Đã thanh toán qua VNPAY
                        <?php else : ?>
                          Đã thanh toán
                        <?php endif; ?>
                      <?php endif; ?>
                    </td>
                    <td style="width: 120px;">
                      <?php if ($order['delivery_status'] == 0) : ?>
                        <a onclick="event.preventDefault(); 
            document.getElementById('update-form-<?php echo e($key); ?>').submit();
             " class="btn btn-primary" href="#"><b>Duyệt đơn</b></a>

                        <form id="update-form-<?php echo e($key); ?>" action="<?php echo e(url('update_order_delivery', $key)); ?>" method="POST" style="display: none;">
                          <?php echo csrf_field(); ?>
                        </form>
                      <?php elseif ($order['delivery_status'] == 1) : ?>
                        <a onclick="event.preventDefault(); 
            document.getElementById('update-form-<?php echo e($key); ?>').submit();
             " class="btn btn-secondary" href="#"><b>Đã giao hàng</b></a>

                        <form id="update-form-<?php echo e($key); ?>" action="<?php echo e(url('update_order_done', $key)); ?>" method="POST" style="display: none;">
                          <?php echo csrf_field(); ?>
                        </form>
                      <?php elseif ($order['delivery_status'] == 2) : ?>
                        <a class="btn btn-success" href="#"><b>Đã giao hàng</b></a><br>
                      <?php else : ?>

                      <?php endif; ?>
                    </td>
                    <td style="width: 150px; height: 45px;">
                      <?php if ($order['delivery_status'] == 3) : ?>

                      <?php else : ?>
                        <?php if ($order['payment_status'] == 0) : ?>
                          <a onclick="event.preventDefault(); 
            document.getElementById('update-payment-form-<?php echo e($key); ?>').submit();
             " class="btn btn-primary" href="#"><b>Đã thanh toán</b></a>

                          <form id="update-payment-form-<?php echo e($key); ?>" action="<?php echo e(url('update_order_payment', $key)); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                          </form>
                        <?php elseif ($order['payment_status'] == 1) : ?>

                        <?php else : ?>
                          <a onclick="event.preventDefault(); 
            document.getElementById('update-not-payment-form-<?php echo e($key); ?>').submit();
             " class="btn btn-secondary" href="#"><b>Chưa thanh toán</b></a>

                          <form id="update-not-payment-form-<?php echo e($key); ?>" action="<?php echo e(url('update_order_not_payment', $key)); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                          </form>
                        <?php endif; ?>
                      <?php endif; ?>
                    </td>
                    <td style="width: 165px; height: 45px;">
                      <a onclick="" class="btn btn-info" href="<?php echo e(url('don-hang', $key)); ?>"><b>Chi tiết đơn hàng</b></a><br>
                    </td>
                    <td>
                      <?php if ($order['delivery_status'] == 0 && $order['payment_status'] == 0) : ?>
                        <a onclick="event.preventDefault(); 
            document.getElementById('update-form-order-cancel-<?php echo e($key); ?>').submit();
             " class="btn btn-danger" href="#"><b>Hủy</b></a>

                        <form id="update-form-order-cancel-<?php echo e($key); ?>" action="<?php echo e(url('update_order_cancel', $key)); ?>" method="POST" style="display: none;">
                          <?php echo csrf_field(); ?>
                        </form>
                      <?php else : ?>

                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach;
                $__env->popLoop();
                $loop = $__env->getLastLoop(); ?>

              </table>
            </div>
            <div class="pagination">
              <?php echo e($mergedorders->links('pagination::bootstrap-4')); ?>

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
    // Function to show notification
    function showNotification(message) {
      var notification = $("<div class='notification'>" +
        "<span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>" +
        message +
        "</div>");
      $("body").append(notification);
    }

    // Function to handle form submission and show notification
    $(".btn-primary").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var formId = $(this).attr('id');

      $("#" + formId).submit();

      showNotification('Cập nhật thành công!');
    });

    $(".btn-secondary").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var formId = $(this).attr('id');

      $("#" + formId).submit();

      showNotification('Cập nhật thành công!');
    });

    $(".btn-success").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var formId = $(this).attr('id');

      $("#" + formId).submit();

      showNotification('Cập nhật thành công!');
    });

    $(".btn-danger").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var formId = $(this).attr('id');

      $("#" + formId).submit();

      showNotification('Cập nhật thành công!');
    });
  });
</script><?php /**PATH /var/www/html/SmartphoneStore/resources/views/admin/order.blade.php ENDPATH**/ ?>