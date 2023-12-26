<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lý tài khoản</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Quản lý tài khoản </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Quản lý tài khoản</h2>
            <div>
              <form action="<?php echo e(url('search_account')); ?>" method="get">
                <?php echo csrf_field(); ?>
                <input type="text" style="color: black;" name="search" placeholder="Nhập thông tin cần tìm">
                <input type="submit" value="Tìm kiếm" class="btn btn-outline-primary" style="color: black; background-color: lightgreen; font-weight: bold; width: 100px; height: 38px;">
              </form>
            </div>
            <table class="center">
              <tr>
                <td><b>STT</b></td>
                <td><b>Tên tài khoản</b></td>
                <td><b>Email</b></td>
                <td><b>Số điện thoại</b></td>
                <td><b>Địa chỉ</b></td>
                <td><b>Ngày tạo tài khoản</b></td>
                <td></td>
              </tr>


              <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->phone); ?></td>
                <td><?php echo e($user->address); ?></td>
                <td><?php echo e($user->created_at); ?></td>
                <td style="width: 150px; padding-left: 5px;">
                  <?php if($user->usertype==0): ?>
                  <a class="btn btn-danger delete_user" href="<?php echo e(url('xoa-tai-khoan',$user->id)); ?>" data-user-name="<?php echo e($user->name); ?>"><b>Xóa tài khoản</b></a>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </table>
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
    $(".delete_user").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var userName = $(this).data('user-name');
      var deleteUrl = $(this).attr('href'); // Lấy địa chỉ URL để xóa

      if (userName && !$(this).data('clicked')) {
        Swal.fire({
          title: 'Xác nhận xóa tài khoản',
          text: 'Bạn có muốn xóa tài khoản ' + userName + ' không?',
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
                  'Bạn đã xóa tài khoản ' + userName + ' thành công' +
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
</script><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/admin/account.blade.php ENDPATH**/ ?>