<div class="header group">
            <div class="logo">
                <a href="/">
                    <img src="<?php echo e(asset('home/img/logo.jpg')); ?>" alt="Trang chủ Smartphone Store" title="Trang chủ Smartphone Store">
                </a>
            </div>
            <!-- End Logo -->

            <div class="content">
                <div class="search-header" style="position: relative; left: 25px; top: 1px;">
                    <form class="input-search" action="<?php echo e(url('search')); ?>" method="get">
                        <div class="autocomplete">
                        <?php echo csrf_field(); ?>
                            <input id="search-box" name="search" autocomplete="off" type="text" placeholder="Nhập thông tin cần tìm">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                                Tìm kiếm
                            </button>
                        </div>
                    </form> <!-- End Form search -->
                    <div class="tags">
                        <strong>Từ khóa: </strong>
                        <?php $__currentLoopData = $keyword; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(url('dien-thoai',$brand->slug)); ?>"><?php echo e($brand->title); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- <a href="index.html?search=Samsung">Samsung</a>
                        <a href="index.html?search=iPhone">iPhone</a>
                        <a href="index.html?search=Huawei">Huawei</a>
                        <a href="index.html?search=Oppo">Oppo</a>
                        <a href="index.html?search=Mobi">Mobi</a> -->
                    </div>
                </div> <!-- End Search header -->

                <div class="tools-member">
                     
                    <!-- End Cart -->
                    
                    <!-- End Order -->

                    
                 
                        <!-- <a onclick="checkTaiKhoan()">
                            <i class="fa fa-user"></i>
                            Tài khoản
                        </a>
                        <div class="menuMember hide">
                            <a href="nguoidung.html">Trang người dùng</a>
                            <a onclick="if(window.confirm('Xác nhận đăng xuất ?')) logOut();">Đăng xuất</a>
                        </div> -->
                        <?php if(Route::has('login')): ?>
                            <?php if(auth()->guard()->check()): ?>
                            <div class="account">
                                <?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
                            </div>
                            <div class="check-order">
                                <a  href="<?php echo e(url('don-hang')); ?>"> 
                                    <i class="fa fa-truck"></i>
                                    <span>Đơn hàng</span>
                                </a>
                            </div>
                            <div class="cart">
                                <a href="<?php echo e(url('gio-hang')); ?>">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ hàng 
                                        <?php if($count_product_cart > 0): ?>
                                        <span class="number">
                                            <b style="font-size: 15px; color: yellow;">
                                                <?php echo e($count_product_cart); ?>

                                            </b>
                                        </span>
                                        <?php endif; ?>
                                    </span>
                                    <span class="cart-number"></span>
                                </a>
                            </div>
                            <?php else: ?>
                            <div class="member">
                                <a href="<?php echo e(route('login')); ?>">
                                    <i class="fa fa-user"></i>
                                    Đăng nhập
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo e(route('register')); ?>"> 
                                    <i class="fa fa-pencil-square"></i>
                                    Đăng ký
                                </a>
                            </div>
                            
                            <?php endif; ?>
                        <?php endif; ?>
                    
                    
                    <!-- End Member -->

                    

                    <!--<div class="check-order">
                    <a>
                        <i class="fa fa-truck"></i>
                        <span>Đơn hàng</span>
                    </a>
                </div> -->
                </div>
                <!-- End Tools Member -->
            </div>
            <!-- End Content -->
        </div><?php /**PATH /var/www/html/SmartphoneStore/resources/views/home/navbar.blade.php ENDPATH**/ ?>