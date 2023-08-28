<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use File;

class ProfileController extends Controller
{
    public function __invoke()
    {
        // Controller logic here
    }
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'nullable',
            'foto'=>'nullable|image|mimes:png,jpg,jpeg,webp',
        ]);

        $user = Auth::user();
        if ($request->hasFile('foto')) {
            File::delete(public_path('foto_user/'.$user->foto)); 
            $foto = request('foto')->getClientOriginalName();
            request()->file('foto')->move(public_path() . '/foto_user', $foto);
            $user->foto = $foto;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.profile.index')->with('succes', 'Profile berhasil diupdate');
    }
}
