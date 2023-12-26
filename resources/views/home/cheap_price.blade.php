<div class="khungSanPham" style="border-color: #5de272">
    <h3 class="tenKhung" style="background-image: linear-gradient(120deg, #5de272 0%, #007012 50%, #5de272 100%);">* SẢN PHẨM GIÁ RẺ *</h3>
    <div class="listSpTrongKhung flexContain">
        @foreach($cheap_price_product as $product)
        <li class="sanPham">
            <a href="{{url('chi-tiet-san-pham/' .$product->slug)}}">
                <img src="{{ asset('product_img/' . $product->image) }}" alt="">
                <h3><b>{{$product->name}}</b></h3>
                <div class="price">
                    @if($product->old_price > $product->price)
                    <b class="price_old_product">
                        {{ number_format($product->old_price, 0, ',', '.') }}₫
                    </b>
                    <?php
                    $discountPercentage = round(($product->old_price - $product->price) / $product->old_price * 100);
                    ?>
                    <b class="price_percent_product">-{{ $discountPercentage }}%</b>
                    @endif
                    <div>
                        <strong>{{ number_format($product->price, 0, ',', '.') }}₫</strong>
                    </div>
                </div>
                <div class="rom_ram">
                    <h3><b>RAM:</b> {{$product->ram}} &nbsp<b>ROM:</b> {{$product->rom}}</h3>
                </div>
                <label class="tragop">
                    Trả góp 0%
                </label>
                <!-- <label class="moiramat">
                    Mới ra mắt
                </label> -->
                <!-- <div class="tooltip">
                    <form action="{{url('add_cart',$product->id)}}" method="post" id="add-to-cart-form">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" style="width: 100px;" hidden>

                        <input class="themvaogio" type="submit" value="+" @if(Auth::id()) data-product-name="{{$product->name}}" @else onclick="submitForm()" @endif>
                        <span class="tooltiptext" style="font-size: 15px;">Thêm vào giỏ</span>

                    </form>
                </div> -->
            </a>
        </li>
        @endforeach
    </div>
    <a class="xemTatCa" href="{{url('san-pham-gia-re')}}" style="	border-left: 2px solid #5de272;
					border-right: 2px solid #5de272;">
        Xem tất cả {{$count_cheaprice}} sản phẩm
    </a>
</div>