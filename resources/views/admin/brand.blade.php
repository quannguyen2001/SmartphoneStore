<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lý hãng</title>
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
      <!-- Thêm mới hãng -->
      <div id="addBrandModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <!-- Your existing form content goes here -->
          <form id="addBrandForm" action="{{url('/add_brand')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Your existing form fields go here -->
            <div class="div_modal_center">
              <h2 style="font-size: 25px;">Thêm mới hãng</h2>

              <form action="{{url('/add_brand')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                  <div class="div_design">
                    <label>Tên hãng:</label>
                    <input class="text_color" type="text" name="title" placeholder="Nhập tên hãng" required="">
                  </div>

                  <div class="div_design">
                    <label>Hình ảnh hãng:</label>
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
      <!-- Hết thêm mới hãng -->

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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-hang')}}"><b style="color: blue;"> Quản lý hãng </b></a></p>
          </div>

          <div class="div_center">
            <h2 class="h2_font">Danh sách hãng</h2>
            <div>
              <form action="{{url('search_brand')}}" method="get">
                @csrf
                <input type="text" style="color: black;" name="search" placeholder="Nhập thông tin cần tìm">
                <input type="submit" value="Tìm kiếm" class="btn btn-outline-primary" style="color: black; background-color: lightgreen; font-weight: bold; width: 100px; height: 38px;">
              </form>
            </div>

            <table class="center">
              <tr>
                <td><b>ID</b></td>
                <td><b>Tên hãng</b></td>
                <td><b>Hình ảnh</b></td>
                <td><b>Slug</b></td>
                <td><b>Ngày tạo</b></td>
                <td><b>Ngày cập nhật</b></td>
                <td><a id="addBrandButton" class="btn btn-primary" href="javascript:void(0);"><b>Thêm mới</b></a></td>
              </tr>

              @foreach($brand as $brand)
              <tr>
                <td>{{$brand->id}}</td>
                <td>{{$brand->title}}</td>
                <td>
                  <img class="img_size" src="/brand_img/{{$brand->image}}">
                </td>
                <td>{{$brand->slug}}</td>
                <td>{{$brand->created_at}}</td>
                <td>{{$brand->updated_at}}</td>
                <td>
                  <div class="button">
                    <a class="btn btn-primary" href="{{url('chinh-sua-hang',$brand->id)}}"><b>Chỉnh sửa</b></a>
                  </div>
                  <div class="button">
                    <a class="btn btn-danger delete_brand" href="{{url('xoa-hang',$brand->id)}}" data-brand-name="{{$brand->title}}"><b>Xóa</b></a>
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
  //Modal thêm mới hãng
  // Get the modal
  var modal = document.getElementById('addBrandModal');

  // Get the button that opens the modal
  var addButton = document.getElementById('addBrandButton'); // Add an id to your "Thêm mới" button

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

  //Xóa hãng
  $(document).ready(function() {
    $(".delete_brand").click(function(e) {
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