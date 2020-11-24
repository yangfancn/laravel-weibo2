<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index']
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
        return view('users.show', compact('user'));
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

        Auth::login($user);

        session()->flash('success', '欢迎，您将在这里开始一段新的旅程');

        return redirect(route('users.show', [$user]));
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

}
