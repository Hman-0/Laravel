<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'product']); // Tải quan hệ user và product

        // Lọc theo tên người dùng
        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }

        // Lọc theo email người dùng
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->input('email') . '%');
            });
        }

        // Lọc theo tên sản phẩm (nếu cần)
        if ($request->filled('product_name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('ten_san_pham', 'like', '%' . $request->input('product_name') . '%');
            });
        }

        $reviews = $query->paginate(10);
        return view('admin.review.index', compact('reviews'));
    }

    public function create()
    {
        $products = Product::all();
        $users = User::all(); // Lấy danh sách người dùng để chọn
        return view('admin.review.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $dataNew = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ], [
            'required' => ':attribute không được để trống',
            'exists' => ':attribute không hợp lệ',
            'between' => ':attribute phải từ :min đến :max',
        ], [
            'user_id' => 'Người dùng',
            'product_id' => 'Sản phẩm',
            'content' => 'Nội dung',
            'rating' => 'Đánh giá',
        ]);

        Review::create($dataNew);
        return redirect()->route('admin.reviews.index')->with('success', 'Thêm đánh giá thành công');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $products = Product::all();
        $users = User::all(); // Lấy danh sách người dùng để chọn
        return view('admin.review.edit', compact('review', 'products', 'users'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $dataUpdate = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ], [
            'required' => ':attribute không được để trống',
            'exists' => ':attribute không hợp lệ',
            'between' => ':attribute phải từ :min đến :max',
        ], [
            'user_id' => 'Người dùng',
            'product_id' => 'Sản phẩm',
            'content' => 'Nội dung',
            'rating' => 'Đánh giá',
        ]);

        $review->update($dataUpdate);

        return redirect()->route('admin.reviews.index')->with('success', 'Cập nhật đánh giá thành công');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Xóa đánh giá thành công');
    }

    public function delete()
    {
        $reviews = Review::onlyTrashed()->with(['user', 'product'])->paginate(10);
        return view('admin.review.delete', compact('reviews'));
    }

    public function restore($id)
    {
        $review = Review::onlyTrashed()->findOrFail($id);
        $review->restore();

        return redirect()->route('admin.reviews.index')->with('success', 'Khôi phục đánh giá thành công');
    }

    public function forceDelete($id)
    {
        $review = Review::onlyTrashed()->findOrFail($id);
        $review->forceDelete();

        return redirect()->route('admin.reviews.index')->with('success', 'Xóa vĩnh viễn đánh giá thành công');
    }
}
