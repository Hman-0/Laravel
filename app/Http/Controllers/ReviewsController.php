<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index(Request $request) {
        $query = Review::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->input('phone') . '%');
        }
        $reviews = $query->paginate(10);
        return view('admin.review.index', compact('reviews'));
    }
    public function create()
    {
        return view('admin.review.create');
    }

    public function store(Request $request)
    {
        $dataNew = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:reviews,email',
            'phone' => 'required|numeric|digits_between:9,11|unique:reviews,phone',
            'content' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ], [
            'required' => ':attribute không được để trống',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'numeric' => ':attribute phải là số',
            'digits_between' => ':attribute phải có từ :min đến :max chữ số',
            'between' => ':attribute phải từ :min đến :max',
        ], [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'content' => 'Nội dung',
            'rating' => 'Đánh giá',
        ]);

        Review::create($dataNew);
        return redirect()->route('admin.reviews.index')->with('success', 'Thêm đánh giá thành công');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.review.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $dataUpdate = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:reviews,email,' . $id,
            'phone' => 'required|numeric|digits_between:9,11|unique:reviews,phone,' . $id,
            'content' => 'required|string',
            'rating' => 'required|integer|between:1,5',
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
        $reviews = Review::onlyTrashed()->paginate(10);
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
