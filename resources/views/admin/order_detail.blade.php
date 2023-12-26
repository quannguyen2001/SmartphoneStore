<!DOCTYPE html>
<html lang="en">

<head>
  <title>Đơn hàng mã số {{$order_id}}</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-don-hang')}}"><b> Danh sách đơn hàng </b></a>><a href=""><b style="color: blue;"> Thông tin đơn hàng {{$order_id}} </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Thông tin đơn hàng mã số {{$order_id}}</h2>

            <div class="div_info">
              <div class="background_info">
                <div>
                  <p><b>Tên khách hàng:</b> {{$user_name}}</p>
                  <p><b>Email:</b> {{$email}}</p>
                </div>
                <div>
                  <p><b>Địa chỉ giao hàng:</b> {{$address}}</p>
                  <p><b>Số điện thoại:</b> {{$phone}}</p>
                </div>
              </div>
            </div>

            <div class="center">
              <table class="center">
                <tr>
                  <td><b>Hình ảnh</b></td>
                  <td><b>Tên sản phẩm</b></td>
                  <td><b>Màu sắc</b></td>
                  <td><b>Số lượng</b></td>
                  <td><b>Giá tiền</b></td>
                  <td><b>Thành tiền</b></td>
                  <td><b>Thời gian đặt hàng</b></td>
                </tr>

                <?php $totalprice = 0;  ?>
                <?php $totalproduct = 0;  ?>
                @foreach($order as $order)
                <tr>
                  <td><img width="100px" height="150px" src="{{ asset('product_img/' . $order->product->image) }}"></td>
                  <td style="width: 200px; height: 45px;">{{ $order->product->name }}</td>
                  <td style="width: 200px; height: 45px;">{{ $order->color }}</td>
                  <td style="width: 30px; height: 45px;">{{ $order->quantity }}</td>
                  <td style="width: 160px; height: 45px;">{{ number_format($order->price, 0, ',', '.') }}₫</td>
                  <td style="width: 160px; height: 45px;">{{ number_format($order->total, 0, ',', '.') }}₫</td>
                  <td style="width: 200px; height: 45px;">{{ \Carbon\Carbon::parse($order->time)->format('H:i:s d-m-Y') }}</td>
                </tr>
                <?php $totalprice = $totalprice + $order->total ?>
                <?php $totalproduct = $totalproduct + $order->quantity ?>
                @endforeach
                <tr>
                  <td style="width: 160px; height: 45px;" colspan="3"><b>Tổng số lượng</b></td>
                  <td style="width: 160px; height: 45px;"><b>{{$totalproduct}}</b></td>
                  <td style="width: 200px; height: 45px;"><b>Tổng giá trị đơn hàng</b></td>
                  <td style="width: 160px; height: 45px;"><b>{{ number_format($totalprice, 0, ',', '.') }}₫</b></td>
                  <td></td>

                </tr>
                <tr>
                  <td colspan="7">
                    <!-- Thêm nút xuất hóa đơn PDF -->
                    <a href="{{url('print_pdf',$order_id)}}" class="btn btn-primary"><b class="mdi mdi-file-pdf"> Xuất hóa đơn (PDF)</b></a>
                  </td>
                </tr>

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
  @include('admin.script')
</body>

</html>