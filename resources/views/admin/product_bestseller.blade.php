<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách sản phẩm bán chạy</title>
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
            <p><a href="/redirect"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Sản phẩm bán chạy </b></a></p>
          </div>
          <div class="div_center">
            <h2 class="h2_font">Danh sách sản phẩm bán chạy</h2>

            <div class="center">
              <table class="center">
                <tr>
                  <td><b>TOP</b></td>
                  <td><b>Tên sản phẩm</b></td>
                  <td><b>Hãng sản xuất</b></td>
                  <td><b>Năm sản xuât</b></td>
                  <td><b>Số lượng bán ra</b></td>
                  <td><b>Giá sản phẩm</b></td>

                </tr>

                @foreach($totals as $key => $totals)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$totals->product->name}}</td>
                  <td>{{$totals->product->brand->title}}</td>
                  <td>{{$totals->product->year}}</td>
                  <td>{{$totals->total_sold}}</td>
                  <td>{{ number_format($totals->product->price, 0, ',', '.') }}₫</td>
                </tr>
                @endforeach


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
<!-- <script>
  $(document).ready(function() {
    $(".delete_product").click(function(e) {
      e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

      var productName = $(this).data('product-name');
      var deleteUrl = $(this).attr('href'); // Lấy địa chỉ URL để xóa

      if (productName && !$(this).data('clicked')) {
        Swal.fire({
          title: 'Xác nhận xóa sản phẩm',
          text: 'Bạn có muốn xóa sản phẩm ' + productName + ' không?',
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
                  'Bạn đã xóa sản phẩm ' + productName + ' thành công' +
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
</script> -->