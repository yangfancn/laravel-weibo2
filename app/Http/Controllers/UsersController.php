<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
            'email' => $request->name,
            'password' => bcrypt($request->password)
        ]);

        session()->flash('success', '欢迎，您将在这里开始一段新的旅程');

        return redirect(route('users.show', [$user]));
    }

}
