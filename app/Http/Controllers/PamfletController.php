<?php

namespace App\Http\Controllers;

use App\Models\Pamflet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use File;

class PamfletController extends Controller
{
    protected $primaryKey = 'pamflet_id';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pamflet = Pamflet::with('users')->latest()->get();
        return view('dashboard.pamflet.index',compact('pamflet'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('dashboard.pamflet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'required|mimes:pdf,docx,doc,ppt,pptx,jpg,jpeg,png,bmp|max:10240'
        ]);

        $pamflet = new Pamflet;
        if($request->hasFile('file')) {
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_pamflet', $file);        
            $pamflet->file = $file;        
            $pamflet->ext = $ext;
            $pamflet->ukuran = $ukuran;
        }
        else{
            $pamflet->file = old('file', $pamflet->file);
        }

        $pamflet->judul = $request->judul;
        $pamflet->deskripsi = $request->deskripsi;
        $pamflet->users_id = Auth::user()->users_id;
        $pamflet->save();
        
        return redirect()->route('admin.pamflet.index')
            ->with('succes', 'pamflet berhasil ditambahkan ke database');
    }

    public function show($pamflet_id)
    {
        $pamflet = Pamflet::findOrFail($pamflet_id);
        $pamflet->increment('view_count');
        return view('dashboard.pamflet.show', compact('pamflet'));
    }

    public function edit($pamflet_id)
    {
        $pamflet = Pamflet::findOrFail($pamflet_id);
        return view('dashboard.pamflet.edit', compact('pamflet'));
    }

    public function update(Request $request, $pamflet_id)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'nullable|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx,jpg,jpeg,png,bmp|max:10240'
        ]);

        $pamflet = Pamflet::findOrFail($pamflet_id);

        if($request->hasFile('file')) {
            File::delete(public_path('file_pamflet/'.$pamflet->file));
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_pamflet', $file);        
            $pamflet->file = $file;        
            $pamflet->ext = $ext;
            $pamflet->ukuran = $ukuran;
        }
        else{
            $pamflet->file = old('file', $pamflet->file);
        }

        $pamflet->judul = $request->judul;
        $pamflet->deskripsi = $request->deskripsi;
        $pamflet->save();
        
        return redirect()->route('admin.pamflet.index')
            ->with('updated', 'pamflet berhasil diubah');
    }
    
    public function destroy($pamflet_id)
    {
        $pamflet = Pamflet::findOrFail($pamflet_id);
        File::delete(public_path('file_pamflet/'.$pamflet->file));
        $pamflet->delete();
        return redirect()->route('admin.pamflet.index')
            ->with('deleted', 'pamflet berhasil dihapus');
    }

    public function download($pamflet_id)
    {
        $pamflet = Pamflet::findOrFail($pamflet_id);
        $filepamflet = public_path('file_pamflet/'.$pamflet->file);
        return Response::download($filepamflet);
    }
}
