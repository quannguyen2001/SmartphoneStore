<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cập nhật banner</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href="<?php echo e(url('quan-ly-banner')); ?>"><b> Quản lý banner </b></a>><a href=""><b style="color: blue;"> Cập nhật banner </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Cập nhật banner</h2>

            <form action="<?php echo e(url('/update_banner_confirm',$banner->id)); ?>" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="content">
                <div class="div_design">
                  <label>Tên banner:</label>
                  <input class="text_color" type="text" name="title" placeholder="Nhập tên banner" required="" value="<?php echo e($banner->title); ?>">
                </div>

                <div class="div_design">
                  <label>Mô tả banner:</label>
                  <input class="text_color" type="text" name="description" placeholder="Nhập mô tả banner" required="" value="<?php echo e($banner->description); ?>">
                </div>

                <div class="div_design">
                  <label>Link sản phẩm banner:</label>
                  <input class="text_color" type="text" name="link" placeholder="Nhập link sản phẩm" required="" value="<?php echo e($banner->link); ?>">
                </div>

                <div class="div_design">
                  <label></label>
                  <img style="margin: auto" height="200" width="200" src="/banner_img/<?php echo e($banner->image); ?>">
                </div>

                <div class="div_design">
                  <label>Hình ảnh banner mới:</label>
                  <input type="file" name="image">
                </div>
              </div>
              <br>
              <input type="submit" class="btn btn-primary" name="submit" value="Cập nhật">
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
</script><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/admin/update_banner.blade.php ENDPATH**/ ?>