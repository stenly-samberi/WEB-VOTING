<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Http\Request;

class ControllerRegister extends Controller
{
    public function index(){
        $datajemaat = User::where('role', 'juri')
                          ->orderBy('level', 'asc') // Mengurutkan berdasarkan level dari rendah ke tinggi
                          ->get();
        return view('html.registers', compact('datajemaat'));
    }
    

   public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('html.user_edit', compact('data'));
    }

   public function store(Request $request){

      $request->validate([
         'nama' => 'required|string|max:255',
         'username' => 'required|string|max:255|unique:tbl_user',
         'password' => 'required|string|min:8',
         'level' => 'required|integer|unique:tbl_user',
         'role' => 'required|string|in:admin,juri',
     ]);

     User::create([
         'username' => $request->username,
         'name'     => $request->nama,
         'password' => bcrypt($request->password),
         'level'    => $request->level,
         'img_src'  => "https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png",
         'role'     => $request->role,
     ]);

     return redirect()->back()->with('success', 'Register berhasil disimpan');
   }

   public function update(Request $request, $id)
    {
    
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,juri',
        ]);

        $register = User::findOrFail($id);
        
        $register->name = $request->nama;
        $register->username = $request->username;
        $register->role = $request->role;

        if ($request->password) {
            $register->password = bcrypt($request->password);
        }

        $register->save();

        return redirect()->route('register.index')->with('success', 'Data berhasil diperbarui');
    }

   public function destroy($id)
    {
        $register = User::findOrFail($id);
        $register->delete();

        return redirect()->route('register.index')->with('success', 'Data berhasil dihapus');
    }
}
