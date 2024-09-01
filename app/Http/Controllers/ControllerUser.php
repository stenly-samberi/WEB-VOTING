<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ControllerUser extends Controller
{
    public function index(){
        return view('html.logins');
    }

    public function auth(Request $request){

        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
        
            $credentials = $request->only('username','password');
        
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $userData = ['id_user' => $user->id_user, 'username' => $user->name,'role'=>$user->role];
                $request->session()->put('user_data', $userData);
                return redirect()->intended('dash');
            }
        
            return back()->withErrors([
                'error' => 'Username atau Password Anda salah.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal login.'.$e->getMessage()]);
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
