<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Posts;
use App\Models\Review;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSubmitted;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        // Lấy banners
        $banners = Banner::whereNull('deleted_at')->get();

        // Lấy 8 sản phẩm mới nhất
        $latestProducts = Product::whereNull('deleted_at')
            ->where('trang_thai', 1)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Lấy 4 bài viết mới nhất
        $latestPosts = Posts::whereNull('deleted_at')
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Lấy 10 đánh giá mới nhất có điểm cao nhất
        $topReviews = Review::whereNull('deleted_at')
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('client.products.index', compact('banners', 'latestProducts', 'latestPosts', 'topReviews'));
    }
    // Product listing with pagination, filters, and sorting
    public function productList(Request $request)
    {
        $query = Product::query()
            ->where('trang_thai', 1) // Chỉ lấy sản phẩm đang hoạt động
            ->whereNull('deleted_at'); // Không lấy sản phẩm đã xóa mềm

        // Apply name filter
        if ($request->has('name') && !empty($request->input('name'))) {
            $query->where('ten_san_pham', 'like', '%' . $request->input('name') . '%');
        }

        // Apply category filter
        if ($request->has('category_id') && !empty($request->input('category_id'))) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Apply price range filter (tính giá sau giảm)
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 2000000);
        $query->whereRaw('gia_san_pham - COALESCE(giam_gia, 0) >= ?', [$minPrice])
              ->whereRaw('gia_san_pham - COALESCE(giam_gia, 0) <= ?', [$maxPrice]);

        // Apply sorting (sắp xếp theo giá sau giảm)
        if ($request->has('sort')) {
            if ($request->input('sort') === 'price_asc') {
                $query->orderByRaw('gia_san_pham - COALESCE(giam_gia, 0) ASC');
            } elseif ($request->input('sort') === 'price_desc') {
                $query->orderByRaw('gia_san_pham - COALESCE(giam_gia, 0) DESC');
            }
        }

        // Lấy dữ liệu với phân trang và quan hệ category
        $products = $query->with('category')->paginate(10);
        $categories = Category::where('trang_thai', 1)->whereNull('deleted_at')->get();

        // Truyền dữ liệu vào view
        return view('client.products.list', compact('products', 'categories'));
    }

    // Products by category
    public function productsByCategory($category)
    {
        $categoryModel = Category::findOrFail($category);
        $products = Product::where('category_id', $category)->paginate(10);
        $categories = Category::all();

        return view('client.products.index', compact('products', 'categories', 'categoryModel'));
    }

    // Product detail
    public function productDetail($id)
    {
        $product = Product::findOrFail($id);

        // Get 5 related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->take(5)
            ->get();

        // Get reviews if user is authenticated
        $reviews = [];
        if (Auth::check()) {
            $reviews = Review::where('product_id', $id)->get();
        }
        return view('client.products.show', compact('product', 'relatedProducts', 'reviews'));
    }

    // Product reviews (accessible only to authenticated users)
    public function productReviews($id)
    {
        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $product->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('client.products.reviews', compact('product', 'reviews'));
    }


    public function store(Request $request)
    {
        $dataNew = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:1000',
        ], [
            'product_id.required' => 'Sản phẩm không tồn tại',
            'rating.required' => 'Vui lòng chọn đánh giá',
            'content.required' => 'Nội dung không được để trống',
        ], [
            'product_id' => 'Sản phẩm',
            'rating' => 'Đánh giá',
            'content' => 'Nội dung',
        ]);

        // Tạo một đánh giá mới
        Review::create([
            'user_id' => Auth::id(), // Lấy ID của user đang đăng nhập
            'product_id' => $dataNew['product_id'],
            'content' => $dataNew['content'],
            'rating' => $dataNew['rating'],
        ]);

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi!');
    }
    // // Blog post listing
    public function postList(Request $request) // Yêu cầu tham số $request
    {
        $query = Posts::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('client.products.post', compact('posts'));
    }
    public function postDetail($id)
    {
        $post = Posts::with('category')->findOrFail($id);
        return view('client.products.showpost', compact('post'));
    }

}
