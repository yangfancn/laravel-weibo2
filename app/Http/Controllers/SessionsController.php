<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:225',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->activated) {
                session()->flash('success', '欢迎回来!');
                return redirect()->intended(route('users.show', Auth::user()));
            } else {
                Auth::logout();
                session()->flash('warning', '您的账号尚未激活，请到邮箱中查看激活邮件！');
                return redirect()->route('home');
            }

        } else {
            session()->flash('danger', '账号与密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    public function destory()
    {
        Auth::logout();
        session()->flash('success', '退出成功');
        return redirect('login');
    }
}
