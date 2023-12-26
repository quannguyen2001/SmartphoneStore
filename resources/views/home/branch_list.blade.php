@if($branches->isEmpty())
    <p><b>Không cửa hàng nào có sản phẩm!</b></p>
@else
    <div style="border: 1px solid black; text-align: left; padding-left: 5px; color: red;">
        <b><i>Đã tìm thấy {{$count_branch}} cửa hàng</i></b>
    </div>
    @foreach($branches as $branch)
    <div style="border: 1px solid black; text-align: left; ">
        <p style="padding-left: 5px;">
            <b>Cửa hàng {{ $branch->branch->address }}, {{ $branch->branch->district }}, {{ $branch->branch->city }} </b>
        </p>
        <p style="color: blue; padding-left: 5px;">Hiện đang có: <b>{{ $branch->quantity }}</b> sản phẩm - <b style="color: brown;"><a href="{{url('cua-hang/' .$branch->branch->slug)}}" target="_blank">Xem bản đồ</a></b></p>
    </div>
    @endforeach
@endif


