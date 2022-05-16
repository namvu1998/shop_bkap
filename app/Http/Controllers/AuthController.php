<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('fe.pages.login');
    }
    public function register(RegisterRequest $req)
    {
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'role' => 0
        ]);
        return redirect()->back();
    }
    public function loginUser(LoginRequest $req)
    {
        $data = $req->only([
            'email',
            'password',
        ]);
        $result = Auth::attempt($data);

        if ($result === false) {
            session()->flash('error', 'Sai email hoặc mật khẩu');
            return back();
        }
        // $user = Auth::user();
        return redirect()->route('admin.index');
    }
    public function logout()
    {
        if (Auth::user()->role == 1) {
            Auth::logout();
            return redirect()->route('signin');
        } else {
            Auth::logout();
            return redirect()->back();
        }
    }
}
