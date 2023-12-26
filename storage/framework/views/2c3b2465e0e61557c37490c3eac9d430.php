<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Đơn hàng</title>
	<link rel="shortcut icon" href="home/img/favicon.ico" />

	<!-- Load font awesome icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
	<!-- tidio - live chat -->
	<!-- <script src="//code.tidio.co/bfiiplaaohclhqwes5xivoizqkq56guu.js"></script> -->

	<!-- our files -->
	<!-- css -->
	<link rel="stylesheet" href="<?php echo e(asset('home/css/style.css?version=1.1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('home/css/topnav.css?version=1.1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('home/css/header.css?version=1.1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('home/css/banner.css?version=1.1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('home/css/trangchu.css?version=1.1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('home/css/taikhoan.css?version=1.1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('home/css/gioHang.css?version=1.1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('home/css/footer.css?version=1.1')); ?>">


	<!-- js -->
	<script src="<?php echo e(asset('home/data/products.js')); ?>"></script>
	<script src="<?php echo e(asset('home/js/classes.js')); ?>"></script>
	<script src="<?php echo e(asset('home/js/dungchung.js')); ?>"></script>
	<script src="<?php echo e(asset('home/js/trangchu.js')); ?>"></script>
	<script src="<?php echo e(asset('home/js/giohang.js')); ?>"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
	<?php echo $__env->make('home.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<section>
		<?php echo $__env->make('home.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<?php echo $__env->make('home.brand', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="breadcrumb">
			<p><a href="/"><b>Trang chủ </b></a>><a href=""><b style="color: blue;"> Đơn hàng </b></a></p>
		</div>

		<h1 style="text-align: center; font-weight: bold; font-size: 30px;">Thông tin đơn hàng</h1>
		<div class="table_product" style="min-height: 350px">
			<table class="listSanPham">
				<tbody>

					<?php if(count($mergedorders) > 0): ?>
					<?php $totalorder = 0;  ?>
					<tr>
						<th>Mã đơn hàng</th>
						<th>Số sản phẩm đã mua</th>
						<th>Tổng tiền</th>
						<th>Thời gian mua</th>
						<th>Trạng thái đơn hàng</th>
						<th>Trạng thái thanh toán</th>
						<th>Chi tiết đơn hàng</th>
						<th>Hành động</th>
					</tr>
					<?php $__currentLoopData = $mergedorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td style="min-width: 125px;"><?php echo e($key); ?></td>

						<td class="soluong" style="min-width: 120px;">

							<input size="1" value="<?php echo e($order['total_quantity']); ?>" readonly>

						</td>
						<td class="noPadding" style="min-width: 130px;"><?php echo e(number_format($order['total_amount'], 0, ',', '.')); ?>₫</td>
						<td class=" noPadding" style="min-width: 170px;"><?php echo e(\Carbon\Carbon::parse($order['time'])->format('H:i:s d-m-Y')); ?></td>
						<td class="noPadding" style="min-width: 170px;">
							<?php if($order['delivery_status']==0): ?>
							Đang chờ duyệt
							<?php elseif($order['delivery_status']==1): ?>
							Đang vận chuyển
							<?php elseif($order['delivery_status']==2): ?>
							Đã giao hàng
							<?php else: ?>
							<b>Đơn đã bị hủy</b>
							<?php endif; ?>
						</td>
						<td class="noPadding" style="min-width: 160px;">
							<?php if($order['delivery_status']==3): ?>
							<b>Đơn đã bị hủy</b>
							<?php else: ?>
							<?php if($order['payment_status']==0): ?>
							Thanh toán trả sau khi giao hàng
							<?php elseif($order['payment_status']==1): ?>
							Đã thanh toán qua VNPAY
							<?php else: ?>
							Đã thanh toán
							<?php endif; ?>
							<?php endif; ?>
						</td>
						<td class="noPadding" style="min-width: 170px; text-align:center;">
							<a href="<?php echo e(url('chi-tiet-don-hang',$key)); ?>">Xem chi tiết</a>
						</td>
						
						<td class="noPadding" style="min-width: 160px; text-align:center;">
							<?php if($order['delivery_status']==0 && $order['payment_status']==0): ?>
							<a class="button_cancel" href="javascript:void(0);" onclick="cancelOrder('<?php echo e(url('order_cancel', $key)); ?>')">Hủy đơn hàng</a>
							<?php endif; ?>
						</td>


					</tr>
					<?php $totalorder = $totalorder + 1 ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


					<tr style="font-weight:bold; text-align:center">
						<td colspan="2">TỔNG SỐ ĐƠN HÀNG: </td>
						<td colspan="2"><?php echo e($totalorder); ?></td>
						<td colspan="2">TỔNG SỐ ĐƠN HÀNG ĐÃ GIAO: </td>
						<td colspan="2"><?php echo e($count_order_delivered); ?></td>
						<td></td>
					</tr>
					<?php else: ?>
					<tr>
						<th>Số đơn hàng</th>
						<th>Số sản phẩm đã mua</th>
						<th>Tổng tiền</th>
						<th>Thời gian mua</th>
						<th>Trạng thái đơn hàng</th>
						<th>Trạng thái thanh toán</th>
						<th>Chi tiết đơn hàng</th>
						<th>Hủy đơn hàng</th>
						<th>Xóa</th>
					</tr>
					<tr>
						<td colspan="9">Chưa có đơn hàng nào!!!</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

		<?php echo $__env->make('home.chat_messenger', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</section> <!-- End Section -->

	<script>
		// Di chuyển lên đầu trang
		function gotoTop() {
			if (window.jQuery) {
				jQuery('html,body').animate({
					scrollTop: 0
				}, 100);
			} else {
				document.getElementsByClassName('top-nav')[0].scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
				document.body.scrollTop = 0; // For Safari
				document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
			}
		}

		function cancelOrder(cancelUrl) {
			Swal.fire({
				title: 'Bạn chắc chắn muốn hủy đơn hàng?',
				text: 'Hành động này không thể hoàn tác!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Đồng ý',
				cancelButtonText: 'Hủy',
			}).then((result) => {
				if (result.isConfirmed) {
					// Nếu người dùng đồng ý, thực hiện hủy đơn hàng (gửi POST request)
					fetch(cancelUrl, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', // Thêm token CSRF nếu sử dụng Laravel
						},
					}).then(response => {
						// Xử lý phản hồi từ server (nếu cần)
						if (response.ok) {
							Swal.fire('Hủy đơn hàng thành công!', '', 'success')
								.then(() => {
									// Load lại trang sau khi đóng thông báo
									location.reload();
								});
							// Có thể thêm bất kỳ xử lý nào khác sau khi hủy đơn hàng thành công
						} else {
							Swal.fire('Có lỗi xảy ra khi hủy đơn hàng!', '', 'error');
						}
					}).catch(error => {
						console.error('Error:', error);
						Swal.fire('Có lỗi xảy ra khi hủy đơn hàng!', '', 'error');
					});
				}
			});
		}
	</script>
	<?php echo $__env->make('home.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	 
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/home/order.blade.php ENDPATH**/ ?>