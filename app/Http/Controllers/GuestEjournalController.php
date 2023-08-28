<?php

namespace App\Http\Controllers;

use App\Models\Ejournal;
use Illuminate\Http\Request;

class GuestEjournalController extends Controller
{
    protected $primaryKey = 'ejournal_id';

    public function index()
    {
        $ejournal = Ejournal::with('users')->latest()->paginate(5);
        return view('guest.ejournal.index', ['ejournal' => $ejournal]);
    }

    public function show($ejournal_id)
    {
        $ejournal = Ejournal::findOrFail($ejournal_id);
        $ejournal->increment('view_count');
        return view('guest.ejournal.show', compact('ejournal'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $ejournal = Ejournal::with('users')
                ->where('judul', 'like', "%".$search."%")
                ->orWhere('deskripsi', 'like', "%".$search."%")
                ->paginate(5);
        return view('guest.ejournal.search', [
            'ejournal' => $ejournal,
            'search' => $search
        ]);
    }
}
