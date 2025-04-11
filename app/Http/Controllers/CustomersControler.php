<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;


class CustomersController extends Controller
{
    public function index(Request $request) {
        $query = Customer::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->input('address') . '%');
        }

        $customers = $query->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }
    public function create() {
        return view('admin.customers.create');
    }
    public function store(Request $request) {
        $dataNew = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
            'phone' => 'required|unique:customers|max:10',
            'address' => 'required',
        ],[
            'required' => ':attribute khong duoc de trong',
            'email' => ':attribute khong dung dinh dang',
            'unique' => ':attribute da ton tai',
            'min' => ':attribute phai lon hon :min ky tu'
        ], [
            'name' => 'Ten',
            'email' => 'Email',
            'phone' => 'Dien thoai',
            'address' => 'Dia chi',
        ]);
        Customer::create($dataNew);
        return redirect()->route('admin.customers.index' )->with('success' , 'Them khach hang thanh cong');
    }
    public function edit($id) {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit' , compact('customer'));
    }
    public function update(Request $request , $id) {
        $customer = Customer::findOrFail($id);
        $dataNew = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' .$id,
            'password' => 'required'|'min:6',
            'phone' => 'required|unique:customers,phone,'.$id .'|max:10',
            'address' => 'required',
        ],[
            'required' => ':attribute khong duoc de trong',
            'email' => ':attribute khong dung dinh dang',
            'unique' => ':attribute da ton tai',
        ], [
            'name' => 'Ten',
            'email' => 'Email',
            'phone' => 'Dien thoai',
            'address' => 'Dia chi',
        ]);
        $customer->update($dataNew);
        return redirect()->route('admin.customers.index' )->with('success' , 'Cap nhat khach hang thanh cong');
    }
    public function destroy($id) {
        $customer = Customer::findOrFail($id)->delete();
        return redirect()->route('admin.customers.index' )->with('success' , 'Xoa khach hang thanh cong');
    }
    public function delete() {
        $customers = Customer::onlyTrashed()->paginate(10);
        return view('admin.customers.delete' , compact('customers'));
    }
    public function restore($id) {
        $customer = Customer::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.customers.index' )->with('success' , 'Khoi phuc khach hang thanh cong');
    }
    public function forceDelete($id) {
        $customer = Customer::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.customers.index' )->with('success' , 'Xoa khach hang thanh cong');
    }
}
