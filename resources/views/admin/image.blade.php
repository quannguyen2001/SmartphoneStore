<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lý hình ảnh</title>
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
      <div id="addImageModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <!-- Your existing form content goes here -->
          <form id="adImagerForm" action="{{url('/add_image')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Your existing form fields go here -->
            <div class="div_modal_center">
              <h2 style="font-size: 25px;">Thêm mới hình ảnh</h2>

              <form action="{{url('/add_image')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                  <div class="div_design">
                    <label>Hãng sản xuất:</label>
                    <select class="text_color" id="brand_id" name="brand_id" required="">
                      <option value="" disabled selected>Chọn hãng sản xuất</option>
                      @foreach($brand as $brand)
                      <option value="{{$brand->id}}">{{$brand->title}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="div_design">
                    <label>Tên điện thoại:</label>
                    <select class="text_color" id="product_id" name="product_id" required="">
                      <option value="" disabled selected>Chọn tên điện thoại</option>
                    </select>
                  </div>

                  <div class="div_design">
                    <label>Màu sắc:</label>
                    <input class="text_color" type="text" name="color" placeholder="Nhập màu điện thoại" required="">
                  </div>

                  <div class="div_design">
                    <label>Hình ảnh điện thoại:</label>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-hinh-anh')}}"><b style="color: blue;"> Quản lý hình ảnh </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Danh sách hình ảnh sản phẩm</h2>


            <div>
              <input type="text" id="searchInput" style="color: black;" placeholder="Nhập thông tin cần tìm">
              <button id="searchButton" class="btn btn-outline-primary" style="color: black; background-color: lightgreen; font-weight: bold; width: 100px; height: 38px;">Tìm kiếm</button>
            </div>

            <div class="center"> <!-- Đổi thẻ div để bọc bảng -->
              <table class="center">
                <tr>
                  <td><b>STT</b></td>
                  <td><b>Tên sản phẩm</b></td>
                  <td><b>Hãng sản xuất</b></td>
                  <td><b>Màu sắc</b></td>
                  <td><b>Hình ảnh</b></td>
                  <td><a id="addImageButton" class="btn btn-primary" href="javascript:void(0);"><b>Thêm mới</b></a></td>
                </tr>

                @foreach($colors as $key => $color)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$color->product->name}}</td>
                  <td>{{$color->product->brand->title}}</td>
                  <td>{{$color->color}}</td>
                  <td style="padding-left: 10px;">
                    <img style="width: 120px; height: 100px; object-fit: contain;" src="/product_color_img/{{$color->image}}">
                  </td>
                  <td style="width: 120px; padding-left: 5px;">
                    <div class="button">
                      <a class="btn btn-primary" href="{{url('chinh-sua-hinh-anh',$color->id)}}"><b>Chỉnh sửa</b></a>
                    </div>
                    <div class="button">
                      <a class="btn btn-danger delete_color" href="{{url('xoa-hinh-anh',$color->id)}}" data-color-name="{{$color->product->name}} màu {{$color->color}}"><b>Xóa</b></a>
                    </div>


                  </td>
                </tr>
                @endforeach


              </table>
              <!-- <div class="pagination">
                {{ $colors->links('pagination::bootstrap-4') }}
              </div> -->
              <div class="pagination">
                @if ($colors->currentPage() > 1)
                <a href="{{ $colors->previousPageUrl() }}">
                  <i class="fa fa-angle-left"></i>
                </a>
                @endif

                @php
                $start = max(1, $colors->currentPage() - 4);
                $end = min($colors->lastPage(), $colors->currentPage() + 4);
                @endphp

                @if ($start > 1)
                <span>...</span>
                @endif

                @for ($i = $start; $i <= $end; $i++) <a href="{{ $colors->url($i) }}" class="{{ $i == $colors->currentPage() ? 'current' : '' }}">{{ $i }}</a>
                  @endfor

                  @if ($end < $colors->lastPage())
                    <span>...</span>
                    @endif

                    @if ($colors->currentPage() < $colors->lastPage())
                      <a href="{{ $colors->nextPageUrl() }}">
                        <i class="fa fa-angle-right"></i>
                      </a>
                      @endif
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
  @include('admin.script')
</body>

</html>
<script>
  //Modal thêm mới banner
  // Get the modal
  var modal = document.getElementById('addImageModal');

  // Get the button that opens the modal
  var addButton = document.getElementById('addImageButton'); // Add an id to your "Thêm mới" button

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

  $(document).ready(function() {
    // Handle search button click
    $('#searchButton').on('click', function() {
      // Get the search input value
      var searchValue = $('#searchInput').val();

      // Perform the search action using JavaScript or redirect to the search URL
      // You can adjust this part based on your application's requirements

      // For example, redirect to the search URL
      window.location.href = '{{url("search_image")}}?search=' + encodeURIComponent(searchValue);
    });
  });

  $(document).ready(function() {
    $(".delete_color").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var colorName = $(this).data('color-name');
      var deleteUrl = $(this).attr('href'); // Lấy địa chỉ URL để xóa

      if (colorName && !$(this).data('clicked')) {
        Swal.fire({
          title: 'Xác nhận xóa',
          text: 'Bạn có muốn xóa hình ảnh ' + colorName + ' không?',
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
                  'Bạn đã xóa hình ảnh ' + colorName + ' thành công' +
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
</script>