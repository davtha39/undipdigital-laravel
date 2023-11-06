<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use File;

class MagazineController extends Controller
{
    protected $primaryKey = 'magazine_id';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $magazine = Magazine::with('users')->latest()->get();
        return view('dashboard.magazine.index',compact('magazine'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('dashboard.magazine.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'required|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx|max:10240'
        ]);

        $magazine = new Magazine;
        if($request->hasFile('file')) {
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_magazine', $file);        
            $magazine->file = $file;        
            $magazine->ext = $ext;
            $magazine->ukuran = $ukuran;
        }
        else{
            $magazine->file = old('file', $magazine->file);
        }

        $magazine->judul = $request->judul;
        $magazine->deskripsi = $request->deskripsi;
        $magazine->users_id = Auth::user()->users_id;
        $magazine->save();

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.magazine.index')
                ->with('succes', 'magazine berhasil ditambahkan ke database');
        }
        else if (Auth::user()->role == 'user') {
            return redirect()->route('user.magazine.index')
                ->with('succes', 'magazine berhasil ditambahkan ke database');
        }
    
    }

    public function show($magazine_id)
    {
        $magazine = Magazine::findOrFail($magazine_id);
        $magazine->increment('view_count');
        return view('dashboard.magazine.show', compact('magazine'));
    }

    public function edit($magazine_id)
    {
        $magazine = Magazine::findOrFail($magazine_id);
        return view('dashboard.magazine.edit', compact('magazine'));
    }

    public function update(Request $request, $magazine_id)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'nullable|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx|max:10240'
        ]);

        $magazine = Magazine::findOrFail($magazine_id);

        if($request->hasFile('file')) {
            File::delete(public_path('file_magazine/'.$magazine->file));
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_magazine', $file);        
            $magazine->file = $file;        
            $magazine->ext = $ext;
            $magazine->ukuran = $ukuran;
        }
        else{
            $magazine->file = old('file', $magazine->file);
        }

        $magazine->judul = $request->judul;
        $magazine->deskripsi = $request->deskripsi;
        $magazine->save();
        
        return redirect()->route('admin.magazine.index')
            ->with('updated', 'magazine berhasil diubah');
    }
    
    public function destroy($magazine_id)
    {
        $magazine = Magazine::findOrFail($magazine_id);
        File::delete(public_path('file_magazine/'.$magazine->file));
        $magazine->delete();
        return redirect()->route('admin.magazine.index')
            ->with('deleted', 'magazine berhasil dihapus');
    }

    public function download($magazine_id)
    {
        $magazine = Magazine::findOrFail($magazine_id);
        $filemagazine = public_path('file_magazine/'.$magazine->file);
        return Response::download($filemagazine);
    }
}
