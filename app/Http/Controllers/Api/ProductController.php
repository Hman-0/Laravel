<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');
        if ($request->filled('ma_san_pham')) {
            $query->where('ma_san_pham', 'like', '%' . $request->ma_san_pham . '%');
        }
        if ($request->filled('ten_san_pham')) {
            $query->where('ten_san_pham', 'like', '%' . $request->ten_san_pham . '%');
        }
        if ($request->filled('gia_san_pham_from') && $request->filled('gia_san_pham_to')) {
            $query->whereBetween('gia_san_pham', [$request->gia_san_pham_from, $request->gia_san_pham_to]);
        }
        if ($request->filled('ngay_nhap_kho')) {
            $query->whereDate('ngay_nhap_kho', $request->ngay_nhap_kho);
        }
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $products = $query->orderBy('id', 'desc')->paginate();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $products = Product::create($dataNew);
        return response()->json([
            'data' => new ProductResource($products),
            'message' => 'Them ok',
            'status' => 200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::with('category')->findOrFail($id);
        return response()->json([
            'data' => new ProductResource($products),
            'message' => 'Product retrieved successfully',
            'status' => 200,
        ]);
        //Hiẻn thị thông qua resource
        //Colection chỉ sửa dùng nhiều bản ghi
        // return new ProductResource($products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        return response()->json([
            'data' => new ProductResource($product),
            'message' => 'Product updated successfully',
            'status' => 201,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->img) {
            Storage::disk('public')->delete($product->img);
        }
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully',
            'status' => 200,
        ]);
    }
}
