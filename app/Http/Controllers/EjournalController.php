<?php

namespace App\Http\Controllers;

use App\Models\Ejournal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use File;

class EjournalController extends Controller
{
    protected $primaryKey = 'ejournal_id';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ejournal = Ejournal::with('users')->latest()->get();
        return view('dashboard.ejournal.index',compact('ejournal'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('dashboard.ejournal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'required|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx|max:10240'
        ]);

        $ejournal = new Ejournal;
        if($request->hasFile('file')) {
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_ejournal', $file);        
            $ejournal->file = $file;        
            $ejournal->ext = $ext;
            $ejournal->ukuran = $ukuran;
        }
        else{
            $ejournal->file = old('file', $ejournal->file);
        }

        $ejournal->judul = $request->judul;
        $ejournal->deskripsi = $request->deskripsi;
        $ejournal->users_id = Auth::user()->users_id;
        $ejournal->save();
        
        return redirect()->route('admin.ejournal.index')
            ->with('succes', 'ejournal berhasil ditambahkan ke database');
    }

    public function show($ejournal_id)
    {
        $ejournal = Ejournal::findOrFail($ejournal_id);
        $ejournal->increment('view_count');
        return view('dashboard.ejournal.show', compact('ejournal'));
    }

    public function edit($ejournal_id)
    {
        $ejournal = Ejournal::findOrFail($ejournal_id);
        return view('dashboard.ejournal.edit', compact('ejournal'));
    }

    public function update(Request $request, $ejournal_id)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'nullable|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx|max:10240'
        ]);

        $ejournal = Ejournal::findOrFail($ejournal_id);

        if($request->hasFile('file')) {
            File::delete(public_path('file_ejournal/'.$ejournal->file));
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_ejournal', $file);        
            $ejournal->file = $file;        
            $ejournal->ext = $ext;
            $ejournal->ukuran = $ukuran;
        }
        else{
            $ejournal->file = old('file', $ejournal->file);
        }

        $ejournal->judul = $request->judul;
        $ejournal->deskripsi = $request->deskripsi;
        $ejournal->save();
        
        return redirect()->route('admin.ejournal.index')
            ->with('updated', 'ejournal berhasil diubah');
    }
    
    public function destroy($ejournal_id)
    {
        $ejournal = Ejournal::findOrFail($ejournal_id);
        File::delete(public_path('file_ejournal/'.$ejournal->file));
        $ejournal->delete();
        return redirect()->route('admin.ejournal.index')
            ->with('deleted', 'ejournal berhasil dihapus');
    }

    public function download($ejournal_id)
    {
        $ejournal = Ejournal::findOrFail($ejournal_id);
        $fileejournal = public_path('file_ejournal/'.$ejournal->file);
        return Response::download($fileejournal);
    }
}
