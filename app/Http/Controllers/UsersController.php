<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        $statuses = $user->statuses()->orderByDesc('created_at')->paginate(10);
        return view('users.show', compact('user', 'statuses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:50|min:3',
            'email' => 'required|unique:users|email|max:225',
            'password' => 'required|confirmed|max:225|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $this->sendEmailConfirmationTo($user);

        session()->flash('success', '请到邮箱中完成验证');

        return redirect(route('users.show', [$user]));
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = '感谢注册Weibo App,请完成验证';

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|unique:users|max:50|min:3',
            'password' => 'nullable|confirmed|max:225|min:6'
        ]);

        $data = [
            'name' => $request->name,
        ];
        if($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);
        session()->flash('success', '个人资料编辑成功');
        return redirect()->route('users.show', $user->id);

    }

    public function destroy(User $user)
    {
        $this->authorize('destory', $user);

        $user->delete();

        session()->flash('success', "删除用户[$user->name] 成功！");
        return redirect()->back();
    }


    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '激活成功');
        return redirect()->route('users.show', $user->id);
    }
}
