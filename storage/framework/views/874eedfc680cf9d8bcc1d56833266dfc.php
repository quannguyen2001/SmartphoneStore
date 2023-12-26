<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo e($product->name); ?></title>
    <?php echo $__env->make('admin.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
        <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="menu-select">
                        <div class="menu-select-item"><a href="/redirect">Trang chủ</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-tai-khoan')); ?>">Quản lý tài khoản</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-hang')); ?>">Quản lý hãng</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-banner')); ?>">Quản lý banner</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-san-pham')); ?>">Quản lý sản phẩm</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-hinh-anh')); ?>">Quản lý hình ảnh</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-don-hang')); ?>">Quản lý đơn hàng</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-chi-nhanh')); ?>">Quản lý chi nhánh</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-kho')); ?>">Quản lý kho</a></div>
                        <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-dien-thoai-cu')); ?>">Quản lý điện thoại cũ</a></div>
                        <!-- <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-dien-thoai-cu')); ?>">Quản lý điện thoại cũ</a></div>
      <div class="menu-select-item"><a href="<?php echo e(url('quan-ly-dien-thoai-cu')); ?>">Quản lý điện thoại cũ</a></div> -->
                    </div>
                    <div class="breadcrumb">
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="<?php echo e(url('quan-ly-san-pham')); ?>"><b> Quản lý sản phẩm </b>><b style="color: blue;"> <?php echo e($product->name); ?> </b></a></p>
                    </div>
                    <div class="div_center_product_detail">
                        <div class="row">
                            <div class="col-md-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><b><?php echo e($product->name); ?></b></h4>
                                        <img style="width: 300px; height: 350px;" src="/product_img/<?php echo e($product->image); ?>">
                                        <!-- <canvas id="transaction-history" class="transaction-chart"></canvas> -->
                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h3 class="mb-1"><b>Giá tiền: </b><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫</h3>
                                                <h3 class="mb-1"><b>Giá cũ: </b><?php echo e(number_format($product->old_price, 0, ',', '.')); ?>₫</h3>
                                            </div>
                                            &nbsp&nbsp&nbsp
                                            <div class="text-md-center text-xl-left">
                                                <h3 class="mb-1"><b>Năm sản xuất: </b><?php echo e($product->year); ?></h3>

                                            </div>
                                            <!-- <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                            <h3 class="mb-0"><b>Năm sản xuất: </b><?php echo e($product->year); ?></h3>
                                        </div> -->
                                        </div>
                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h3 class="mb-1"><b>Link youtube sản phẩm: </b><a href="https://www.youtube.com/watch?v=<?php echo e($product->link); ?>" target="_blank">https://www.youtube.com/watch?v=<?php echo e($product->link); ?></a></h3>

                                            </div>
                                        </div>
                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h3 class="mb-1"><b>Slug: </b><?php echo e($product->slug); ?></h3>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-row justify-content-between">
                                            <h4 class="card-title mb-1"><b>Thông số kỹ thuật</b></h4>
                                            <!-- <p class="text-muted mb-1">Your data status</p> -->
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="preview-list">
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>RAM: </b><?php echo e($product->ram); ?></h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>ROM: </b><?php echo e($product->rom); ?></h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Hãng sản xuất: </b><?php echo e($product->brand->title); ?></h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>PIN: </b><?php echo e($product->pin); ?> mAh</h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Hệ điều hành: </b><?php echo e($product->software); ?></h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>Màn hình: </b><?php echo e($product->screen); ?></h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Camera sau: </b><?php echo e($product->camera_sau); ?></h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>Camera trước: </b><?php echo e($product->camera_truoc); ?></h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Chip: </b><?php echo e($product->chip); ?></h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>Sim: </b><?php echo e($product->sim); ?></h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Cổng sạc: </b><?php echo e($product->port); ?></h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>Loại sản phẩm: </b>
                                                                <?php if($product->type==1): ?>
                                                                Sản phẩm mới
                                                                <?php elseif($product->type==2): ?>
                                                                Sản phẩm bán chạy
                                                                <?php else: ?>
                                                                Sản phẩm giá rẻ
                                                                <?php endif; ?>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-12">
                                                            <h3><b>Màu sắc: </b>
                                                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php echo e($color->color); ?>

                                                                <?php if(!$loop->last): ?>
                                                                ,
                                                                <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </h3>
                                                        </div>

                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-12">
                                                            <h3><b>Mô tả sản phẩm: </b><?php echo e($product->description); ?></h3>
                                                        </div>

                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-12">
                                                            <h3><b>Hộp phụ kiện: </b><?php echo e($product->accessories); ?></h3>
                                                        </div>

                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-12">
                                                            <h3><b>Khuyến mại: </b><?php echo e($product->promotion); ?></h3>
                                                        </div>

                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="div_center">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © THE GIOI DIEN THOAI 2023</span>
                            <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span> -->
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php echo $__env->make('admin.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH C:\Users\quan\OneDrive - HUCE\Documents\Doc1\Laravel\SmartphoneStore\resources\views/admin/product_detail.blade.php ENDPATH**/ ?>