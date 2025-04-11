<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            return redirect()->route('admin.products.index');
        }
        return back()->withErrors([
            'email' => 'không chính xác',
        ]);
    }
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'required' => ':attribute khong duoc de trong',
            'email' => ':attribute khong dung dinh dang',
            'unique' => ':attribute da ton tai',
            'min' => ':attribute phai lon hon 8 ky tu',
            'confirmed' => ':attribute khong khop'
        ],[
            'name' => 'Ten',
            'email' => 'Email',
            'password' => 'Mat khau',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => User::ROLE_USER
        ]);
        Auth::login($user);
        return redirect()->route('admin.products.index');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('home');
    }
    public function showRegister(){
        return view('register');
    }

}
