<div id="myCarousel" class="carousel">
    <div class="carousel-inner">
        @foreach($banners as $banner)
        <div class="carousel-item">
            <a target="_blank" href="{{$banner->link}}">
                <img src="{{ asset('banner_img/' . $banner->image) }}" alt="Image 1">
            </a>
        </div>
        @endforeach
    </div>

    <div class="carousel-controls">
        <div class="carousel-prev" onclick="prevSlide()">&#10094;</div>
        <div class="carousel-next" onclick="nextSlide()">&#10095;</div>
    </div>
</div>
<div>
    <img src="home/img/banners/blackFriday.gif" alt="" style="width: 100%;">
</div>