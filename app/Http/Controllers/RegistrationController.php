<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{

    public function viewRegister()
    {
        return view('register');
    }


    public function register(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User();
        $user->password = Hash::make($req->password);
        $user->email = $req->email;
        $user->name = $req->name;
        $user->save();

        auth()->login($user);
        return redirect()->to('/');
    }
}
