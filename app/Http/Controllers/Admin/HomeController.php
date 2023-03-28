<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class HomeController
{
    public function index()
    {
        return view('home');
    }

    public function profile()
    {

        $user = Auth::user();
        $role = $user->roles->pluck('title', 'id')->toArray();


        if (in_array('Admin', $role)) {
            $user_type = 'Admin';
            $user = User::find(Auth::user()->id);
        } else {
            $user_type = 'User';
            $user = User::find(Auth::user()->id);
        }

        return view('admin.profile', compact('user', 'user_type'));
    }

    public function update_user_profile(Request $request)
    {

        $id = Auth::user()->id;

        $user = Auth::user();

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $id,
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $user->update($request->all());

        if ($user) {
            return redirect()->route('profile')
                ->with('success', 'Profile updated successfully');
        } else {
            return redirect()->route('profile')
                ->with('error', 'Profile Not updated ');
        }

    }

}