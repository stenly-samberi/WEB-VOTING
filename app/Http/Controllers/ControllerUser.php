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
                'name' => 'required',
                'password' => 'required',
            ]);
        
            $credentials = $request->only('name','password');
        
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $userData = ['id_user' => $user->id, 'username' => $user->name];
                $request->session()->put('user_data', $userData);
                return redirect()->intended('dash');
            }
        
            return back()->withErrors([
                'error' => 'username atau password Anda salah.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal login.'.$e->getMessage()]);
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login.index');
    }
}
