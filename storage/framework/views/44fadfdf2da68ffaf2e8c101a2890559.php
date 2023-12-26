<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans;
        }


        .h2_font {
            font-size: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

    </style>
</head>

<body>
    <div class="div_center">
        <h1></h1>
        <table style="border: 0px solid white;">
            <tr style="border: 0px solid white;">
                <td style="width: 28%; border: 0px solid white;">
                    <img src="home/img/logo.jpg" width="100%" height="70px">
                </td>
                <td style="width: 72%; text-align: left; border: 0px solid white; padding-left: 5px;">
                    <h1 style="text-align: center; font-size: 20px;"><b>CÔNG TY CỔ PHẦN THẾ GIỚI ĐIỆN THOẠI</b></h1>
                    <p style="font-size: 15px;"><b>Địa chỉ: </b>55 Giải Phóng, phường Đồng Tâm, Hai Bà Trưng, Hà Nội</p>
                    <p style="font-size: 15px;"><b>Email: </b>thegioidienthoaicorp@gmail.com</p>
                    <p style="font-size: 15px;"><b>Điện thoại: </b>1900 6688</p>

                </td>
            </tr>
        </table>
        <h1 style="text-align: center; font-size: 28px;"><b>HÓA ĐƠN THANH TOÁN</b></h1>

        <!-- Các thông tin đơn hàng -->
        <div>
                <p><b>Mã đơn hàng:</b> <?php echo e($order_id); ?></p>
                <p><b>Tên khách hàng:</b> <?php echo e($user_name); ?></p>
                <p><b>Email:</b> <?php echo e($email); ?></p>
            
                <p><b>Số điện thoại:</b> <?php echo e($phone); ?></p>
                <p><b>Địa chỉ giao hàng:</b> <?php echo e($address); ?></p>
                <p><b>In lúc: </b><?php echo e(\Carbon\Carbon::parse($time)->format('H:i:s d-m-Y')); ?></p>
        </div>




        <div class="center">
            <table class="center">
                <!-- Bảng chi tiết đơn hàng -->

                <tr>
                    <td style="text-align: center;"><b>STT</b></td>
                    <td style="text-align: center;"><b>Tên sản phẩm</b></td>
                    <td style="text-align: center;"><b>Màu sắc</b></td>
                    <td style="text-align: center;"><b>Số lượng</b></td>
                    <td style="text-align: center;"><b>Giá tiền</b></td>
                    <td style="text-align: center;"><b>Thành tiền</b></td>

                </tr>

                <?php $totalprice = 0; ?>
                <?php $totalproduct = 0; ?>
                <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="width: 10px; height: 45px; text-align: center;"><?php echo e($key + 1); ?></td>
                    <td style="width: 170px; height: 45px; padding-left: 5px;"><?php echo e($orderItem->product->name); ?></td>
                    <td style="width: 100px; height: 45px; text-align: center;"><?php echo e($orderItem->color); ?></td>
                    <td style="width: 50px; height: 45px; text-align:  right; padding-right: 5px;"><?php echo e($orderItem->quantity); ?></td>
                    <td style="width: 120px; height: 45px; text-align:  right; padding-right: 5px;"><?php echo e(number_format($orderItem->price, 0, ',', '.')); ?>₫</td>
                    <td style="width: 120px; height: 45px; text-align:  right; padding-right: 5px;"><?php echo e(number_format($orderItem->total, 0, ',', '.')); ?>₫
                </tr>
                <?php $totalprice = $totalprice + $orderItem->total ?>
                <?php $totalproduct = $totalproduct + $orderItem->quantity ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td style="width: 160px; height: 45px; text-align: center;" colspan="3"><b>Tổng số lượng</b></td>
                    <td style="width: 50px; height: 45px;  text-align:  right; padding-right: 5px;"><?php echo e($totalproduct); ?></td>
                    <td style="width: 140px; height: 45px;  text-align: center;"><b>Tổng tiền</b></td>
                    <td style="width: 120px; height: 45px;  text-align:  right; padding-right: 5px;"><?php echo e(number_format($totalprice, 0, ',', '.')); ?>₫</td>


                </tr>

            </table>
            <p style="font-size: 15px; text-align: center;">Cảm ơn quý khách đã mua các sản phẩm tại cửa hàng chúng tôi !</p>
        </div>
    </div>
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/admin/order_detail_pdf.blade.php ENDPATH**/ ?>