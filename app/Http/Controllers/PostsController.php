<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function index(Request $request) {
        $query = Posts::with('category');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        if ($request->filled('content')) {
            $query->where('content', 'like', '%' . $request->input('content') . '%');
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $posts = $query->paginate(10);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }
    public function create() {
        $categories = Category::all();
        return view('admin.posts.create' , compact('categories'));
    }
    public function store(Request $request) {
        $dataNew = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'required' => ':attribute khong duoc de trong',
            'image' => ':attribute phai la hinh anh',
            'max' => ':attribute khong duoc lon hon :max',
        ], [
            'title' => 'Tieu de',
            'content' => 'Noi dung',
            'category_id' => 'Danh muc',    
            'image' => 'Hinh anh',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images/products', 'public');
            $dataNew['image'] = $image;
        }
     Posts::create($dataNew);
        return redirect()->route('admin.posts.index' )->with('success' , 'Them bai viet thanh cong');
    }
    public function edit($id) {
        $post = Posts::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit' , compact('post' , 'categories'));
    }
    public function update(Request $request , $id) {
        $post = Posts::findOrFail($id);
        $dataNew = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'required' => ':attribute khong duoc de trong',
            'image' => ':attribute phai la hinh anh',
            'max' => ':attribute khong duoc lon hon :max',
        ], [
            'title' => 'Tieu de',
            'content' => 'Noi dung',
            'category_id' => 'Danh muc',    
            'image' => 'Hinh anh',
        ]);
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $image = $request->file('image')->store('images/products', 'public');
            $dataNew['image'] = $image;
        }
        $post = Posts::findOrFail($id);
        $post->update($dataNew);
        return redirect()->route('admin.posts.index' )->with('success' , 'Cap nhat bai viet thanh cong');
    }
    public function destroy($id) {
        $post = Posts::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index' )->with('success' , 'Xoa bai viet thanh cong');
    }
    public function delete() {
        $posts = Posts::onlyTrashed()->get();
        return view('admin.posts.delete' , compact('posts'));
    }
    public function restore($id) {
        $post = Posts::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.posts.index' )->with('success' , 'Khoi phuc bai viet thanh cong');
    }
    public function forceDelete($id) {
        $post = Posts::withTrashed()->findOrFail($id);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->forceDelete();
        return redirect()->route('admin.posts.index' )->with('success' , 'Xoa bai viet thanh cong');
    }
}
