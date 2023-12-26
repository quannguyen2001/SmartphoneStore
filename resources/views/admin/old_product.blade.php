<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lý sản phẩm cũ</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-dien-thoai-cu')}}"><b style="color: blue;"> Quản lý điện thoại cũ </b></a></p>
          </div>

          <div class="div_button_center">
            <div class="button">
              <button class="btn btn-success" onclick="showSection('productList')">Danh sách sản phẩm cũ</button>
              <button class="btn btn-success" onclick="showSection('orderList')">Danh sách khách đặt hàng</button>
            </div>
          </div>

          <div class="div_center productList">
            <h2 class="h2_font">Danh sách sản phẩm cũ</h2>
            <div>
              <input type="text" id="searchInput" style="color: black;" placeholder="Nhập thông tin cần tìm">
              <button id="searchButton" class="btn btn-outline-primary" style="color: black; background-color: lightgreen; font-weight: bold; width: 100px; height: 38px;">Tìm kiếm</button>
            </div>

            <div class="center"> <!-- Đổi thẻ div để bọc bảng -->
              <table class="center">
                <tr>
                  <td><b>STT</b></td>
                  <td><b>Tên sản phẩm</b></td>
                  <td><b>Màu sắc</b></td>
                  <td><b>IMEI</b></td>
                  <td><b>Giá sản phẩm</b></td>
                  <td><b>Thời điểm mua lại</b></td>
                  <td><b>Thời hạn bảo hành</b></td>
                  <td><b>Trạng thái sản phẩm</b></td>
                  <td><b>Trạng thái bán</b></td>
                  <td><b>Hình ảnh 1</b></td>
                  <td><b>Hình ảnh 2</b></td>
                  <td><b>Hình ảnh 3</b></td>
                  <td><a onclick="" class="btn btn-primary" href="{{url('them-moi-dien-thoai-cu')}}"><b>Thêm mới</b></a></td>
                </tr>

                @foreach($old_products as $key => $old_product)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$old_product->product->name}}</td>
                  <td>{{$old_product->color->color}}</td>
                  <td>{{$old_product->imei}}</td>
                  <td>{{ number_format($old_product->new_price, 0, ',', '.') }}₫</td>
                  <td>{{ \Carbon\Carbon::parse($old_product['time_buy'])->format('d-m-Y') }}</td>
                  <td>{{$old_product->time_guarantee}}</td>
                  <td>{{$old_product->status_product}}</td>
                  @if($old_product->status_sale==1)
                  <td>Chưa bán</td>
                  @else
                  <td>Đã bán</td>
                  @endif
                  <td style="padding-left: 10px;">
                    <img style="width: 360px; height: 150px; object-fit: cover;" src="/old_product_img/{{$old_product->image1}}">
                  </td>
                  <td style="padding-left: 10px;">
                    <img style="width: 360px; height: 150px; object-fit: cover;" src="/old_product_img/{{$old_product->image2}}">
                  </td>
                  <td style="padding-left: 10px;">
                    <img style="width: 360px; height: 150px; object-fit: cover;" src="/old_product_img/{{$old_product->image3}}">
                  </td>
                  <td style="width: 120px; padding-left: 5px;">
                    <div class="button">
                      <a class="btn btn-primary" href="{{url('chinh-sua-dien-thoai-cu',$old_product->id)}}"><b>Chỉnh sửa</b></a>
                    </div>
                    <div class="button">
                      <a class="btn btn-danger delete_old_product" href="{{url('xoa-dien-thoai-cu',$old_product->id)}}" data-old-product-name="{{$old_product->product->name}}"><b>Xóa</b></a>
                    </div>


                  </td>
                </tr>
                @endforeach


              </table>
              <div class="pagination">
                @if ($old_products->currentPage() > 1)
                <a href="{{ $old_products->previousPageUrl() }}">
                  <i class="fa fa-angle-left"></i>
                </a>
                @endif

                @php
                $start = max(1, $old_products->currentPage() - 4);
                $end = min($old_products->lastPage(), $old_products->currentPage() + 4);
                @endphp

                @if ($start > 1)
                <span>...</span>
                @endif

                @for ($i = $start; $i <= $end; $i++) <a href="{{ $old_products->url($i) }}" class="{{ $i == $old_products->currentPage() ? 'current' : '' }}">{{ $i }}</a>
                  @endfor

                  @if ($end < $old_products->lastPage())
                    <span>...</span>
                    @endif

                    @if ($old_products->currentPage() < $old_products->lastPage())
                      <a href="{{ $old_products->nextPageUrl() }}">
                        <i class="fa fa-angle-right"></i>
                      </a>
                      @endif
              </div>
            </div>

          </div>

          <div class="div_center orderList hidden">
            <h2 class="h2_font">Danh sách khách đặt hàng</h2>

            <div class="center"> <!-- Đổi thẻ div để bọc bảng -->
              <table class="center">
                <tr>
                  <td><b>STT</b></td>
                  <td><b>Tên khách hàng</b></td>
                  <td><b>Số điện thoại</b></td>
                  <td><b>Tên sản phẩm</b></td>
                  <td><b>Màu sắc</b></td>
                  <td><b>IMEI</b></td>
                  <td><b>Giá sản phẩm</b></td>
                  <td><b>Trạng thái</b></td>
                  <td><b>Thời gian đặt hàng</b></td>
                  <td><b>Hiệu lực đặt hàng</b></td>

                  <td></td>
                </tr>

                @foreach($order_old_product as $key => $order)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$order->user_name}}</td>
                  <td>{{$order->phone}}</td>
                  <td>{{$order->old_product->product->name}}</td>
                  <td>{{$order->old_product->color->color}}</td>
                  <td>{{$order->old_product->imei}}</td>
                  <td>{{ number_format($order->price, 0, ',', '.') }}₫</td>
                  @if($order->status==0)
                  <td>Khách chưa mua sản phẩm</td>
                  @else
                  <td style="color: blue;">Khách đã mua sản phẩm</td>
                  @endif
                  <td>{{$order->time_order}}</td>
                  <td>
                    @php
                    $timeValidity = strtotime($order->time_order) + (24 * 60 * 60); // Thời gian hiệu lực tối đa 1 ngày
                    $currentTimestamp = strtotime('now');
                    $isValid = $currentTimestamp <= $timeValidity; @endphp @if($isValid) Còn hiệu lực @else Hết hiệu lực @endif </td>

                  <td style="width: 120px; padding-left: 5px;">
                    <div class="button">
                      @if($order->status==0)
                      <a onclick="event.preventDefault(); 
                      document.getElementById('update-payment-form-{{$order->id}}').submit();
                          " class="btn btn-primary" href="#"><b>Khách đã mua</b></a>

                      <form id="update-payment-form-{{$order->id}}" action="{{url('update_order_old_product_done', $order->id)}}" method="POST" style="display: none;">
                        @csrf
                      </form>

                      @else
                      <a class="btn btn-success" href="#"><b>Khách đã mua</b></a>
                      @endif
                    </div>
                    <div class="button">
                      <a class="btn btn-danger delete_order_old_product" href="{{url('xoa-khach-dat-hang',$order->id)}}" data-order-old-product-name="{{$order->user_name}}"><b>Xóa</b></a>
                    </div>


                  </td>
                </tr>
                @endforeach


              </table>
              <div class="pagination">
                {{ $order_old_product->links('pagination::bootstrap-4') }}
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
  var buttons = document.querySelectorAll('.button button');
  var sections = document.querySelectorAll('.div_center:not(.button)');

  function showSection(sectionName) {
    // Ẩn tất cả các phần trừ phần danh sách sản phẩm cũ
    sections.forEach(function(section) {
      section.classList.add('hidden');
    });

    // Hiển thị phần được chọn
    var selectedSection = document.querySelector('.' + sectionName);
    selectedSection.classList.remove('hidden');
  }


  $(document).ready(function() {
    $(".delete_old_product").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var oldProductName = $(this).data('old-product-name');
      var deleteUrl = $(this).attr('href'); // Lấy địa chỉ URL để xóa

      if (oldProductName && !$(this).data('clicked')) {
        Swal.fire({
          title: 'Xác nhận xóa sản phẩm',
          text: 'Bạn có muốn xóa sản phẩm ' + oldProductName + ' không?',
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
                  'Bạn đã xóa sản phẩm ' + oldProductName + ' thành công' +
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
    $(".delete_order_old_product").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var orderOldProductName = $(this).data('order-old-product-name');
      var deleteUrl = $(this).attr('href'); // Lấy địa chỉ URL để xóa

      if (orderOldProductName && !$(this).data('clicked')) {
        Swal.fire({
          title: 'Xác nhận xóa',
          text: 'Bạn có muốn xóa khách ' + orderOldProductName + ' không?',
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
                  'Bạn đã xóa khách ' + orderOldProductName + ' thành công' +
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
  

    // Function to handle form submission and show notification
    

    $(".btn-secondary").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var formId = $(this).attr('id');

      $("#" + formId).submit();

      showNotification('Cập nhật thành công!');
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
      window.location.href = '{{url("search_old_product")}}?search=' + encodeURIComponent(searchValue);
    });
  });
</script>