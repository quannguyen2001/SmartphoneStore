<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lý banner</title>
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
      <!-- Thêm mới banner -->
      <div id="addBannerModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <!-- Your existing form content goes here -->
          <form id="addBannerForm" action="{{url('/add_banner')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Your existing form fields go here -->
            <div class="div_modal_center">
              <h2 style="font-size: 25px;">Thêm mới banner</h2>

              <form action="{{url('/add_banner')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                  <div class="div_design">
                    <label>Tên banner:</label>
                    <input class="text_color" type="text" name="title" placeholder="Nhập tên banner" required="">
                  </div>

                  <div class="div_design">
                    <label>Mô tả banner:</label>
                    <input class="text_color" type="text" name="description" placeholder="Nhập mô tả banner" required="">
                  </div>

                  <div class="div_design">
                    <label>Link sản phẩm banner:</label>
                    <input class="text_color" type="text" name="link" placeholder="Nhập link sản phẩm" required="">
                  </div>

                  <div class="div_design">
                    <label>Hình ảnh banner:</label>
                    <input type="file" name="image" required="">
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
      <!-- Hết thêm mới banner -->

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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-banner')}}"><b style="color: blue;"> Quản lý banner </b></a></p>
          </div>

          <div class="div_center">
            <h2 class="h2_font">Danh sách banner</h2>

            <table class="center">
              <tr>
                <td><b>ID</b></td>
                <td><b>Tên banner</b></td>
                <td><b>Hình ảnh</b></td>
                <td><b>Mô tả banner</b></td>
                <td><b>Link sản phẩm</b></td>
                <td><b>Ngày tạo</b></td>
                <td><b>Ngày cập nhật</b></td>
                <td><a id="addBannerButton" class="btn btn-primary" href="javascript:void(0);"><b>Thêm mới</b></a></td>
              </tr>

              @foreach($banner as $banner)
              <tr>
                <td>{{$banner->id}}</td>
                <td style="width: 160px;">{{$banner->title}}</td>
                <td style="padding-left: 30px;">
                  <img class="img_size" src="/banner_img/{{$banner->image}}">
                </td>
                <td style="width: 160px;">{{$banner->description}}</td>
                <td style="width: 60px;">{{$banner->link}}</td>
                <td>{{$banner->created_at}}</td>
                <td>{{$banner->updated_at}}</td>
                <td style="width: 120px;">
                  <div class="button">
                    <a onclick="" class="btn btn-primary" href="{{url('chinh-sua-banner',$banner->id)}}"><b>Chỉnh sửa</b></a>
                  </div>
                  <div class="button">
                    <a class="btn btn-danger delete_banner" href="{{url('xoa-banner',$banner->id)}}" data-banner-name="{{$banner->title}}"><b>Xóa</b></a>
                  </div>


                </td>
              </tr>
              @endforeach


            </table>
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
  //Modal thêm mới banner
  // Get the modal
  var modal = document.getElementById('addBannerModal');

  // Get the button that opens the modal
  var addButton = document.getElementById('addBannerButton'); // Add an id to your "Thêm mới" button

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
    $(".delete_banner").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var bannerName = $(this).data('banner-name');
      var deleteUrl = $(this).attr('href'); // Lấy địa chỉ URL để xóa

      if (bannerName && !$(this).data('clicked')) {
        Swal.fire({
          title: 'Xác nhận xóa banner',
          text: 'Bạn có muốn xóa banner ' + bannerName + ' không?',
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
                  'Bạn đã xóa banner ' + bannerName + ' thành công' +
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
</script>