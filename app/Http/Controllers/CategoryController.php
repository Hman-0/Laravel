<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        
        return view('admin.category.index' , compact('categories'));
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
    public function destroy(Category $category) {
        if ($category->products()->exists()) {
            return back()->with('error', 'Danh mục đang có sản phẩm, không thể xóa!');
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công ');
    }
}
