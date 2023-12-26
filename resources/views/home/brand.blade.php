<div class="companyMenu group flexContain">
        @foreach($brand as $brands)
        <a href="{{url('dien-thoai',$brands->slug)}}"><img src="{{ asset('brand_img/' . $brands->image) }}"></a>
        @endforeach
        <!-- <a href="index.html?company=Apple"><img src="home/img/company/Apple.jpg"></a> -->
</div>