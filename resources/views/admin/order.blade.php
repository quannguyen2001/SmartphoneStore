<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lý đơn hàng</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Quản lý đơn hàng </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Quản lý đơn hàng</h2>
            <div class="center">
              <form action="{{url('search_order')}}" method="get">
                @csrf
                <input type="text" style="color: black;" name="search" placeholder="Nhập mã đơn hàng cần tìm">
                <input type="submit" value="Tìm kiếm" class="btn btn-outline-primary" style="color: black; background-color: lightgreen; font-weight: bold; width: 100px; height: 38px;">
              </form>


            </div>

            <div class="center">
              <button class="btn btn-outline-primary" style="color: black; background-color: lightblue; font-weight: bold; width: 140px; height: 45px;"><a href="{{url('quan-ly-don-hang/don-dang-cho-duyet')}}">Đơn đang chờ duyệt</a></button>
              <button class="btn btn-outline-primary" style="color: black; background-color: lightblue; font-weight: bold; width: 140px; height: 45px;"><a href="{{url('quan-ly-don-hang/don-dang-van-chuyen')}}">Đơn đang vận chuyển</a></button>
              <button class="btn btn-outline-primary" style="color: black; background-color: lightblue; font-weight: bold; width: 140px; height: 45px;"><a href="{{url('quan-ly-don-hang/don-da-giao-hang')}}">Đơn đã giao hàng</a></button>
              <button class="btn btn-outline-primary" style="color: black; background-color: lightblue; font-weight: bold; width: 140px; height: 45px;"><a href="{{url('quan-ly-don-hang/don-dang-da-huy')}}">Đơn đã bị hủy</a></button>
              <button class="btn btn-outline-primary" style="color: black; background-color: lightblue; font-weight: bold; width: 140px; height: 45px;"><a href="{{url('quan-ly-don-hang/don-dang-chua-thanh-toan')}}">Đơn chưa thanh toán</a></button>
              <button class="btn btn-outline-primary" style="color: black; background-color: lightblue; font-weight: bold; width: 140px; height: 45px;"><a href="{{url('quan-ly-don-hang/don-dang-da-thanh-toan')}}">Đơn đã thanh toán</a></button>
              <button class="btn btn-outline-primary" style="color: black; background-color: lightblue; font-weight: bold; width: 140px; height: 45px;"><a href="{{url('quan-ly-don-hang/don-dang-da-thanh-toan-vnpay')}}">Đơn đã thanh toán VNPAY</a></button>
              <button class="btn btn-outline-primary" style="color: black; background-color: lightblue; font-weight: bold; width: 140px; height: 45px;"><a href="{{url('https://sandbox.vnpayment.vn/merchantv2/Home/Dashboard.htm')}}">Xem đơn hàng trên VNPAY</a></button>
            </div>

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

                @foreach($mergedorders as $key => $order)
                <tr>
                  <td style="width: 100px;">{{$key}}</td>
                  <td>{{$order['total_quantity']}}</td>
                  <td>{{ number_format($order['total_amount'], 0, ',', '.') }}₫</td>
                  <td style="width: 170px;">{{ \Carbon\Carbon::parse($order['time'])->format('H:i:s d-m-Y') }}</td>
                  <td style="width: 150px;">
                    @if($order['delivery_status']==0)
                    Đang chờ duyệt
                    @elseif($order['delivery_status']==1)
                    Đang vận chuyển
                    @elseif($order['delivery_status']==2)
                    Đã giao hàng
                    @else
                    <b style="color: blue;">Đơn hàng đã bị hủy</b>
                    @endif
                  </td>
                  <td>
                    @if($order['delivery_status']==3)
                    <b style="color: blue;">Đơn hàng đã bị hủy</b>
                    @else
                    @if($order['payment_status']==0)
                    Thanh toán trả sau khi giao hàng
                    @elseif($order['payment_status']==1)
                    Đã thanh toán qua VNPAY
                    @else
                    Đã thanh toán
                    @endif
                    @endif
                  </td>
                  <td style="width: 120px;">
                    @if($order['delivery_status']==0)
                    <a onclick="event.preventDefault(); 
            document.getElementById('update-form-{{$key}}').submit();
             " class="btn btn-primary" href="#"><b>Duyệt đơn</b></a>

                    <form id="update-form-{{$key}}" action="{{url('update_order_delivery', $key)}}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    @elseif($order['delivery_status']==1)
                    <a onclick="event.preventDefault(); 
            document.getElementById('update-form-{{$key}}').submit();
             " class="btn btn-secondary" href="#"><b>Đã giao hàng</b></a>

                    <form id="update-form-{{$key}}" action="{{url('update_order_done', $key)}}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    @elseif($order['delivery_status']==2)
                    <a class="btn btn-success" href="#"><b>Đã giao hàng</b></a><br>
                    @else

                    @endif
                  </td>
                  <td style="width: 150px; height: 45px;">
                    @if($order['delivery_status']==3)

                    @else
                    @if($order['payment_status']==0)
                    <a onclick="event.preventDefault(); 
            document.getElementById('update-payment-form-{{$key}}').submit();
             " class="btn btn-primary" href="#"><b>Đã thanh toán</b></a>

                    <form id="update-payment-form-{{$key}}" action="{{url('update_order_payment', $key)}}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    @elseif($order['payment_status']==1)

                    @else
                    <a onclick="event.preventDefault(); 
            document.getElementById('update-not-payment-form-{{$key}}').submit();
             " class="btn btn-secondary" href="#"><b>Chưa thanh toán</b></a>

                    <form id="update-not-payment-form-{{$key}}" action="{{url('update_order_not_payment', $key)}}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    @endif
                    @endif
                  </td>
                  <td style="width: 165px; height: 45px;">
                    <a onclick="" class="btn btn-info" href="{{url('don-hang', $key)}}"><b>Chi tiết đơn hàng</b></a><br>
                  </td>
                  <td>
                    @if($order['delivery_status']==0 && $order['payment_status']==0)
                    <a onclick="event.preventDefault(); 
            document.getElementById('update-form-order-cancel-{{$key}}').submit();
             " class="btn btn-danger" href="#"><b>Hủy</b></a>

                    <form id="update-form-order-cancel-{{$key}}" action="{{url('update_order_cancel', $key)}}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    @else

                    @endif
                  </td>
                </tr>
                @endforeach

              </table>
            </div>
            <div class="pagination">
              @if ($mergedorders->currentPage() > 1)
              <a href="{{ $mergedorders->previousPageUrl() }}">
                <i class="fa fa-angle-left"></i>
              </a>
              @endif

              @php
              $start = max(1, $mergedorders->currentPage() - 4);
              $end = min($mergedorders->lastPage(), $mergedorders->currentPage() + 4);
              @endphp

              @if ($start > 1)
              <span>...</span>
              @endif

              @for ($i = $start; $i <= $end; $i++) <a href="{{ $mergedorders->url($i) }}" class="{{ $i == $mergedorders->currentPage() ? 'current' : '' }}">{{ $i }}</a>
                @endfor

                @if ($end < $mergedorders->lastPage())
                  <span>...</span>
                  @endif

                  @if ($mergedorders->currentPage() < $mergedorders->lastPage())
                    <a href="{{ $mergedorders->nextPageUrl() }}">
                      <i class="fa fa-angle-right"></i>
                    </a>
                    @endif
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
</script>