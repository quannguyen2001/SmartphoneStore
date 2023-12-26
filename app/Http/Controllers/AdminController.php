<?php

namespace App\Http\Controllers;

use App\Models\Brand;

use App\Models\Banner;

use App\Models\User;

use App\Models\Product;

use App\Models\Color;

use App\Models\Order;

use App\Models\Branch;

use App\Models\Stock;

use App\Models\OldProduct;

use App\Models\OrderOldProduct;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;

use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    //Product_Bestseller
    public function view_product_bestseller()
    {
        if(Auth::id()==1)
        {
            $totals = order::select('product_id', order::with('product')->raw('SUM(quantity) as total_sold'))
            ->where('payment_status', 1)
            ->orWhere('payment_status', 2)
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->get();

            return view('admin.product_bestseller',compact('totals'));
        }
        else
        {
            return redirect('login');
        }
    }

    //Product_Revenue
    public function view_product_revenue()
    {
        if(Auth::id()==1)
        {
            $total_revenue = order::select('product_id', order::with('product')->raw('SUM(total) as total_revenue'))
            ->where('payment_status', 1)
            ->orWhere('payment_status', 2)
            ->groupBy('product_id')
            ->orderBy('total_revenue', 'desc')
            ->get();

            return view('admin.product_revenue',compact('total_revenue'));
        }
        else
        {
            return redirect('login');
        }
    }

    //Product_Revenue
    public function view_brand_bestseller()
    {
        if(Auth::id()==1)
        {
            $total_brand_sale = order::selectRaw('brands.title as brand_title, brands.image as brand_image, SUM(orders.quantity) as product_count, SUM(orders.price * orders.quantity) as product_price')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('orders.payment_status', 1)
            ->orWhere('orders.payment_status', 2)
            ->groupBy('brands.title', 'brands.image') // Thêm 'brands.image' vào danh sách nhóm
            ->orderBy('product_count', 'desc')
            ->with('product')
            ->get();

            return view('admin.brand_bestseller',compact('total_brand_sale'));
        }
        else
        {
            return redirect('login');
        }
    }

    //Account
    public function view_account()
    {
        if(Auth::id()==1)
        {
            $user = user::all();

            return view('admin.account',compact('user'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function search_account(Request $request)
    {
        if(Auth::id()==1)
        {
            $searchText = $request->search;

            $user = user::where('name','LIKE',"%$searchText%")
            ->orWhere('email','LIKE',"%$searchText%")
            ->orWhere('phone','LIKE',"%$searchText%")
            ->orWhere('address','LIKE',"%$searchText%")
            ->paginate(10);
    
            return view('admin.account',compact('user'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function delete_account($id)
    {
        $data = user::find($id);

        $data->delete();

        return redirect()->back();
    }

    //Brand
    public function view_brand()
    {
        if(Auth::id()==1)
        {
            $brand = brand::all();

            return view('admin.brand',compact('brand'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function search_brand(Request $request)
    {
        if(Auth::id()==1)
        {
            $searchText = $request->search;

            $brand = brand::where('title','LIKE',"%$searchText%")
            ->paginate(10);

            return view('admin.brand',compact('brand'));
        }
        else
        {
            return redirect('login');
        } 
    }

    public function view_add_brand()
    {
        if(Auth::id()==1)
        {
            return view('admin.add_brand');
        }
        else
        {
            return redirect('login');
        }    
    }

    public function makeSlugBrand($string) {
        $slug = str_replace(' ', '-', $string); // Thay khoảng trắng bằng dấu gạch ngang
        $slug = preg_replace('/[^\pL\pN-]/u', '', $slug); // Loại bỏ ký tự không hợp lệ
        $slug = strtolower($slug); // Chuyển sang chữ thường
        $slug = preg_replace('/-{2,}/', '-', $slug); // Loại bỏ nhiều dấu gạch ngang liên tiếp
        return $slug;
    }

    public function add_brand(Request $request)
    {
        $brand = new brand;

        $brand->title = $request->title;

        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('brand_img',$imagename);

        $brand->image = $imagename;

        $brand->slug = $this->makeSlugBrand($request->title);

        $brand->save();

        return redirect()->back();
    }

    public function delete_brand($id)
    {
        $brand = brand::find($id);

        // Lấy đường dẫn đầy đủ của tệp tin hình ảnh
        $imagePath = public_path('brand_img/' . $brand->image);
    
        // Kiểm tra xem tệp tin tồn tại trước khi xóa
        if (file_exists($imagePath)) {
            // Xóa tệp tin hình ảnh
            unlink($imagePath);
        }
    
        // Xóa bản ghi thương hiệu
        $brand->delete();
    
        return redirect()->back();
    }

    public function view_update_brand($id)
    {
        if(Auth::id())
        {
            $brand = brand::find($id);

            return view('admin.update_brand',compact('brand'));
        }
        else
        {
            return redirect('login');
        } 
    }

    public function update_brand_confirm(Request $request,$id)
    {
        if(Auth::id()==1)
        {
            $brand = brand::find($id);

            $brand->title = $request->title;

            $image = $request->image;

            if($image)
            {
                $imagename = time().'.'.$image->getClientOriginalExtension();

                $request->image->move('brand_img',$imagename);

                $brand->image = $imagename;
            }

            $brand->slug = $brand->makeSlugBrand();

            
            $brand->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    //Banner
    public function view_banner()
    {
        if(Auth::id()==1)
        {
            $banner = banner::all();

            return view('admin.banner',compact('banner'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function view_add_banner()
    {
        if(Auth::id()==1)
        {
            return view('admin.add_banner');
        }
        else
        {
            return redirect('login');
        }
    }

    public function add_banner(Request $request)
    {
        $banner = new banner;

        $banner->title = $request->title;

        $banner->description = $request->description;

        $banner->link = $request->link;

        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('banner_img',$imagename);

        $banner->image = $imagename;

        $banner->save();

        return redirect()->back();
    }

    public function delete_banner($id)
    {
        $banner = banner::find($id);

        $imagePath = public_path('banner_img/' . $banner->image);
    
        // Kiểm tra xem tệp tin tồn tại trước khi xóa
        if (file_exists($imagePath)) {
            // Xóa tệp tin hình ảnh
            unlink($imagePath);
        }

        $banner->delete();

        return redirect()->back();
    }

    public function view_update_banner($id)
    {
        if(Auth::id()==1)
        {
            $banner = banner::find($id);

            return view('admin.update_banner',compact('banner'));
        }
        else
        {
            return redirect('login');
        } 
    }

    public function update_banner_confirm(Request $request,$id)
    {
        if(Auth::id()==1)
        {
            $banner = banner::find($id);

            $banner->title = $request->title;

            $banner->description = $request->description;

            $banner->link = $request->link;

            $image = $request->image;

            if($image)
            {
                $imagename = time().'.'.$image->getClientOriginalExtension();

                $request->image->move('banner_img',$imagename);

                $banner->image = $imagename;
            }

            
            $banner->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    //Product
    public function view_product()
    {
        if (Auth::id() == 1) {
            $perPage = 10; // Số sản phẩm trên mỗi trang
            $currentPage = request()->query('page', 1); // Lấy số trang hiện tại từ request
    
            $products = product::with('brand')
                ->orderBy('id', 'DESC')
                ->paginate($perPage);
    
            // Tính toán giá trị key bắt đầu
            $startKey = ($currentPage - 1) * $perPage + 1;
    
            return view('admin.product', compact('products', 'startKey'));
        } else {
            return redirect('login');
        }
    }

    public function search_product(Request $request)
    {
        if (Auth::id() == 1) {
            $searchText = $request->search;

            $perPage = 10; // Số sản phẩm trên mỗi trang
            $currentPage = request()->query('page', 1); // Lấy số trang hiện tại từ request

            $products = product::with('brand')->where('name','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")
            ->orWhere('year','LIKE',"%$searchText%")
            ->orWhere('camera_sau','LIKE',"%$searchText%")
            ->orWhere('camera_truoc','LIKE',"%$searchText%")
            ->orWhere('chip','LIKE',"%$searchText%")
            ->orWhere('ram','LIKE',"%$searchText%")
            ->orWhere('rom','LIKE',"%$searchText%")
            ->orWhere('pin','LIKE',"%$searchText%")
            ->paginate(10);
            // Tính toán giá trị key bắt đầu
            $startKey = ($currentPage - 1) * $perPage + 1;

            return view('admin.search_product',compact('products', 'startKey' ,'searchText'));
        } else {
            return redirect('login');
        }
        
    }

    public function view_add_product()
    {
        if(Auth::id()==1)
        {
            $brand = brand::all();

            return view('admin.add_product',compact('brand'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function makeSlug($string) {
        $slug = str_replace(' ', '-', $string); // Thay khoảng trắng bằng dấu gạch ngang
        $slug = preg_replace('/[^\pL\pN-]/u', '', $slug); // Loại bỏ ký tự không hợp lệ
        $slug = strtolower($slug); // Chuyển sang chữ thường
        $slug = preg_replace('/-{2,}/', '-', $slug); // Loại bỏ nhiều dấu gạch ngang liên tiếp
        return $slug;
    }

    public function add_product(Request $request)
    {
        $product = new product;

        $product->name = $request->name;

        $product->brand_id = $request->brand_id;

        $product->price = $request->price;

        $product->old_price = $request->price;

        $product->year = $request->year;

        $product->screen = $request->screen;
        
        $product->software = $request->software;

        $product->camera_sau = $request->camera_sau;

        $product->camera_truoc = $request->camera_truoc;

        $product->chip = $request->chip;

        $product->port = $request->port;

        $product->ram = $request->ram;

        $product->rom = $request->rom;

        $product->sim = $request->sim;

        $product->pin = $request->pin;

        $product->link = $request->link;

        $product->accessories = $request->accessories;
        
        $product->promotion = $request->promotion;

        $product->type = $request->type;

        $product->description = $request->description;

        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('product_img',$imagename);

        $product->image = $imagename;

        $product->slug = $this->makeSlug($request->name);

        $product->save();

        return redirect()->back();
    }

    public function delete_product($id)
    {
        $product = product::find($id);

        $imagePath = public_path('product_img/' . $product->image);
    
        // Kiểm tra xem tệp tin tồn tại trước khi xóa
        if (file_exists($imagePath)) {
            // Xóa tệp tin hình ảnh
            unlink($imagePath);
        }

        $product->delete();

        return redirect()->back();
    }

    public function view_update_product($id)
    {
        if(Auth::id()==1)
        {
            $product = product::with('brand')->find($id);

            $brand = brand::all();

            return view('admin.update_product',compact('product','brand'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_product_confirm(Request $request,$id)
    {
        if(Auth::id()==1)
        {
            $product = product::find($id);

            $product->name = $request->name;

            $product->brand_id = $request->brand_id;

            $product->price = $request->price;

            $product->old_price = $request->old_price;

            $product->year = $request->year;

            $product->screen = $request->screen;

            $product->software = $request->software;

            $product->camera_sau = $request->camera_sau;

            $product->camera_truoc = $request->camera_truoc;

            $product->chip = $request->chip;

            $product->port = $request->port;

            $product->ram = $request->ram;

            $product->rom = $request->rom;

            $product->sim = $request->sim;

            $product->pin = $request->pin;

            $product->link = $request->link;

            $product->accessories = $request->accessories;

            $product->promotion = $request->promotion;

            $product->type = $request->type;

            $product->description = $request->description;

            $product->slug = $product->makeSlug();

            $image = $request->image;

            if($image)
            {
                $imagename = time().'.'.$image->getClientOriginalExtension();

                $request->image->move('product_img',$imagename);

                $product->image = $imagename;
            }
            
            $product->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function view_product_detail($id)
    {
        if(Auth::id()==1)
        {
            $product = product::with('brand')->find($id);

            $colors = color::where('product_id',$product->id)->get();

            $brand = brand::all();

            return view('admin.product_detail',compact('product','brand','colors'));
        }
        else
        {
            return redirect('login');
        }
    }

    //Old Product
    public function view_old_product()
    {
        if(Auth::id()==1)
        {
            $old_products = oldproduct::with('branch')->with('product')->with('color')->orderBy('id','DESC')->paginate(10);

            $order_old_product = orderoldproduct::with('old_product')->paginate(10);

            return view('admin.old_product',compact('old_products', 'order_old_product'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function search_old_product(Request $request)
    {
        if(Auth::id()==1)
        {
            $order_old_product = orderoldproduct::with('old_product')->paginate(10);
            $searchText = $request->search;

            $old_products = oldproduct::with('product', 'color')
            ->where(function ($query) use ($searchText) {
                $query->whereHas('product', function ($subQuery) use ($searchText) {
                    $subQuery->where('name', 'LIKE', "%$searchText%");
                })
                ->orWhereHas('color', function ($subQuery) use ($searchText) {
                    $subQuery->where('color', 'LIKE', "%$searchText%");
                })
                ->orWhere('imei','LIKE',"%$searchText%")
                ->orWhere('new_price','LIKE',"%$searchText%")
                ->orWhere('time_buy','LIKE',"%$searchText%")
                ->orWhere('time_guarantee','LIKE',"%$searchText%")
                ->orWhere('status_product','LIKE',"%$searchText%")
                ->orWhere('status_sale','LIKE',"%$searchText%");
            })
            ->paginate(10);
    
            return view('admin.search_old_product',compact('old_products','order_old_product', 'searchText'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function view_add_old_product()
    {
        if(Auth::id()==1)
        {
            $branch = branch::orderBy('city','ASC')->orderBy('district','ASC')->orderBy('address','ASC')->get();

            $brand = brand::all();

            $product = product::all();

            $color = color::all();

            return view('admin.add_old_product',compact('branch','brand','product','color'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function add_old_product(Request $request)
    {
        $old_product = new oldproduct;

        $old_product->product_id = $request->product_id;

        $old_product->color_id = $request->color_id;

        $old_product->imei = $request->imei;

        $old_product->new_price = $request->new_price;

        $old_product->time_buy = $request->time_buy;

        $old_product->branch_id = $request->branch_id;

        $old_product->time_guarantee = $request->time_guarantee;

        $old_product->status_product = $request->status_product;

        $old_product->status_sale = $request->status_sale;
        
        // Image 1
        $image1 = $request->file('image1');

        $imagename1 = time() . '_' . uniqid() . '.' . $image1->getClientOriginalExtension();

        $image1->move('old_product_img', $imagename1);

        $old_product->image1 = $imagename1;

        // Image 2
        $image2 = $request->file('image2');

        $imagename2 = time() . '_' . uniqid() . '.' . $image2->getClientOriginalExtension();

        $image2->move('old_product_img', $imagename2);

        $old_product->image2 = $imagename2;

        // Image 3
        $image3 = $request->file('image3');

        $imagename3 = time() . '_' . uniqid() . '.' . $image3->getClientOriginalExtension();

        $image3->move('old_product_img', $imagename3);

        $old_product->image3 = $imagename3;

        $old_product->save();

        return redirect()->back();
    }

    public function delete_old_product($id)
    {
        $old_product = oldproduct::find($id);

        $imagePath1 = public_path('old_product_img/' . $old_product->image1);
    
        // Kiểm tra xem tệp tin tồn tại trước khi xóa
        if (file_exists($imagePath1)) {
            // Xóa tệp tin hình ảnh
            unlink($imagePath1);
        }

        $imagePath2 = public_path('old_product_img/' . $old_product->image2);
    
        // Kiểm tra xem tệp tin tồn tại trước khi xóa
        if (file_exists($imagePath2)) {
            // Xóa tệp tin hình ảnh
            unlink($imagePath2);
        }

        $imagePath3 = public_path('old_product_img/' . $old_product->image3);
    
        // Kiểm tra xem tệp tin tồn tại trước khi xóa
        if (file_exists($imagePath3)) {
            // Xóa tệp tin hình ảnh
            unlink($imagePath3);
        }

        $old_product->delete();

        return redirect()->back();
    }

    public function view_update_old_product($id)
    {
        if(Auth::id()==1)
        {
            $old_product = oldproduct::with('product')->with('color')->with('branch')->find($id);

            $branch = branch::orderBy('city','ASC')->orderBy('district','ASC')->orderBy('address','ASC')->get();

            $brand = brand::all();

            $product = product::all();

            $color = color::all();

            return view('admin.update_old_product',compact('old_product', 'branch','brand','product','color'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_old_product_confirm(Request $request,$id)
    {
        if(Auth::id()==1)
        {
            $old_product = oldproduct::find($id);

            $old_product->product_id = $request->product_id;

            $old_product->color_id = $request->color_id;
    
            $old_product->imei = $request->imei;
    
            $old_product->new_price = $request->new_price;
    
            $old_product->time_buy = $request->time_buy;
    
            $old_product->branch_id = $request->branch_id;
    
            $old_product->time_guarantee = $request->time_guarantee;
    
            $old_product->status_product = $request->status_product;
    
            $old_product->status_sale = $request->status_sale;
            
            $image1 = $request->image1;
            // Image 1
            if($image1){
                $image1 = $request->file('image1');
    
            $imagename1 = time() . '_' . uniqid() . '.' . $image1->getClientOriginalExtension();
    
            $image1->move('old_product_img', $imagename1);
    
            $old_product->image1 = $imagename1;
            }

            $image2 = $request->image2;
            // Image 2
            if($image2){
                $image2 = $request->file('image2');
    
                $imagename2 = time() . '_' . uniqid() . '.' . $image2->getClientOriginalExtension();
        
                $image2->move('old_product_img', $imagename2);
        
                $old_product->image2 = $imagename2;
            }

            $image3 = $request->image3;
            // Image 3
            if($image3){
                $image3 = $request->file('image3');
    
                $imagename3 = time() . '_' . uniqid() . '.' . $image3->getClientOriginalExtension();
        
                $image3->move('old_product_img', $imagename3);
        
                $old_product->image3 = $imagename3;
            }

            $old_product->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_order_old_product_done(Request $request,$id)
    {
        if(Auth::id()==1)
        {
            $order_old_products = orderoldproduct::find($id);

            $order_old_products->status = 1;
                
            $order_old_products->save();

            $old_product_id = $order_old_products->old_product_id;

            $old_product = oldproduct::find($old_product_id);

            $old_product->status_sale = 0;

            $old_product->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function delete_order_old_product($id)
    {
        $data = orderoldproduct::find($id);

        $data->delete();

        return redirect()->back();
    }

    //Image
    public function view_image()
    {
        if(Auth::id()==1)
        {
            $colors = color::with('product')->orderBy('id','DESC')->paginate(10);

            $brand = brand::all();

            return view('admin.image',compact('colors','brand'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function search_image(Request $request)
    {
        $searchText = $request->search;

        $colors = color::with('product') // Sửa tên model là Color (đảm bảo đúng tên model)
            ->whereHas('product', function ($query) use ($searchText) {
                $query->where('name', 'LIKE', "%$searchText%");
            })
            ->orWhere('color', 'LIKE', "%$searchText%")
            ->paginate(10);

        $brand = brand::all();

        return view('admin.search_image', compact('colors', 'brand', 'searchText'));
    }

    public function view_add_image()
    {
        if(Auth::id()==1)
        {
            $brand = brand::all();

            $product = product::all();

            return view('admin.add_image',compact('brand','product'));
        }
        else
        {
            return redirect('login');
        }
    }

    //Lấy danh sách sản phẩm của hãng
    public function getProducts($brand_id)
    {
        $products = product::where('brand_id', $brand_id)->pluck('name', 'id');

        return response()->json($products);
    }

    public function add_image(Request $request)
    {
        $color = new color;

        $color->product_id = $request->product_id;

        $color->color = $request->color;    

        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('product_color_img',$imagename);

        $color->image = $imagename;

        $color->save();

        return redirect()->back();
    }

    public function delete_image($id)
    {
        $color = color::find($id);

        $imagePath = public_path('color_img/' . $color->image);
    
        // Kiểm tra xem tệp tin tồn tại trước khi xóa
        if (file_exists($imagePath)) {
            // Xóa tệp tin hình ảnh
            unlink($imagePath);
        }

        $color->delete();

        return redirect()->back();
    }

    public function view_update_image($id)
    {
        if(Auth::id()==1)
        {
            $color = color::with('product')->find($id);

            $brand = brand::all();

            return view('admin.update_image',compact('color','brand'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_image_confirm(Request $request,$id)
    {
        if(Auth::id()==1)
        {
            $color = color::find($id);

            $color->product_id = $request->product_id;

            $color->color = $request->color;

            $image = $request->image;

            if($image)
            {
                $imagename = time().'.'.$image->getClientOriginalExtension();

                $request->image->move('product_color_img',$imagename);

                $color->image = $imagename;
            }
            
            $color->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    //Order
    public function view_order()
    {
        if (Auth::id()==1) {
            $orders = order::all();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                $deliveryStatusOneCount = $items->filter(function ($item) {
                    return $item->delivery_status == 1;
                })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
    }

    public function view_order_pending()
    {
        if (Auth::id()==1) {
            $orders = order::where('delivery_status', 0)->get();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                $deliveryStatusOneCount = $items->filter(function ($item) {
                    return $item->delivery_status == 1;
                })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
    }

    public function view_order_delivery()
    {
        if (Auth::id()==1) {
            $orders = order::where('delivery_status', 1)->get();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                $deliveryStatusOneCount = $items->filter(function ($item) {
                    return $item->delivery_status == 1;
                })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
    }

    public function view_order_done()
    {
        if (Auth::id()==1) {
            $orders = order::where('delivery_status', 2)->get();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                $deliveryStatusOneCount = $items->filter(function ($item) {
                    return $item->delivery_status == 1;
                })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
    }

    public function view_order_cancel()
    {
        if (Auth::id()==1) {
            $orders = order::where('delivery_status', 3)->get();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                $deliveryStatusOneCount = $items->filter(function ($item) {
                    return $item->delivery_status == 1;
                })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
    }

    public function view_order_not_payment()
    {
        if (Auth::id()==1) {
            $orders = order::where('payment_status', 0)->get();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                $deliveryStatusOneCount = $items->filter(function ($item) {
                    return $item->delivery_status == 1;
                })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
    }

    public function view_order_payment()
    {
        if (Auth::id()==1) {
            $orders = order::where('payment_status', 2)->get();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                $deliveryStatusOneCount = $items->filter(function ($item) {
                    return $item->delivery_status == 1;
                })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
    }

    public function view_order_payment_vnpay()
    {
        if (Auth::id()==1) {
            $orders = order::where('payment_status', 1)->get();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                $deliveryStatusOneCount = $items->filter(function ($item) {
                    return $item->delivery_status == 1;
                })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
    }

    public function search_order(Request $request)
    {
        if (Auth::id()==1) {
            $searchText = $request->search;

            $orders = order::where('order_number','LIKE',"%$searchText%")
            ->orWhere('time','LIKE',"%$searchText%")
            ->paginate(10);

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {
                // $deliveryStatusOneCount = $items->filter(function ($item) {
                //     return $item->delivery_status == 1;
                // })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),
                    'total_amount' => $items->sum('total'),
                    'payment_status' => $items[0]->payment_status,
                    'delivery_status' => $items[0]->delivery_status,
                    'time' => $items[0]->time,
                    // 'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            // Sử dụng paginate để phân trang
            $perPage = 10; // Số mục trên mỗi trang
            $page = request()->get('page', 1); // Lấy trang từ tham số truy vấn (nếu không có, mặc định là trang 1)
            $offset = ($page - 1) * $perPage;

            // Lấy URL của trang hiện tại
            $currentUrl = request()->url();

            $mergedorders = new LengthAwarePaginator(
                $mergedorders->slice($offset, $perPage),
                $mergedorders->count(),
                $perPage,
                $page,
                ['path' => $currentUrl] // Sử dụng URL của trang hiện tại
            );

            return view('admin.order', compact('mergedorders'));
        } else {
            return redirect('login');
        }
        
    }

    public function view_order_detail($key)
    {
        if(Auth::id()==1)
        {
            $order = order::with('product')->where('order_number',$key)->get();

            $orders = order::where('order_number',$key)->first();

            $order_id = $key;

            $user_name = $orders->name;

            $email = $orders->email;

            $address = $orders->address;

            $phone = $orders->phone;

            return view('admin.order_detail', compact('order','order_id','user_name','email','address','phone'));  
        }
        else
        {
            return redirect('login');
        }
    }

    public function exportToPdf($key)
    {
        $order = order::with('product')->where('order_number', $key)->get();

        $orders = order::where('order_number', $key)->first();

        $order_id = $key;

        $user_name = $orders->name;

        $email = $orders->email;

        $address = $orders->address;

        $phone = $orders->phone;

        $time = Carbon::now('Asia/Ho_Chi_Minh');

        $pdf = PDF::loadView('admin.order_detail_pdf', compact('order', 'order_id', 'user_name', 'email', 'address', 'phone', 'time'));
        
        return $pdf->download("Đơn hàng mã số $order_id.pdf");
    }

    public function update_order_delivery(Request $request,$key)
    {
        if(Auth::id()==1)
        {
            $orders = order::where('order_number', $key)->get();

            foreach ($orders as $order) {
                $order->delivery_status = 1;

                $order->save();
            }

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_order_done(Request $request,$key)
    {
        if(Auth::id()==1)
        {
            $orders = order::where('order_number', $key)->get();

            foreach ($orders as $order) {
                $order->delivery_status = 2;

                $order->save();
            }

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_order_cancel(Request $request,$key)
    {
        if(Auth::id()==1)
        {
            $orders = order::where('order_number', $key)->get();

            foreach ($orders as $order) {
                $order->delivery_status = 3;

                $order->save();
            }

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_order_payment(Request $request,$key)
    {
        if(Auth::id()==1)
        {
            $orders = order::where('order_number', $key)->get();

            foreach ($orders as $order) {
                $order->payment_status = 2;
                
                $order->save();
            }

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_order_not_payment(Request $request,$key)
    {
        if(Auth::id()==1)
        {
            $orders = order::where('order_number', $key)->get();

            foreach ($orders as $order) {
                $order->payment_status = 0;
                
                $order->save();
            }

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    //Branch
    public function view_branch()
    {
        if(Auth::id()==1)
        {
            $branches = branch::paginate(10);

            return view('admin.branch',compact('branches'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function search_branch(Request $request)
    {
        if(Auth::id()==1)
        {
            $searchText = $request->search;

            $branches = branch::where('address','LIKE',"%$searchText%")
            ->orWhere('district','LIKE',"%$searchText%")
            ->orWhere('city','LIKE',"%$searchText%")
            ->orWhere('phone','LIKE',"%$searchText%")
            ->paginate(10);

            return view('admin.search_branch',compact('branches', 'searchText'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function makeSlugBranch($string) {
        // Chuyển đổi ký tự có dấu thành không dấu
        $string = $this->removeAccents($string);
    
        // Thay thế khoảng trắng bằng dấu gạch ngang
        $string = str_replace(' ', '-', $string);
    
        // Loại bỏ ký tự không hợp lệ
        $string = preg_replace('/[^a-z0-9-]/', '', $string);
    
        // Loại bỏ nhiều dấu gạch ngang liên tiếp
        $string = preg_replace('/-{2,}/', '-', $string);
    
        return $string;
    }
    
    // Hàm loại bỏ dấu từ ký tự có dấu
    private function removeAccents($string) {
        $accentedChars = [
            'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a',
            'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
            'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
            'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
            'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
            'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
            'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
            'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
            'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
            'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
            'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
            'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
            'đ' => 'd', 'ô' => 'o', 'ơ' => 'o', 'ă' => 'a', 'Ă' => 'A',
            'Á' => 'A', 'À' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A',
            'Ắ' => 'A', 'Ằ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A',
            'Ấ' => 'A', 'Ầ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A',
            'É' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E',
            'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E',
            'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I',
            'Ó' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O',
            'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O',
            'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O',
            'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U',
            'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U',
            'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y',
            'Đ' => 'D', 'ư' => 'u', 'Ư' => 'U', 'ô' => 'o', 'Ô' => 'O',
            'ê' => 'e', 'Ê' => 'E', 'â' => 'a', 'Â' => 'A',
        ];
    
        $string = strtr($string, $accentedChars);
    
        $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
        $string = trim($string);
        $string = str_replace(' ', '-', $string);
        $string = str_replace('--', '-', $string); // Tránh trường hợp có nhiều khoảng trắng
    
        return strtolower($string); // Chuyển thành chữ thường để đảm bảo slug không chứa chữ hoa
    }

    public function add_branch(Request $request)
    {
        $branch = new branch;

        $branch->address = $request->address;

        $branch->district = $request->district;

        $branch->city = $request->city;

        $branch->phone = $request->phone;
        
        $branch->link_map = $request->link_map;

        // Tạo slug từ tổng hợp của address, district và city
        $slug_address = $branch->address . ' ' . $branch->district . ' ' . $branch->city;

        $branch->slug = $this->makeSlugBranch($slug_address);

        $branch->save();

        return redirect()->back();
    }

    public function delete_branch($id)
    {
        $data = branch::find($id);

        $data->delete();

        return redirect()->back();
    }

    public function view_update_branch($id)
    {
        if(Auth::id()==1)
        {
            $branch = branch::find($id);

            return view('admin.update_branch',compact('branch'));
        }
        else
        {
            return redirect('login');
        } 
    }

    public function update_branch_confirm(Request $request,$id)
    {
        if(Auth::id()==1)
        {
            $branch = branch::find($id);

            $branch->address = $request->address;
        
            $branch->district = $request->district;
        
            $branch->city = $request->city;
        
            $branch->phone = $request->phone;

            $branch->link_map = $request->link_map;

            // Tạo slug từ tổng hợp của address, district và city
            $slug_address = $branch->address . ' ' . $branch->district . ' ' . $branch->city;

            $branch->slug = $this->makeSlugBranch($slug_address);
            
            $branch->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    //Stock
    public function view_stock()
    {
        if(Auth::id()==1)
        {
            $stocks = stock::with('branch')->with('product')->with('color')->orderBy('id','ASC')->paginate(10);

            $branch = branch::orderBy('city','ASC')->orderBy('district','ASC')->orderBy('address','ASC')->get();

            $brand = brand::all();

            $product = product::all();

            $color = color::all();

            return view('admin.stock',compact('stocks','branch','brand','product','color'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function search_stock(Request $request)
    {
        if(Auth::id()==1)
        {
            $searchText = $request->search;

            $stocks = stock::with('product', 'branch', 'color')
            ->where(function ($query) use ($searchText) {
                $query->whereHas('product', function ($subQuery) use ($searchText) {
                    $subQuery->where('name', 'LIKE', "%$searchText%");
                })
                ->orWhereHas('branch', function ($subQuery) use ($searchText) {
                    $subQuery->where('address', 'LIKE', "%$searchText%")
                            ->orWhere('district', 'LIKE', "%$searchText%")
                            ->orWhere('city', 'LIKE', "%$searchText%");
                })
                ->orWhereHas('color', function ($subQuery) use ($searchText) {
                    $subQuery->where('color', 'LIKE', "%$searchText%");
                })
                ->orWhere('quantity', 'LIKE', "%$searchText%");
            })
            ->paginate(10);
    
            $branch = branch::orderBy('city','ASC')->orderBy('district','ASC')->orderBy('address','ASC')->get();
    
            $brand = brand::all();
    
            $product = product::all();
    
            $color = color::all();
    
            return view('admin.search_stock',compact('stocks', 'branch', 'brand', 'product', 'color' ,'searchText'));
        }
        else
        {
            return redirect('login');
        }   
    }

    public function add_stock(Request $request)
    {
        $stock = new stock;

        $stock->branch_id = $request->branch_id;

        $stock->product_id = $request->product_id;

        $stock->color_id = $request->color_id;

        $stock->quantity = $request->quantity;

        $stock->save();

        return redirect()->back();
    }

    public function delete_stock($id)
    {
        $data = stock::find($id);

        $data->delete();

        return redirect()->back();
    }

    public function view_update_stock($id)
    {
        if(Auth::id()==1)
        {
            $stock = stock::find($id);

            $branch = branch::all();

            $brand = brand::all();

            return view('admin.update_stock',compact('stock','branch','brand'));
        }
        else
        {
            return redirect('login');
        } 
    }

    public function update_stock_confirm(Request $request,$id)
    {
        if(Auth::id()==1)
        {
            $stock = stock::find($id);

            $stock->branch_id = $request->branch_id;

            $stock->product_id = $request->product_id;
    
            $stock->color_id = $request->color_id;
    
            $stock->quantity = $request->quantity;
            
            $stock->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    //Lấy danh sách màu của sản phẩm
    public function getColors($product_id)
    {
        $colors = color::where('product_id', $product_id)->pluck('color', 'id');

        return response()->json($colors);
    }

}
