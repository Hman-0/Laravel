<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::whereNull('deleted_at')
        ->where('trang_thai', 1);

    // Filter by name
    if ($request->has('search') && !empty($request->search)) {
        $query->where('ten_san_pham', 'like', '%' . $request->search . '%');
    }

    // Filter by category
    if ($request->has('category') && !empty($request->category)) {
        $query->where('category_id', $request->category);
    }

    // Filter by price range
    if ($request->has('min_price') && !empty($request->min_price)) {
        $query->where('gia_san_pham', '>=', $request->min_price);
    }

    if ($request->has('max_price') && !empty($request->max_price)) {
        $query->where('gia_san_pham', '<=', $request->max_price);
    }

    // Sort products
    if ($request->has('sort')) {
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('gia_san_pham', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('gia_san_pham', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }
    } else {
        $query->orderBy('id', 'desc');
    }

    $products = $query->paginate(10);
    $categories = Category::whereNull('deleted_at')->where('trang_thai', 1)->get();

    return view('admin.products.index', compact('products', 'categories'));
}


    // app/Http/Controllers/ProductController.php (continuation)

public function show($id)
{
    $product = Product::findOrFail($id);

    // Get related products (same category)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->whereNull('deleted_at')
        ->where('trang_thai', 1)
        ->take(5)
        ->get();

    // Get product reviews
    $reviews = Review::where('product_id', $product->id)
        ->whereNull('deleted_at')
        ->orderBy('created_at', 'desc')
        ->get();

    // Calculate average rating
    $averageRating = $reviews->avg('rating') ?: 0;

    return view('products.show', compact('product', 'relatedProducts', 'reviews', 'averageRating'));
}
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    public function store(Request $request)

    {

        $dataNew = $request->validate([
            'ma_san_pham'           => 'required|string|max:20|unique:products,ma_san_pham',
            'ten_san_pham'          => 'required|string|max:255',
            'category_id'           => 'required|exists:categories,id',
            'gia_san_pham'          => 'required|numeric|min:0|max:999999999',
            'giam_gia'              => 'nullable|numeric|min:0|lt:gia_san_pham',
            'img'                   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'so_luong'              => 'required|integer|min:0',
            'ngay_nhap_kho'        => 'required|date',
            'mo_ta'                 => 'nullable|string',
            'trang_thai'            => 'required|boolean',
        ],[
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'max.string' => ':attribute không được vượt quá :max ký tự.',
            'max.numeric' => ':attribute không được lớn hơn :max.',
            'min.numeric' => ':attribute phải lớn hơn hoặc bằng :min.',
            'integer' => ':attribute phải là số nguyên.',
            'unique' => ':attribute đã tồn tại.',
            'numeric' => ':attribute phải là số.',
            'date' => ':attribute phải là ngày hợp lệ.',
            'image' => ':attribute phải là hình ảnh.',
            'boolean' => ':attribute phải là đúng hoặc sai.',
        ], [
            'ma_san_pham' => 'Mã sản phẩm',
            'ten_san_pham' => 'Tên sản phẩm',
            'category_id' => 'Danh mục',
            'hinh_anh' => 'Hình ảnh',
            'gia' => 'Giá',
            'gia_khuyen_mai' => 'Giá khuyến mãi',
            'so_luong' => 'Số lượng',
            'mo_ta' => 'Mô tả',
            'trang_thai' => 'Trạng thái'
        ]);

        if ($request->hasFile('img')) {
            $img = $request->file('img')->store('images/products', 'public');
            $dataNew['img'] = $img;
        }
        Product::create($dataNew);
        return redirect()->route('admin.products.index');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));

    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $dataNew = $request->validate([
            'ma_san_pham'           => 'required|string|max:20|unique:products,ma_san_pham,' . $product->id,
            'ten_san_pham'          => 'required|string|max:255',
            'category_id'           => 'required|exists:categories,id',
            'gia_san_pham'          => 'required|numeric|min:0|max:999999999',
            'giam_gia'              => 'nullable|numeric|min:0|lt:gia_san_pham',
            'img'                   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'so_luong'              => 'required|integer|min:0',
            'ngay_nhap_kho'        => 'required|date',
            'mo_ta'                 => 'nullable|string',
            'trang_thai'            => 'required|boolean',
        ],[
            'required' => ':attribute không được sé trống.',
            'string' => ':attribute phải là chuỗi.',
            'max.string' => ':attribute khó quá :max ký tự.',
            'max.numeric' => ':attribute khó quá :max.',
            'min.numeric' => ':attribute phải lớn hơn hoặc bằng :min.',
            'integer' => ':attribute phải là số nguyên.',
            'unique' => ':attribute đã tồn tại.',
            'numeric' => ':attribute phải là số.',
            'date' => ':attribute phải là ngày hợp lệ.',
            'image' => ':attribute phải là hình ảnh.',
            'boolean' => ':attribute phải là đúng hoặc sai.',
        ], [
            'ma_san_pham' => 'Mã sản phẩm',
            'ten_san_pham' => 'Ten san pham',
            'category_id' => 'Danh mục',
            'hinh_anh' => 'Hình ảnh',
            'gia' => 'Giá',
            'gia_khuyen_mai' => 'Giá khuyến mái',
            'so_luong' => 'Số lượng',
            'mo_ta' => 'Mô tả',
            'trang_thai' => 'Trạng thái'
        ]);
        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            $img = $request->file('img')->store('images/products', 'public');
            $dataNew['img'] = $img;
        }
        $product->update($dataNew);
        return redirect()->route('admin.products.index');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công');
    }
    public function delete()
    {
        $products  = Product::onlyTrashed()->paginate(10);
        return view('admin.products.delete', compact('products'));

    }
    public function restore($id)
    {
        $products  = Product::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.products.index' , compact('products'))->with('success', 'Khôi phục hợp lệ');
    }
    public function forceDelete($id)
    {
        $products = Product::withTrashed()->findOrFail($id);
        if ($products->img) {
            Storage::disk('public')->delete($products->img);
        }
        $products->forceDelete();
        return redirect()->route('admin.products.index' ,compact('products'))->with('success', 'Xóa hợp lệ');
    }

}
