<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $query = Category::query();
    
        // Lọc theo tên danh mục
        if ($request->filled('ten_danh_muc')) {
            $query->where('ten_danh_muc', 'like', '%' . $request->ten_danh_muc . '%');
        }
    
        // Lọc theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }
    
        // Phân trang, giữ lại thông tin lọc
        $categories = $query->paginate(10);
    
        return view('admin.category.index', compact('categories'));
    }
    
    public function create() {
        return view('admin.category.create');
    }
    public function store(Request $request) {
        $dataNew = $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
            'trang_thai' => 'required|boolean'
        ]);
        Category::create($dataNew);
        return redirect()->route('admin.categories.index');
    }
    public function edit(Category $category , $id) {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id) {
        $category = Category::find($id);
        $dataUpdate = $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
            'trang_thai' => 'required|boolean'
        ],
    [
        'required' => ':attribute khó trống',
        'string' => ':attribute phải là chuỗi',
        'max.string' => ':attribute khó quá :max ký tự',
    ], [
        'ten_danh_muc' => 'Ten danh muc',
        'trang_thai' => 'Trang thai',
    ]);
        $category->update($dataUpdate);
        return redirect()->route('admin.categories.index');
    }
    public function destroy(Category $category , $id) {
        $category = Category::findOrFail($id);
        if ($category->products()->exists()) {
            return back()->with('error', 'Danh mục đang có sản phẩm, không thể xóa!');
        }
        $category->delete();
        return redirect()->route('admin.categories.index' , compact('category'))->with('success', 'Xóa danh mục thành công ');
    }
    public function delete() {
        $categories  = Category::onlyTrashed()->paginate(10);
        return view('admin.category.delete', compact('categories'));
    }
    public function restore($id) {
        $category = Category::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.categories.index')->with('success', 'Khôi phục hợp lệ');
    }
    public function forceDelete($id) {
        $category = Category::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.categories.index')->with('success', 'Xóa hợp lệ');
    }
}
