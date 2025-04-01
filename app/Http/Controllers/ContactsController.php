<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index(Request $request) {
        $query = Contact::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->input('phone') . '%');
        }
        $contacts = $query->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }
    public function create() {
        return view('admin.contacts.create');
    }
    public function store(Request $request) {
        $dataNew = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required|unique:contacts|max:10',
            'title' => 'required',
            'content' => 'required',
        ],[
            'required' => ':attribute khong duoc de trong',
            'email' => ':attribute khong dung dinh dang',
            'unique' => ':attribute da ton tai',
        ], [
            'name' => 'Ten',
            'email' => 'Email',
            'phone' => 'Dien thoai',
            'title' => 'Tieu de',
            'content' => 'Noi dung',
        ]);
        Contact::create($dataNew);
        return redirect()->route('admin.contacts.index' )->with('success' , 'Them lien he thanh cong');
    }
    public function edit($id) {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.edit' , compact('contact'));
    }
    public function update(Request $request , $id) {
        $contact = Contact::findOrFail($id);
        $dataNew = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts,email,' .$id,
            'phone' => 'required|unique:contacts,phone,'.$id .'|max:10',
            'title' => 'required',
            'content' => 'required',
        ],[
            'required' => ':attribute khong duoc de trong',
            'email' => ':attribute khong dung dinh dang',
            'unique' => ':attribute da ton tai',
        ], [
            'name' => 'Ten',
            'email' => 'Email',
            'phone' => 'Dien thoai',
            'title' => 'Tieu de',
            'content' => 'Noi dung',
        ]);
        $contact->update($dataNew);
        return redirect()->route('admin.contacts.index' )->with('success' , 'Cap nhat lien he thanh cong');
    }
    public function delete() {
        $contacts = Contact::onlyTrashed()->paginate(10);
        return view('admin.contacts.delete' , compact('contacts'));
    }
 
    public function destroy($id) {
        $contact = Contact::findOrFail($id)->delete();
     
        return redirect()->route('admin.contacts.index' )->with('success' , 'Xoa lien he thanh cong');
    }
    public function forceDelete($id) {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->forceDelete();
        return redirect()->route('admin.contacts.index' )->with('success' , 'Xoa lien he thanh cong');
    }
    public function restore($id) {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('admin.contacts.index' )->with('success' , 'Khoi phuc lien he thanh cong');
    }
}
