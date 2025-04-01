<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(Request $request) {
        $query = Banner::query();
        if ($request->filled('ten_banner')) {
            $query->where('ten_banner', 'like', '%' . $request->ten_banner . '%');
        }
        $banners = $query->paginate();
        return view('admin.banner.index' , compact('banners'));
    }
    
    public function create() {
        return view('admin.banner.create');
    }
    
    public function store(Request $request) {
        $dataNew = $request->validate([
            'ten_banner' => 'required',
            'anh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'required'
        ]);
        
        if ($request->hasFile('anh')) {
            $anh = $request->file('anh')->store('images/banner', 'public');
            $dataNew['anh'] = $anh;
        }
        
        Banner::create($dataNew);
        return redirect()->route('admin.banner.index')->with('success', 'Thêm banner thành công');
    }
    
    public function edit(Banner $banner , $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }
    
    public function update(Request $request , $id)
    {
        $banner = Banner::findOrFail($id);
        $dataNew = $request->validate([
            'ten_banner' => 'required',
            'anh' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'required'
        ],
        [
            'required' => ':attribute khó trống',
            'string' => ':attribute phải là chuỗi',
            'max.string' => ':attribute khó quá :max ký tự',
        ], [
            'ten_banner' => 'Ten banner',
            'anh' => 'Hình ảnh  ',
            'link' => 'Link',
        ]);
          
        if ($request->hasFile('anh')) {
            if($banner->anh){
                Storage::disk('public')->delete($banner->anh);
            }
            $anh = $request->file('anh')->store('images/banner', 'public');
            $dataNew['anh'] = $anh;
        }
        
        $banner->update($dataNew);
        return redirect()->route('admin.banners.index')->with('success', 'S a banner thành công');
    }
    
    public function destroy(Banner $banner , $id)
    {
        $banner = Banner::findOrFail($id)->delete();
        return redirect()->route('admin.banners.index', compact('banner'))->with('success', 'Xóa banner thành công');
    }

    public function delete() {
        $banners = Banner::onlyTrashed()->paginate();
        return view('admin.banner.delete', compact('banners'));
    }
    
    public function restore($id) {
        $banners = Banner::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.banners.index' , compact('banners'))->with('success', 'Khôi phức hợp lệ');
    }
    
    public function forceDelete($id) {
        $banners = Banner::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.banners.index' , compact('banners'))->with('success', 'Xóa hợp lệ');
    }
}
