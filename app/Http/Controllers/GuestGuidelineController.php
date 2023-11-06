<?php

namespace App\Http\Controllers;

use App\Models\Guideline;
use Illuminate\Http\Request;

class GuestGuidelineController extends Controller
{
    protected $primaryKey = 'guideline_id';

    public function index()
    {
        $guideline = Guideline::with('users')->latest()->paginate(5);
        return view('guest.guideline.index', ['guideline' => $guideline]);
    }

    public function show($guideline_id)
    {
        $guideline = Guideline::findOrFail($guideline_id);
        $guideline->increment('view_count');
        return view('guest.guideline.show', compact('guideline'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $guideline = Guideline::with('users')
                ->where('judul', 'like', "%".$search."%")
                ->orWhere('deskripsi', 'like', "%".$search."%")
                ->paginate(5);
        return view('guest.guideline.search', [
            'guideline' => $guideline,
            'search' => $search
        ]);
    }
}
