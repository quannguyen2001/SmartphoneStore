<div class="flexContain">

			<div class="dropdown">
				<button class="dropbtn">Giá tiền</button>
				<div class="dropdown-content">
                    <a href="{{url('san-pham-duoi-4-trieu')}}">Dưới 4 triệu</a>
                    <a href="{{url('san-pham-tu-4-den-10-trieu')}}">Từ 4 - 10 triệu</a>
                    <a href="{{url('san-pham-tu-10-den-20-trieu')}}">Từ 10 - 20 triệu</a>
                    <a href="{{url('san-pham-tren-20-trieu')}}">Trên 20 triệu</a>
                </div>
			</div>

			<!-- <div class="promosFilter dropdown">
				<button class="dropbtn">Khuyến mãi</button>
				<div class="dropdown-content"><a href="">Giảm giá</a><a href="index.html?promo=tragop">Trả góp</a><a href="index.html?promo=moiramat">Mới ra mắt</a><a href="index.html?promo=giareonline">Giá rẻ online</a></div>
			</div> -->

			<div class="dropdown">
				<button class="dropbtn">RAM</button>
				<div class="dropdown-content">
                    <a href="{{url('san-pham-ram-4gb')}}">4 GB</a>
                    <a href="{{url('san-pham-ram-6gb')}}">6 GB</a>
                    <a href="{{url('san-pham-ram-8gb')}}">8 GB</a>
                    <a href="{{url('san-pham-ram-12gb')}}">12 GB</a> 
                </div>
			</div>

            <div class="dropdown">
				<button class="dropbtn">ROM</button>
				<div class="dropdown-content">
                    <a href="{{url('san-pham-rom-64gb')}}">64 GB</a>
                    <a href="{{url('san-pham-rom-128gb')}}">128 GB</a>
                    <a href="{{url('san-pham-rom-256gb')}}">256 GB</a>
                    <a href="{{url('san-pham-rom-512gb')}}">512 GB</a>
                    <a href="{{url('san-pham-rom-1tb')}}">1 TB</a>
                </div>
			</div>

            <div class="dropdown">
				<button class="dropbtn">PIN</button>
				<div class="dropdown-content">
                    <a href="{{url('san-pham-pin-duoi-3000mAh')}}">Dưới 3000 mAh</a>
                    <a href="{{url('san-pham-pin-tu-3000-den-4000mAh')}}">3000 - 4000 mAh</a>
                    <a href="{{url('san-pham-pin-tu-4000-den-5000mAh')}}">4000 - 5000 mAh</a>
                    <a href="{{url('san-pham-pin-tren-5000mAh')}}">Trên 5000 mAh</a>
                </div>
			</div>

			<div class="dropdown">
				<button class="dropbtn">Sắp xếp</button>
				<div class="dropdown-content">
                    <a href="{{url('san-pham-gia-tang-dan')}}">Giá tăng dần</a>
                    <a href="{{url('san-pham-gia-giam-dan')}}">Giá giảm dần</a>
                    <a href="{{url('san-pham-ten-A-Z')}}">Tên A-Z</a>
                    <a href="{{url('san-pham-ten-Z-A')}}">Tên Z-A</a>
                </div>
			</div>

		</div>

		<!-- <div class="choosedFilter flexContain">
            <a id="deleteAllFilter" style="display: none;">
                <h3>Xóa bộ lọc</h3>
            </a>
        </div> -->
        <!-- Những bộ lọc đã chọn -->
        <hr>

        <!-- Mặc định mới vào trang sẽ ẩn đi, nế có filter thì mới hiện lên -->
        <div class="contain-products" style="display:none">
            <div class="filterName">
                <input type="text" placeholder="Lọc trong trang theo tên..." onkeyup="filterProductsName(this)">
            </div> <!-- End FilterName -->

            <ul id="products" class="homeproduct group flexContain">
                <div id="khongCoSanPham">
                    <i class="fa fa-times-circle"></i>
                    Không có sản phẩm nào
                </div>
                <!-- End Khong co san pham -->
            </ul>
            <!-- End products -->

            <div class="pagination"></div>
        </div>