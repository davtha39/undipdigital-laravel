<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use File;

class EbookController extends Controller
{
    protected $primaryKey = 'ebook_id';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ebook = Ebook::with('users')->latest()->get();
        return view('dashboard.ebook.index',compact('ebook'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('dashboard.ebook.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'required|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx|max:10240'
        ]);

        $ebook = new Ebook;
        if($request->hasFile('file')) {
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_ebook', $file);        
            $ebook->file = $file;        
            $ebook->ext = $ext;
            $ebook->ukuran = $ukuran;
        }
        else{
            $ebook->file = old('file', $ebook->file);
        }

        $ebook->judul = $request->judul;
        $ebook->deskripsi = $request->deskripsi;
        $ebook->users_id = Auth::user()->users_id;
        $ebook->save();
        
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.ebook.index')
                ->with('succes', 'ebook berhasil ditambahkan ke database');
        }
        else if (Auth::user()->role == 'user') {
            return redirect()->route('user.ebook.index')
                ->with('succes', 'ebook berhasil ditambahkan ke database');
        }
    }

    public function show($ebook_id)
    {
        $ebook = Ebook::findOrFail($ebook_id);
        $ebook->increment('view_count');
        return view('dashboard.ebook.show', compact('ebook'));
    }

    public function edit($ebook_id)
    {
        $ebook = Ebook::findOrFail($ebook_id);
        return view('dashboard.ebook.edit', compact('ebook'));
    }

    public function update(Request $request, $ebook_id)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'nullable|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx|max:10240'
        ]);

        $ebook = Ebook::findOrFail($ebook_id);

        if($request->hasFile('file')) {
            File::delete(public_path('file_ebook/'.$ebook->file));
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_ebook', $file);        
            $ebook->file = $file;        
            $ebook->ext = $ext;
            $ebook->ukuran = $ukuran;
        }
        else{
            $ebook->file = old('file', $ebook->file);
        }

        $ebook->judul = $request->judul;
        $ebook->deskripsi = $request->deskripsi;
        $ebook->save();
        
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.ebook.index')
                ->with('updated', 'ebook berhasil diubah');
        }
        else if (Auth::user()->role == 'user') {
            return redirect()->route('user.ebook.index')
                ->with('updated', 'ebook berhasil diubah');
        }
    }
    
    public function destroy($ebook_id)
    {
        $ebook = Ebook::findOrFail($ebook_id);
        File::delete(public_path('file_ebook/'.$ebook->file));
        $ebook->delete();
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.ebook.index')
            ->with('deleted', 'ebook berhasil dihapus');
        }
        else if (Auth::user()->role == 'user') {
            return redirect()->route('user.ebook.index')
            ->with('deleted', 'ebook berhasil dihapus');
        }
    }

    public function download($ebook_id)
    {
        $ebook = Ebook::findOrFail($ebook_id);
        $fileebook = public_path('file_ebook/'.$ebook->file);
        return Response::download($fileebook);
    }
}
