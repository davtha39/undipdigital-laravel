<?php

namespace App\Http\Controllers;

use App\Models\Guideline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use File;

class GuidelineController extends Controller
{
    protected $primaryKey = 'guideline_id';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $guideline = Guideline::with('users')->latest()->get();
        return view('dashboard.guideline.index',compact('guideline'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('dashboard.guideline.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'required|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx|max:10240'
        ]);

        $guideline = new Guideline;
        if($request->hasFile('file')) {
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_guideline', $file);        
            $guideline->file = $file;        
            $guideline->ext = $ext;
            $guideline->ukuran = $ukuran;
        }
        else{
            $guideline->file = old('file', $guideline->file);
        }

        $guideline->judul = $request->judul;
        $guideline->deskripsi = $request->deskripsi;
        $guideline->users_id = Auth::user()->users_id;
        $guideline->save();

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.guideline.index')
                ->with('succes', 'guideline berhasil ditambahkan ke database');
        }
        else if (Auth::user()->role == 'user') {
            return redirect()->route('user.guideline.index')
                ->with('succes', 'guideline berhasil ditambahkan ke database');
        }
    
    }

    public function show($guideline_id)
    {
        $guideline = Guideline::findOrFail($guideline_id);
        $guideline->increment('view_count');
        return view('dashboard.guideline.show', compact('guideline'));
    }

    public function edit($guideline_id)
    {
        $guideline = Guideline::findOrFail($guideline_id);
        return view('dashboard.guideline.edit', compact('guideline'));
    }

    public function update(Request $request, $guideline_id)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'file'=>'nullable|mimes:pdf,docx,doc,ppt,pptx,xls,xlsx|max:10240'
        ]);

        $guideline = Guideline::findOrFail($guideline_id);

        if($request->hasFile('file')) {
            File::delete(public_path('file_guideline/'.$guideline->file));
            $file = request('file')->getClientOriginalName();
            $ext = $request->file('file')->extension();
            $ukuran = $request->file('file')->getSize();
            request()->file('file')->move(public_path() . '/file_guideline', $file);        
            $guideline->file = $file;        
            $guideline->ext = $ext;
            $guideline->ukuran = $ukuran;
        }
        else{
            $guideline->file = old('file', $guideline->file);
        }

        $guideline->judul = $request->judul;
        $guideline->deskripsi = $request->deskripsi;
        $guideline->save();
        
        return redirect()->route('admin.guideline.index')
            ->with('updated', 'guideline berhasil diubah');
    }
    
    public function destroy($guideline_id)
    {
        $guideline = Guideline::findOrFail($guideline_id);
        File::delete(public_path('file_guideline/'.$guideline->file));
        $guideline->delete();
        return redirect()->route('admin.guideline.index')
            ->with('deleted', 'guideline berhasil dihapus');
    }

    public function download($guideline_id)
    {
        $guideline = Guideline::findOrFail($guideline_id);
        $fileguideline = public_path('file_guideline/'.$guideline->file);
        return Response::download($fileguideline);
    }
}
