<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cập nhật hãng</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-hang')}}"><b> Quản lý hãng </b></a>><a href=""><b style="color: blue;"> Cập nhật thông tin hãng</b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Cập nhật thông tin hãng</h2>

            <form action="{{url('/update_brand_confirm',$brand->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="content">
                <div class="div_design">
                  <label>Tên hãng:</label>
                  <input class="text_color" type="text" name="title" placeholder="Nhập tên hãng" required="" value="{{$brand->title}}">
                </div>
                <div class="div_design">
                  <label>Slug:</label>
                  <input class="text_color" type="text" name="slug" placeholder="Slug" required="" value="{{$brand->slug}}">
                </div>

                <div class="div_design">
                  <label></label>
                  <img style="margin: auto" height="200" width="200" src="/brand_img/{{$brand->image}}">
                </div>

                <div class="div_design">
                  <label>Hình ảnh hãng mới:</label>
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