<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

use App\Models\Brand;

use App\Models\Banner;

use App\Models\Product;

use App\Models\Color;

use App\Models\Cart;

use App\Models\Order;

use App\Models\Branch;

use App\Models\Stock;

use App\Models\OldProduct;

use App\Models\OrderOldProduct;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $brand = brand::all();

            $banners = banner::all();

            $keyword = brand::take(5)->get();

            $new_product = product::orderBy('id', 'DESC')->where('type', 1)->take(10)->get();

            $bestseller_product = product::orderBy('id', 'DESC')->where('type', 2)->take(10)->get();

            $cheap_price_product = product::orderBy('id', 'DESC')->where('type', 3)->take(10)->get();

            $count_new_product = product::where('type', 1)->count();

            $count_bestseller = product::where('type', 2)->count();

            $count_cheaprice = product::where('type', 3)->count();

            return view('home.userpage', compact('brand', 'banners', 'count_product_cart', 'new_product', 'bestseller_product', 'cheap_price_product', 'keyword', 'count_new_product', 'count_bestseller', 'count_cheaprice'));
        } else {
            $brand = brand::all();

            $banners = banner::all();

            $keyword = brand::take(5)->get();

            $new_product = product::orderBy('id', 'DESC')->where('type', 1)->take(10)->get();

            $bestseller_product = product::orderBy('id', 'DESC')->where('type', 2)->take(10)->get();

            $cheap_price_product = product::orderBy('id', 'DESC')->where('type', 3)->take(10)->get();

            $count_new_product = product::where('type', 1)->count();

            $count_bestseller = product::where('type', 2)->count();

            $count_cheaprice = product::where('type', 3)->count();

            return view('home.userpage', compact('brand', 'banners', 'new_product', 'bestseller_product', 'cheap_price_product', 'keyword', 'count_new_product', 'count_bestseller', 'count_cheaprice'));
        }
    }

    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
        return redirect('/');
    }

    // Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
        return redirect('/');
    }


    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email)->first();

        if (!$user) {
            $user = new User();

            $user->name = $data->name;

            $user->email = $data->email;

            $user->provider_id = $data->id;

            $user->avatar = $data->avatar;

            $user->save();
        }

        Auth::login($user);
    }



    public function redirect()
    {
        if(Auth::id())
        {
            $usertype = Auth::user()->usertype;

        $user_id = Auth::user()->id;

        if ($usertype == '1') {
            $user = user::all();

            $product = product::all();

            $user = user::all();

            $order = order::all();

            $count_user = $user->count();

            $count_product = $product->count();

            $count_user = $user->count();

            $sum_order_payment = order::where('payment_status', 1)->orWhere('payment_status', 2)->get();

            $sum_order_total = $sum_order_payment->sum('total');

            $count_order = order::distinct('order_number')->count('order_number');

            //Câu truy vấn SQL để tính tổng số lượng sản phẩm đã được bán theo product_id
            $totals = order::select('product_id', order::with('product')->raw('SUM(quantity) as total_sold'))
                ->where('payment_status', 1)
                ->orWhere('payment_status', 2)
                ->groupBy('product_id')
                ->orderBy('total_sold', 'desc')
                ->take(5)
                ->get();

            //Câu truy vấn SQL để tính tổng doanh thu của sản phẩm đã đạt được theo product_id
            $total_revenue = order::select('product_id', order::with('product')->raw('SUM(total) as total_revenue'))
                ->where('payment_status', 1)
                ->orWhere('payment_status', 2)
                ->groupBy('product_id')
                ->orderBy('total_revenue', 'desc')
                ->take(5)
                ->get();

            //Câu truy vấn SQL để tính hãng sản phẩm bán chạy nhất
            $total_brand_sale = order::selectRaw('brands.title as brand_title, brands.image as brand_image, SUM(orders.quantity) as product_count')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('orders.payment_status', 1)
            ->orWhere('orders.payment_status', 2)
            ->groupBy('brands.title', 'brands.image') // Thêm 'brands.image' vào danh sách nhóm
            ->orderBy('product_count', 'desc')
            ->with('product')
            ->take(5)
            ->get();

            // Thống kê doanh thu theo tháng
            $monthlyRevenue = order::selectRaw('YEAR(time) as year, MONTH(time) as month, SUM(total) as monthly_revenue')
            ->where('payment_status', 1)
            ->orWhere('payment_status', 2)
            ->groupByRaw('YEAR(time), MONTH(time)')
            ->orderByRaw('YEAR(time) asc, MONTH(time) asc')
            ->get();


            // Thống kê doanh thu trong tuần
            $weeklyRevenue = Order::selectRaw('DATE_FORMAT(time, "%d-%m-%Y") as date, SUM(total) as daily_revenue')
            ->where('payment_status', 1)
            ->orWhere('payment_status', 2)
            ->whereBetween('time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupByRaw('DATE_FORMAT(time, "%d-%m-%Y")')
            ->orderByRaw('DATE_FORMAT(time, "%d-%m-%Y") asc')
            ->get();

            //Thống kê sản phẩm đã bán theo từng hãng
            $brandSales = order::selectRaw('brands.title as brand_title, SUM(orders.quantity) as product_count')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('orders.payment_status', 1)
            ->orWhere('orders.payment_status', 2)
            ->groupBy('brands.title')
            ->orderBy('product_count', 'desc')
            ->with('product')
            ->get();

            // Thống kê đơn hàng theo trạng thái thanh toán
            $orderStatus = Order::selectRaw('payment_status, COUNT(DISTINCT order_number) as order_count')
            ->groupBy('payment_status')
            ->get();

            // Tạo mảng dữ liệu cho biểu đồ
            $productSoldData = [];
            $productRevenueData = [];

            foreach ($totals as $item) {
                $productSoldData[] = [
                    'product_name' => $item->product->name,
                    'total_sold' => $item->total_sold,
                ];
            }

            foreach ($total_revenue as $item) {
                $productRevenueData[] = [
                    'product_name' => $item->product->name,
                    'total_revenue' => $item->total_revenue,
                ];
            }

            $monthlyRevenueData = [];

            foreach ($monthlyRevenue as $item) {
                $monthlyRevenueData[] = [
                    'month' => str_pad($item->month, 2, '0', STR_PAD_LEFT) . '-' . $item->year,
                    'revenue' => $item->monthly_revenue,
                ];
            }

            $weeklyRevenueData = [];

            foreach ($weeklyRevenue as $item) {
                $weeklyRevenueData[] = [
                    'date' => $item->date,
                    'revenue' => $item->daily_revenue,
                ];
            }    
            
            $brandSalesData = [];

            foreach ($brandSales as $item) {
                $brandSalesData[] = [
                    'brand_title' => $item->brand_title,
                    'product_count' => $item->product_count,
                ];
            }

            // Chuyển đổi mảng dữ liệu thành chuỗi JSON để truyền cho biểu đồ
            $productSoldDataJson = json_encode($productSoldData);
            $productRevenueDataJson = json_encode($productRevenueData);
            $monthlyRevenueDataJson = json_encode($monthlyRevenueData);
            $weeklyRevenueDataJson = json_encode($weeklyRevenueData);
            $brandSalesDataJson = json_encode($brandSalesData);

            return view('admin.home', compact('count_user', 'count_product', 'sum_order_total', 'count_order', 'totals', 'total_revenue', 'total_brand_sale', 'productSoldDataJson', 'productRevenueDataJson', 'monthlyRevenueDataJson', 'weeklyRevenueDataJson', 'brandSalesDataJson', 'orderStatus'));
        } else {
            $brand = brand::all();

            $banners = banner::all();

            $keyword = brand::take(5)->get();

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $new_product = product::orderBy('id', 'DESC')->where('type', 1)->take(10)->get();

            $bestseller_product = product::orderBy('id', 'DESC')->where('type', 2)->take(10)->get();

            $cheap_price_product = product::orderBy('id', 'DESC')->where('type', 3)->take(10)->get();

            $count_new_product = product::where('type', 1)->count();

            $count_bestseller = product::where('type', 2)->count();

            $count_cheaprice = product::where('type', 3)->count();

            return view('home.userpage', compact('brand', 'banners', 'count_product_cart', 'new_product', 'bestseller_product', 'cheap_price_product', 'keyword', 'count_new_product', 'count_bestseller', 'count_cheaprice'));
        }
        }
        else
        {
            return redirect('login');
        }
    }

    public function searchdata(Request $request)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $brands = brand::all();

            $keyword = brand::take(5)->get();

            $searchText = $request->query('search');

            $products = product::where('name', 'LIKE', "%$searchText%")
                ->orWhere('ram', 'LIKE', "%$searchText%")
                ->orWhere('rom', 'LIKE', "%$searchText%")
                ->orWhere('year', 'LIKE', "%$searchText%")
                ->orWhere('port', 'LIKE', "%$searchText%")
                ->orWhere('price', 'LIKE', "%$searchText%")
                ->orWhere('camera_truoc', 'LIKE', "%$searchText%")
                ->orWhere('camera_sau', 'LIKE', "%$searchText%")
                ->orWhere('screen', 'LIKE', "%$searchText%")
                ->orWhere('chip', 'LIKE', "%$searchText%")
                ->orWhere('sim', 'LIKE', "%$searchText%")
                ->orWhere('pin', 'LIKE', "%$searchText%")
                ->orWhere('type', 'LIKE', "%$searchText%")
                ->orWhere('software', 'LIKE', "%$searchText%")
                ->paginate(10); // Adjust the number of items per page as per your requirement

            $product = product::where('name', 'LIKE', "%$searchText%")
                ->orWhere('ram', 'LIKE', "%$searchText%")
                ->orWhere('rom', 'LIKE', "%$searchText%")
                ->orWhere('year', 'LIKE', "%$searchText%")
                ->orWhere('port', 'LIKE', "%$searchText%")
                ->orWhere('price', 'LIKE', "%$searchText%")
                ->orWhere('camera_truoc', 'LIKE', "%$searchText%")
                ->orWhere('camera_sau', 'LIKE', "%$searchText%")
                ->orWhere('screen', 'LIKE', "%$searchText%")
                ->orWhere('chip', 'LIKE', "%$searchText%")
                ->orWhere('sim', 'LIKE', "%$searchText%")
                ->orWhere('pin', 'LIKE', "%$searchText%")
                ->orWhere('type', 'LIKE', "%$searchText%")
                ->orWhere('software', 'LIKE', "%$searchText%")
                ->get();

            $count_result = $product->count();

            return view('home.search', compact('brands', 'products', 'keyword', 'searchText', 'count_result', 'count_product_cart'));
        } else {
            $brands = brand::all();

            $keyword = brand::take(5)->get();

            $searchText = $request->query('search');

            $products = product::where('name', 'LIKE', "%$searchText%")
                ->orWhere('ram', 'LIKE', "%$searchText%")
                ->orWhere('rom', 'LIKE', "%$searchText%")
                ->orWhere('year', 'LIKE', "%$searchText%")
                ->orWhere('port', 'LIKE', "%$searchText%")
                ->orWhere('price', 'LIKE', "%$searchText%")
                ->orWhere('camera_truoc', 'LIKE', "%$searchText%")
                ->orWhere('camera_sau', 'LIKE', "%$searchText%")
                ->orWhere('screen', 'LIKE', "%$searchText%")
                ->orWhere('chip', 'LIKE', "%$searchText%")
                ->orWhere('sim', 'LIKE', "%$searchText%")
                ->orWhere('pin', 'LIKE', "%$searchText%")
                ->orWhere('type', 'LIKE', "%$searchText%")
                ->orWhere('software', 'LIKE', "%$searchText%")
                ->paginate(10); // Adjust the number of items per page as per your requirement

            $product = product::where('name', 'LIKE', "%$searchText%")
                ->orWhere('ram', 'LIKE', "%$searchText%")
                ->orWhere('rom', 'LIKE', "%$searchText%")
                ->orWhere('year', 'LIKE', "%$searchText%")
                ->orWhere('port', 'LIKE', "%$searchText%")
                ->orWhere('price', 'LIKE', "%$searchText%")
                ->orWhere('camera_truoc', 'LIKE', "%$searchText%")
                ->orWhere('camera_sau', 'LIKE', "%$searchText%")
                ->orWhere('screen', 'LIKE', "%$searchText%")
                ->orWhere('chip', 'LIKE', "%$searchText%")
                ->orWhere('sim', 'LIKE', "%$searchText%")
                ->orWhere('pin', 'LIKE', "%$searchText%")
                ->orWhere('type', 'LIKE', "%$searchText%")
                ->orWhere('software', 'LIKE', "%$searchText%")
                ->get();

            $count_result = $product->count();

            return view('home.search', compact('brands', 'products', 'keyword', 'searchText', 'count_result'));
        }
    }

    public function view_brand_detail($slug)
    {
        $pageSize = 10; // Số sản phẩm trên mỗi trang

        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');
        } else {
            $count_product_cart = 0;
        }

        $brand = brand::where('slug', $slug)->first();

        $brands = brand::all();

        $keyword = brand::take(5)->get();

        $products = product::where('brand_id', $brand->id)->paginate($pageSize);

        return view('home.brand_detail', compact('brand', 'brands', 'products', 'keyword', 'count_product_cart'));
    }

    public function view_detail($slug)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $brand = brand::all();

            $product = product::where('slug', $slug)->first();

            $old_product = oldproduct::where('product_id', $product->id)->first();

            $old_product_price_min = oldproduct::where('product_id', $product->id)->min('new_price');

            $colors = color::where('product_id', $product->id)->get();

            $keyword = brand::take(5)->get();

            $product_suggestion = product::inRandomOrder()->take(10)->get();

            //Xuat danh sach cua hang có san pham
            $district = request('district');

            $color_id = request('color_id');

            return view('home.detail', compact('brand', 'product', 'old_product', 'old_product_price_min', 'colors', 'product_suggestion', 'keyword', 'count_product_cart'));
        } else {
            $brand = brand::all();

            $product = product::where('slug', $slug)->first();

            $old_product = oldproduct::where('product_id', $product->id)->first();

            $old_product_price_min = oldproduct::where('product_id', $product->id)->min('new_price');

            $colors = color::where('product_id', $product->id)->get();

            $keyword = brand::take(5)->get();

            $product_suggestion = product::inRandomOrder()->take(10)->get();

            return view('home.detail', compact('brand', 'product', 'old_product', 'old_product_price_min', 'colors', 'product_suggestion', 'keyword'));
        }
    }

    //Branch
    public function getBranches(Request $request)
    {
        $product_id = $request->input('product_id');
        $color_id = $request->input('color_id');
        $district = $request->input('district');

        $branchesQuery = stock::where('product_id', $product_id)
                            ->where('color_id', $color_id);

        if ($district) {
            $branchesQuery->whereHas('branch', function ($query) use ($district) {
                $query->where('district', '=', $district);
            });
        }

        $branches = $branchesQuery->with(['branch' => function ($query) {
                $query->select('id', 'address', 'district', 'city', 'phone', 'slug');
        }])->get();

        $count_branch = $branches->count();

        // Trả về view hoặc JSON response tùy thuộc vào yêu cầu của bạn
        return view('home.branch_list', compact('branches','count_branch'));
    }

    public function view_branch_location($slug)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $brand = brand::all();

            $branch = branch::where('slug', $slug)->first();

            $keyword = brand::take(5)->get();

            return view('home.branch_location', compact('brand','count_product_cart', 'keyword', 'branch'));
        } else {
            $brand = brand::all();

            $branch = branch::where('slug', $slug)->first();

            $keyword = brand::take(5)->get();

            //Xuat danh sach cua hang có san pham

            $district = request('district');

            $color_id = request('color_id');

            return view('home.branch_location', compact('brand', 'keyword', 'branch'));
        }
    }

    public function view_all_branches()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $branch = branch::all();

            $brand = brand::all();

            $keyword = brand::take(5)->get();

            return view('home.all_branches', compact('branch', 'brand', 'keyword', 'count_product_cart'));
        } else {
            $branch = branch::all();

            $brand = brand::all();

            $keyword = brand::take(5)->get();

            return view('home.all_branches', compact('branch', 'brand', 'keyword'));
        }
    }

    //OldProduct
    public function view_old_product_list($slug)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $brands = brand::all();

            $product = product::where('slug', $slug)->first();

            $old_product = oldproduct::with('product')->with('color')->with('branch')->where('product_id', $product->id)->get();

            $name_old_product = oldproduct::with('product')->where('product_id', $product->id)->first();

            $keyword = brand::take(5)->get();

            return view('home.old_product', compact('brands', 'old_product', 'keyword', 'count_product_cart','name_old_product'));
        } else {
            $brands = brand::all();

            $product = product::where('slug', $slug)->first();

            $old_product = oldproduct::with('product')->with('color')->with('branch')->where('product_id', $product->id)->get();

            $name_old_product = oldproduct::with('product')->where('product_id', $product->id)->first();

            $keyword = brand::take(5)->get();

            return view('home.old_product', compact('brands', 'old_product', 'keyword','name_old_product'));
        }
    }

    public function view_old_product_detail($slug, $id)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $user_name = Auth::user()->name;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $brand = brand::all();

            $old_product = oldproduct::with('product')->with('color')->with('branch')->find($id);

            $order = orderoldproduct::where('old_product_id',$old_product->id)->get();

            $keyword = brand::take(5)->get();

            $user_name = Auth::user()->name;

            $user_phone = Auth::user()->phone;

            $product_suggestion = product::inRandomOrder()->take(10)->get();

            $existingOrderOldProduct = orderoldproduct::where('old_product_id', '=', $old_product->id)->where('user_name', '=', $user_name)->first();

            return view('home.old_product_detail', compact('brand', 'old_product', 'user_name', 'user_phone', 'product_suggestion', 'keyword', 'count_product_cart', 'existingOrderOldProduct', 'order'));
        } else {
            $brand = brand::all();

            $old_product = oldproduct::with('product')->with('color')->with('branch')->find($id);

            $order = orderoldproduct::where('old_product_id',$old_product->id)->get();

            $keyword = brand::take(5)->get();

            $product_suggestion = product::inRandomOrder()->take(10)->get();

            $existingOrderOldProduct = null;

            return view('home.old_product_detail', compact('brand', 'old_product', 'product_suggestion', 'keyword', 'existingOrderOldProduct', 'order'));
        }
    }

    public function view_all_old_product()
    {
        $pageSize = 10;

        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $old_products = oldproduct::orderBy('id', 'DESC')->paginate($pageSize);

            return view('home.all_old_product', compact('keyword', 'count_product_cart', 'old_products', 'brands'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $old_products = oldproduct::orderBy('id', 'DESC')->paginate($pageSize);

            return view('home.all_old_product', compact('keyword', 'old_products', 'brands'));
        }
    }

    public function order_old_product(Request $request, $id)
    {
        if (Auth::id()) {            
            $old_product = oldproduct::find($id);

            $order_old_product = new orderoldproduct;

            $order_old_product->user_name = $request->user_name;

            $order_old_product->phone = $request->phone;

            $order_old_product->price = $old_product->new_price;

            $order_old_product->time_order = Carbon::now('Asia/Ho_Chi_Minh');

            $order_old_product->old_product_id = $old_product->id;

            $order_old_product->status = 0;

            $order_old_product->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    

    public function view_news()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $banner = banner::all();

            $keyword = brand::take(5)->get();

            return view('home.news', compact('banner', 'keyword', 'count_product_cart'));
        } else {
            $banner = banner::all();

            $keyword = brand::take(5)->get();

            return view('home.news', compact('banner', 'keyword'));
        }
    }

    public function view_recruitment()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            return view('home.recruitment', compact('keyword', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            return view('home.recruitment', compact('keyword'));
        }
    }

    public function view_introduce()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            return view('home.introduce', compact('keyword', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            return view('home.introduce', compact('keyword'));
        }
    }

    public function view_guarantee()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            return view('home.guarantee', compact('keyword', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            return view('home.guarantee', compact('keyword'));
        }
    }

    public function view_contact()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            return view('home.contact', compact('keyword', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            return view('home.contact', compact('keyword'));
        }
    }

    //Account
    public function view_account()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $user = user::find($user_id);

            $keyword = brand::take(5)->get();

            return view('home.account_info', compact('keyword', 'count_product_cart', 'user'));
        } else {

            return redirect('login');
        }
    }

    public function view_update_account()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $user = user::find($user_id);

            $keyword = brand::take(5)->get();

            return view('home.account_update', compact('keyword', 'count_product_cart', 'user'));
        } else {

            return redirect('login');
        }
    }

    public function update_account_info(Request $request, $id)
    {
        if (Auth::id()) {
            $user = user::find($id);

            $user->name = $request->name;

            $user->email = $request->email;

            $user->address = $request->address;

            $user->phone = $request->phone;

            $user->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function view_update_pass_account()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $user = user::find($user_id);

            $keyword = brand::take(5)->get();

            return view('home.account_change_pass', compact('keyword', 'count_product_cart', 'user'));
        } else {

            return redirect('login');
        }
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
        ]);

        $user = User::find($id);

        // if (!$user) {
        //     return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        // }

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Mật khẩu đã được cập nhật thành công.');
        } else {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại không đúng, hãy nhập lại');
        }
    }

    public function view_account_order()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $user = user::find($user_id);

            $keyword = brand::take(5)->get();

            $orders = order::where('user_id', '=', $user_id)->get();

            //Tong so don hang
            $sum_order = $orders->groupBy('order_number');

            $count_sum_order = $sum_order->count();



            //Don hang da giao
            $order_delivered = $orders->groupBy('order_number')->filter(function ($items) {
                return $items->every(function ($item) {
                    return $item->delivery_status == 2;
                });
            });

            $count_order_delivered = $order_delivered->count();

            //Don hang dang van chuyen
            $order_transporting = $orders->groupBy('order_number')->filter(function ($items) {
                return $items->every(function ($item) {
                    return $item->delivery_status == 1;
                });
            });

            $count_order_transporting = $order_transporting->count();

            //Don hang da bi huy
            $order_cancel = $orders->groupBy('order_number')->filter(function ($items) {
                return $items->every(function ($item) {
                    return $item->delivery_status == 3;
                });
            });

            $count_order_cancel = $order_cancel->count();

            return view('home.account_order', compact('keyword', 'count_product_cart', 'user', 'count_order_delivered', 'count_order_transporting', 'count_sum_order', 'count_order_cancel'));
        } else {

            return redirect('login');
        }
    }


    //View All Product
    public function view_all_products()
    {
        $pageSize = 10; // Số sản phẩm trên mỗi trang

        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $products = product::paginate($pageSize);

            $brands = brand::all();

            $keyword = brand::take(5)->get();

            return view('home.all_product', compact('products', 'brands', 'keyword', 'count_product_cart'));
        } else {
            $products = product::paginate($pageSize);

            $brands = brand::all();

            $keyword = brand::take(5)->get();

            return view('home.all_product', compact('products', 'brands', 'keyword'));
        }
    }

    //New Product
    public function view_new_product()
    {
        $pageSize = 10;

        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('id', 'DESC')->where('type', 1)->paginate($pageSize);

            return view('home.new_product_detail', compact('keyword', 'count_product_cart', 'products', 'brands'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('id', 'DESC')->where('type', 1)->paginate($pageSize);

            return view('home.new_product_detail', compact('keyword', 'products', 'brands'));
        }
    }

    //Best Seller
    public function view_bestseller()
    {
        $pageSize = 10;

        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('id', 'DESC')->where('type', 2)->paginate($pageSize);

            return view('home.bestseller_detail', compact('keyword', 'count_product_cart', 'products', 'brands'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('id', 'DESC')->where('type', 2)->paginate($pageSize);

            return view('home.bestseller_detail', compact('keyword', 'products', 'brands'));
        }
    }

    //Cheap Price
    public function view_cheap_price()
    {
        $pageSize = 10;

        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('id', 'DESC')->where('type', 3)->paginate($pageSize);

            return view('home.cheap_price_detail', compact('keyword', 'count_product_cart', 'products', 'brands'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('id', 'DESC')->where('type', 3)->paginate($pageSize);

            return view('home.cheap_price_detail', compact('keyword', 'products', 'brands'));
        }
    }
    

    //Cart
    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();

            $userid = $user->id;

            $product = product::find($id);

            // $product_exist_id = cart::where('product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();

            $existingCart = cart::where('product_id', '=', $id)
                ->where('user_id', '=', $userid)
                ->where('color', '=', $request->color)
                ->first();

            if ($existingCart) {
                // Nếu tồn tại giỏ hàng với cùng product_id và color, cộng thêm quantity
                $existingCart->quantity += $request->quantity;

                $existingCart->save();

                return redirect()->back();
            } else {
                $cart = new cart;

                $cart->name = $user->name;

                $cart->email = $user->email;

                $cart->phone = $user->phone;

                $cart->address = $user->address;

                $cart->user_id = $user->id;

                $cart->time = Carbon::now('Asia/Ho_Chi_Minh');

                $cart->product_id = $product->id;

                $cart->color = $request->color;

                $cart->quantity = $request->quantity;

                // sleep(2); // Tạm dừng 2 giây

                $cart->save();

                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function view_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;

            $user = user::find($id);

            $cart = cart::with('color')->with('product')->where('user_id', '=', $id)->get();

            $count_product_cart = $cart->sum('quantity');

            $cart_user_info = cart::where('user_id', '=', $id)->first();

            // $color = color::where('product_id',$cart->color->product_id)->get();

            $keyword = brand::take(5)->get();

            $brand = brand::all();

            if ($cart->count() > 0) {
                $user_id = $cart_user_info->user_id;

                $user_name = $cart_user_info->name;

                $user_email = $cart_user_info->email;

                $user_phone = $cart_user_info->phone;

                $user_address = $cart_user_info->address;

                return view('home.cart', compact('cart', 'user', 'keyword', 'brand', 'count_product_cart', 'user_id', 'user_name', 'user_email', 'user_phone', 'user_address'));
            }


            return view('home.cart', compact('cart', 'user', 'keyword', 'brand', 'count_product_cart'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart = cart::find($id);

        $cart->delete();

        return redirect()->back();
    }

    public function increase_product_cart($id)
    {
        $cart = cart::with('product')->find($id);

        $quantity = $cart->quantity;

        $cart->quantity = $quantity + 1;

        $cart->time = Carbon::now('Asia/Ho_Chi_Minh');

        $cart->save();

        return redirect()->back();
    }

    public function decrease_product_cart($id)
    {
        $cart = cart::with('product')->find($id);

        $quantity = $cart->quantity;

        $cart->quantity = $quantity - 1;

        $cart->time = Carbon::now('Asia/Ho_Chi_Minh');

        $cart->save();

        return redirect()->back();
    }

    public function update_user_info(Request $request, $id)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function cash_order()
    {
        $user = Auth::user();

        $userid = $user->id;

        $id = time();

        $data = cart::with('product')->where('user_id', '=', $userid)->get();

        $totalOrderAmount = 0;

        foreach ($data as $data) {
            $order = new order;

            $order->order_number = $id;

            $order->name = $data->name;

            $order->email = $data->email;

            $order->phone = $data->phone;

            $order->address = $data->address;

            $order->user_id = $data->user_id;

            $order->price = $data->product->price;

            $order->quantity = $data->quantity;

            $total = $data->product->price * $data->quantity;

            $order->total = $total;

            $order->time = Carbon::now('Asia/Ho_Chi_Minh');

            $order->product_id = $data->product_id;

            $order->color = $data->color;

            $order->payment_status = 0;

            $order->delivery_status = 0;

            // Calculate and add to the total order amount
            $totalOrderAmount += $order->total;

            $order->save();

            $cart_id = $data->id;

            $cart = cart::find($cart_id);

            $cart->delete();

            // Send email to the customer
        }
        $this->sendOrderConfirmationEmail($order, $totalOrderAmount);
        
        return redirect()->back();
    }

    public function vnpay_payment(Request $request)
    {
        $data = $request->all();

        $id = time();

        $user = Auth::user();

        $username = $user->name;

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://thegioidienthoai.quan-nguyen.net/thanh-toan-vnpay";
        // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "DDPP03TJ"; //Mã website tại VNPAY 
        $vnp_HashSecret = "UCPDPOVMVEHIZZVXFRLWUPWQXPGJPBEL"; //Chuỗi bí mật

        $vnp_TxnRef = $id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $username . " thanh toán đơn hàng " . $id;
        $vnp_OrderType = "TheGioiDienThoai";
        $vnp_Amount = $data['total'] * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        // //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        // //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate"=>$vnp_ExpireDate,
            // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            // "vnp_Bill_Email"=>$vnp_Bill_Email,
            // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            // "vnp_Bill_Address"=>$vnp_Bill_Address,
            // "vnp_Bill_City"=>$vnp_Bill_City,
            // "vnp_Bill_Country"=>$vnp_Bill_Country,
            // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            // "vnp_Inv_Email"=>$vnp_Inv_Email,
            // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            // "vnp_Inv_Address"=>$vnp_Inv_Address,
            // "vnp_Inv_Company"=>$vnp_Inv_Company,
            // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            // "vnp_Inv_Type"=>$vnp_Inv_Type
        );

       


        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            // echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }

    public function view_vnpayment_return()
    {
        if (isset($_GET['vnp_TxnRef'])) {
            $id = Auth::user()->id;

            $user = user::find($id);

            $cart = cart::with('color')->with('product')->where('user_id', '=', $id)->get();

            $count_product_cart = $cart->sum('quantity');

            $cart_user_info = cart::where('user_id', '=', $id)->first();

            $keyword = brand::take(5)->get();

            $brand = brand::all();


            //Xóa giỏ hàng khi thanh toán thành công
            $userid = $user->id;

            $order_id = $_GET['vnp_TxnRef'];

            $data = cart::with('product')->where('user_id', '=', $userid)->get();

            $totalOrderAmount = 0;

            if ($_GET['vnp_ResponseCode'] == 00) {
                foreach ($data as $data) {
                    $order = new order;
    
                    $order->order_number = $order_id;
    
                    $order->name = $data->name;
    
                    $order->email = $data->email;
    
                    $order->phone = $data->phone;
    
                    $order->address = $data->address;
    
                    $order->user_id = $data->user_id;
    
                    $order->price = $data->product->price;
    
                    $order->quantity = $data->quantity;
    
                    $total = $data->product->price * $data->quantity;
    
                    $order->total = $total;
    
                    $order->time = Carbon::now('Asia/Ho_Chi_Minh');
    
                    $order->product_id = $data->product_id;
    
                    $order->color = $data->color;
    
                    $order->payment_status = 1;
    
                    $order->delivery_status = 0;

                    // Calculate and add to the total order amount
                    $totalOrderAmount += $order->total;
    
                    $order->save();
    
                    $cart_id = $data->id;
    
                    $cart = cart::find($cart_id);
    
                    $cart->delete();

                    $count_product_cart = 0;

                     // Thêm chuyển hướng sau khi xử lý thành công
                    //  return view('home.vnpay_return', compact('cart', 'user', 'keyword', 'brand', 'count_product_cart'));
                }
                $this->sendOrderConfirmationEmail($order, $totalOrderAmount);
            } 

            return view('home.vnpay_return', compact('cart', 'user', 'keyword', 'brand', 'count_product_cart'));
        } else {
            return redirect('/');
        }
    }

    private function sendOrderConfirmationEmail($order, $totalOrderAmount)
    {
        $to = $order->email;
        $order_number = $order->order_number;
        $subject = 'Xác nhận đơn hàng ' . $order_number;
        $formattedTotalOrderAmount = number_format($totalOrderAmount);

        // Fetch additional product information using the order number
        $orderDetails = order::with('product')->where('order_number', $order_number)->get();

        // Build the email content
        $content = "Xin chào khách hàng {$order->name}, \n";

        $content .= "Thông tin các sản phẩm mà quý khách đã mua:\n";

        foreach ($orderDetails as $orderItem) {
            $formattedPrice = number_format($orderItem->price);
            $formattedTotal = number_format($orderItem->total);
            $content .= "- Điện thoại {$orderItem->product->name} màu {$orderItem->color} (Số lượng: {$orderItem->quantity}, Giá: {$formattedPrice}₫, Thành tiền: {$formattedTotal}₫).\n";
        }

        $content .= "Tổng giá trị đơn hàng là: {$formattedTotalOrderAmount}₫. \n";
        $content .= "Các sản phẩm sẽ được chúng tôi giao hàng đến quý khách sớm nhất có thể. \n";
        $content .= "Xin cảm ơn quý khách đã mua hàng của chúng tôi !";

        // Send the email
        Mail::raw($content, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }


    //Order
    public function view_order()
    {
        if (Auth::id()) {
            $user = Auth::user();

            $userid = $user->id;

            $cart = cart::where('user_id', '=', $userid)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brand = brand::all();

            $orders = order::where('user_id', '=', $userid)->get();

            $mergedorders = $orders->groupBy('order_number')->map(function ($items) {

                // $deliveryStatusOneCount = $items->filter(function ($item) {

                //     return $item->delivery_status == 1;
                // })->count();

                return [
                    'total_quantity' => $items->sum('quantity'),

                    'total_amount' => $items->sum('total'),

                    'payment_status' => $items[0]->payment_status, // Assuming payment_status is the same for all items in an order

                    'delivery_status' => $items[0]->delivery_status, // Assuming delivery_status is the same for all items in an order

                    'time' => $items[0]->time, // Assuming time is the same for all items in an order

                    // 'delivery_status_one_count' => $deliveryStatusOneCount,
                ];
            })->sortByDesc(function ($item, $key) {
                return $key;
            });

            $order_delivered = $orders->groupBy('order_number')->filter(function ($items) {
                return $items->every(function ($item) {
                    return $item->delivery_status == 2;
                });
            });

            $count_order_delivered = $order_delivered->count();

            return view('home.order', compact('mergedorders', 'keyword', 'brand', 'count_product_cart', 'count_order_delivered'));
        } else {
            return redirect('login');
        }
    }

    public function order_cancel(Request $request, $key)
    {
        if (Auth::id()) {
            $orders = order::where('order_number', $key)->get();

            foreach ($orders as $order) {
                $order->delivery_status = 3;

                $order->save();
            }

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }



    public function view_order_detail($key)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $order = order::with('product')->where('order_number', $key)->get();

            $order_id = $key;

            $brand = brand::all();

            $keyword = brand::take(5)->get();

            return view('home.order_detail', compact('order', 'order_id', 'keyword', 'count_product_cart', 'brand'));
        } else {
            return redirect('login');
        }
    }

    //Product Filter Price
    public function filter_product_over_20()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('price', '>', 20000000)->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('price', '>', 20000000)->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'trên 20 triệu';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('price', '>', 20000000)->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('price', '>', 20000000)->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'trên 20 triệu';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_from_10_to_20()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::whereBetween('price', [10000000, 20000000])->orderBy('id', 'DESC')->paginate(10);

            $product = product::whereBetween('price', [10000000, 20000000])->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'từ 10 đến 20 triệu';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::whereBetween('price', [10000000, 20000000])->orderBy('id', 'DESC')->paginate(10);

            $product = product::whereBetween('price', [10000000, 20000000])->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'từ 10 đến 20 triệu';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_from_4_to_10()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::whereBetween('price', [4000000, 10000000])->orderBy('id', 'DESC')->paginate(10);

            $product = product::whereBetween('price', [4000000, 10000000])->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'từ 4 đến 10 triệu';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::whereBetween('price', [4000000, 10000000])->orderBy('id', 'DESC')->paginate(10);

            $product = product::whereBetween('price', [4000000, 10000000])->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'từ 4 đến 10 triệu';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_under_4()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('price', '<', 4000000)->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('price', '<', 4000000)->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'dưới 4 triệu';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('price', '<', 4000000)->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('price', '<', 4000000)->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'dưới 4 triệu';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    //Product Filter RAM
    public function filter_product_ram_4gb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('ram', '=', '4 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '4 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'RAM 4 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('ram', '=', '4 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '4 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'RAM 4 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_ram_6gb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('ram', '=', '6 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '6 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'RAM 6 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('ram', '=', '6 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '6 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'RAM 6 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_ram_8gb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('ram', '=', '8 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '8 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'RAM 8 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('ram', '=', '8 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '8 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'RAM 8 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_ram_12gb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('ram', '=', '12 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '12 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'RAM 12 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('ram', '=', '12 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '12 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'RAM 12 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    //Product Filter ROM
    public function filter_product_rom_64gb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '64 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '64 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 64 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '64 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('ram', '=', '12 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 64 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_rom_128gb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '128 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '128 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 128 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '128 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '128 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 128 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_rom_256gb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '256 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '256 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 256 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '256 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '256 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 256 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_rom_512gb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '512 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '512 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 512 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '512 GB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '512 GB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 512 GB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_rom_1tb()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '1 TB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '1 TB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 1 TB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('rom', '=', '1 TB')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('rom', '=', '1 TB')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'ROM 1 TB';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    //Product Filter PIN
    public function filter_product_pin_under_3000mAh()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('pin', '<', '3000')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('pin', '<', '3000')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'PIN dưới 3000 mAh';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('pin', '<', '3000')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('pin', '<', '3000')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'PIN dưới 3000 mAh';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_pin_from_3000_to_4000mAh()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::whereBetween('pin', [3000, 4000])->orderBy('id', 'DESC')->paginate(10);

            $product = product::whereBetween('pin', [3000, 4000])->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'PIN từ 3000 mAh đến 4000 mAh';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::whereBetween('pin', [3000, 4000])->orderBy('id', 'DESC')->paginate(10);

            $product = product::whereBetween('pin', [3000, 4000])->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'PIN từ 3000 mAh đến 4000 mAh';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_pin_from_4000_to_5000mAh()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::whereBetween('pin', [4000, 5000])->orderBy('id', 'DESC')->paginate(10);

            $product = product::whereBetween('pin', [4000, 5000])->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'PIN từ 4000 mAh đến 5000 mAh';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::whereBetween('pin', [4000, 5000])->orderBy('id', 'DESC')->paginate(10);

            $product = product::whereBetween('pin', [4000, 5000])->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'PIN từ 4000 mAh đến 5000 mAh';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_pin_over_5000mAh()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('pin', '>', '5000')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('pin', '>', '5000')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'PIN tren 5000mAh';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::where('pin', '>', '5000')->orderBy('id', 'DESC')->paginate(10);

            $product = product::where('pin', '>', '5000')->orderBy('id', 'DESC')->get();

            $count_result = $product->count();

            $text = 'PIN tren 5000mAh';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    //Product Filter Price Increase Or Decrease And Name A-Z Z-A
    public function filter_product_price_increase()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('price', 'ASC')->paginate(10);

            $product = product::orderBy('price', 'ASC')->get();

            $count_result = $product->count();

            $text = 'giá tăng dần';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('price', 'ASC')->paginate(10);

            $product = product::orderBy('price', 'ASC')->get();

            $count_result = $product->count();

            $text = 'giá tăng dần';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_price_decrease()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('price', 'DESC')->paginate(10);

            $product = product::orderBy('price', 'DESC')->get();

            $count_result = $product->count();

            $text = 'giá giảm dần';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('price', 'DESC')->paginate(10);

            $product = product::orderBy('price', 'DESC')->get();

            $count_result = $product->count();

            $text = 'giá giảm dần';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_name_AZ()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('name', 'ASC')->paginate(10);

            $product = product::orderBy('name', 'ASC')->get();

            $count_result = $product->count();

            $text = 'tên A-Z';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('name', 'ASC')->paginate(10);

            $product = product::orderBy('name', 'ASC')->get();

            $count_result = $product->count();

            $text = 'tên A-Z';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }

    public function filter_product_name_ZA()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $user_id)->get();

            $count_product_cart = $cart->sum('quantity');

            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('name', 'DESC')->paginate(10);

            $product = product::orderBy('name', 'DESC')->get();

            $count_result = $product->count();

            $text = 'tên Z-A';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result', 'count_product_cart'));
        } else {
            $keyword = brand::take(5)->get();

            $brands = brand::all();

            $products = product::orderBy('name', 'DESC')->paginate(10);

            $product = product::orderBy('name', 'DESC')->get();

            $count_result = $product->count();

            $text = 'tên Z-A';

            return view('home.product_filter', compact('keyword', 'products', 'brands', 'text', 'count_result'));
        }
    }
}
