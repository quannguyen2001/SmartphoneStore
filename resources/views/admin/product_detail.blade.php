<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$product->name}}</title>
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
                        <p><a href="/redirect"><b>Trang chủ </b></a>><a href="{{url('quan-ly-san-pham')}}"><b> Quản lý sản phẩm </b>><b style="color: blue;"> {{$product->name}} </b></a></p>
                    </div>
                    <div class="div_center_product_detail">
                        <div class="row">
                            <div class="col-md-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><b>{{$product->name}}</b></h4>
                                        <img style="width: 300px; height: 350px;" src="/product_img/{{$product->image}}">
                                        <!-- <canvas id="transaction-history" class="transaction-chart"></canvas> -->
                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h3 class="mb-1"><b>Giá tiền: </b>{{ number_format($product->price, 0, ',', '.') }}₫</h3>
                                                <h3 class="mb-1"><b>Giá cũ: </b>{{ number_format($product->old_price, 0, ',', '.') }}₫</h3>
                                            </div>
                                            &nbsp&nbsp&nbsp
                                            <div class="text-md-center text-xl-left">
                                                <h3 class="mb-1"><b>Năm sản xuất: </b>{{$product->year}}</h3>

                                            </div>
                                            <!-- <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                            <h3 class="mb-0"><b>Năm sản xuất: </b>{{$product->year}}</h3>
                                        </div> -->
                                        </div>
                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h3 class="mb-1"><b>Link youtube sản phẩm: </b><a href="https://www.youtube.com/watch?v={{$product->link}}" target="_blank">https://www.youtube.com/watch?v={{$product->link}}</a></h3>

                                            </div>
                                        </div>
                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h3 class="mb-1"><b>Slug: </b>{{$product->slug}}</h3>

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
                                                            <h3><b>RAM: </b>{{$product->ram}}</h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>ROM: </b>{{$product->rom}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Hãng sản xuất: </b>{{$product->brand->title}}</h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>PIN: </b>{{$product->pin}} mAh</h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Hệ điều hành: </b>{{$product->software}}</h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>Màn hình: </b>{{$product->screen}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Camera sau: </b>{{$product->camera_sau}}</h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>Camera trước: </b>{{$product->camera_truoc}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Chip: </b>{{$product->chip}}</h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>Sim: </b>{{$product->sim}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-6">
                                                            <h3><b>Cổng sạc: </b>{{ $product->port }}</h3>
                                                        </div>
                                                        <div class="col-6">
                                                            <h3><b>Loại sản phẩm: </b>
                                                                @if($product->type==1)
                                                                Sản phẩm mới
                                                                @elseif($product->type==2)
                                                                Sản phẩm bán chạy
                                                                @else
                                                                Sản phẩm giá rẻ
                                                                @endif
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-12">
                                                            <h3><b>Màu sắc: </b>
                                                                @foreach($colors as $key => $color)
                                                                {{$color->color}}
                                                                @if (!$loop->last)
                                                                ,
                                                                @endif
                                                                @endforeach
                                                            </h3>
                                                        </div>

                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-12">
                                                            <h3><b>Mô tả sản phẩm: </b>{{$product->description}}</h3>
                                                        </div>

                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-12">
                                                            <h3><b>Hộp phụ kiện: </b>{{$product->accessories}}</h3>
                                                        </div>

                                                    </div>
                                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                        <div class="col-12">
                                                            <h3><b>Khuyến mại: </b>{{$product->promotion}}</h3>
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
    @include('admin.script')
</body>

</html>