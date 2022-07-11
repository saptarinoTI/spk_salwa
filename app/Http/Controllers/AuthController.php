<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('app.index');
        }
        return view('home.login');
    }

    public function cekLogin(Request $request)
    {
        $request->validate([
            "username" => "required",
            "password" => "required",
        ]);

        $credentials = [
            'username' => $request['username'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('app.index');
        }
        return redirect()->route('login')->withFail('');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userRegister()
    {
        $users = User::where('role', '!=', 'superadmin')->get();
        return view('user.index', compact('users'));
    }

    public function userRegisterCreate()
    {
        return view('user.create');
    }

    public function userRegisterStore(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'nama' => 'required',
            'role' => 'required|in:admin,manager',
        ]);

        $users = new User();
        $users->username = strtolower(htmlspecialchars($request->username));
        $users->password = Hash::make($users->username . '123');
        $users->nama = strtolower(htmlspecialchars($request->nama));
        $users->role = strtolower(htmlspecialchars($request->role));
        $users->save();

        return redirect()->route('user.index');
    }

    public function userRegisterDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
