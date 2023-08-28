<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use File;

class UserController extends Controller
{
    protected $primaryKey = 'users_id';

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $user = User::where('role', 'user')->get();
        return view('admin.user.index',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8',
            'foto'=>'nullable|image|mimes:png,jpg,jpeg,webp',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        if ($request->hasFile('foto')){
            $foto = request('foto')->getClientOriginalName();
            request()->file('foto')->move(public_path() . '/foto_user', $foto);
            $user->foto = $foto;
        }
        $user->save();
        return redirect()->route('admin.user.index')
        ->with('succes', 'Data user berhasil ditambahkan ke database');
    }

    public function edit($users_id)
    {
        $user = User::findOrFail($users_id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $users_id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'nullable|min:8',
            'foto'=>'nullable|image|mimes:png,jpg,jpeg,webp',
        ]);

        $user = User::findOrFail($users_id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        // $user->role = 'user';
        if ($request->hasFile('foto')){
            $foto = request('foto')->getClientOriginalName();
            request()->file('foto')->move(public_path() . '/foto_user', $foto);
            $user->foto = $foto;
        }
        $user->save();
        return redirect()->route('admin.user.index')
        ->with('succes', 'Data user berhasil ditambahkan ke database');
    }

    public function destroy($users_id)
    {
        $user = User::findOrFail($users_id);
        File::delete(public_path('foto_user/'.$user->foto));
        $user->delete();
        return redirect()->route('admin.user.index')
        ->with('deleted', 'Data User berhasil dihapus');
    }
}
