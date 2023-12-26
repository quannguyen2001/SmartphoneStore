<div class="header group">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('home/img/logo.jpg') }}" alt="Trang chủ Smartphone Store" title="Trang chủ Smartphone Store">
                </a>
            </div>
            <!-- End Logo -->

            <div class="content">
                <div class="search-header" style="position: relative; left: 25px; top: 1px;">
                    <form class="input-search" action="{{url('search')}}" method="get">
                        <div class="autocomplete">
                        @csrf
                            <input id="search-box" name="search" autocomplete="off" type="text" placeholder="Nhập thông tin cần tìm">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                                Tìm kiếm
                            </button>
                        </div>
                    </form> <!-- End Form search -->
                    <div class="tags">
                        <strong>Từ khóa: </strong>
                        @foreach($keyword as $brand)
                            <a href="{{url('dien-thoai',$brand->slug)}}">{{$brand->title}}</a>
                        @endforeach
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
                        @if (Route::has('login'))
                            @auth
                            <div class="account">
                                <x-app-layout>
            
                                </x-app-layout>
                            </div>
                            <div class="check-order">
                                <a  href="{{url('don-hang')}}"> 
                                    <i class="fa fa-truck"></i>
                                    <span>Đơn hàng</span>
                                </a>
                            </div>
                            <div class="cart">
                                <a href="{{url('gio-hang')}}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ hàng 
                                        @if($count_product_cart > 0)
                                        <span class="number">
                                            <b style="font-size: 15px; color: yellow;">
                                                {{$count_product_cart}}
                                            </b>
                                        </span>
                                        @endif
                                    </span>
                                    <span class="cart-number"></span>
                                </a>
                            </div>
                            @else
                            <div class="member">
                                <a href="{{ route('login') }}">
                                    <i class="fa fa-user"></i>
                                    Đăng nhập
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{ route('register') }}"> 
                                    <i class="fa fa-pencil-square"></i>
                                    Đăng ký
                                </a>
                            </div>
                            
                            @endauth
                        @endif
                    
                    
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
        </div>