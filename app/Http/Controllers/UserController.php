<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập tên.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Đăng ký thành công!');
    }

    // Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $messages = [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ];
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if (Auth::attempt($credentials)) {
            // Lưu lịch sử đăng nhập
            Login::create([
                'user_id' => Auth::id(),
            ]);
            return redirect('/dashboard')->with('success', 'Đăng nhập thành công!');
        }
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng'])->withInput();
    }

    // Dashboard
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalLogins = Login::count();
        return view('dashboard', compact('totalUsers', 'totalLogins'));
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
