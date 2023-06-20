<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use  App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
       return view('admin.auth.login');
    }

    public function Login(LoginRequest $request)
    {
        $data = $request->only('email','password');
        $user = User::where('email',$data['email'])->whereIn('actor',['0','1'])->first();
        if(Hash::check($data['password'],$user->password))
        {
            Auth::attempt($data);
            return redirect()->route('admin.dashboard')->with('success','Welcome..');
        }
        return redirect()->route('admin.login')->with('danger','Please check your credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')
            ->with('success','You have logged out successfully!');;
    }
}
