<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestPamfletController extends Controller
{
    protected $primaryKey = 'pamflet_id';

    public function index()
    {
        $pamflet = Pamflet::with('users')->latest()->paginate(5);
        return view('guest.pamflet.index', ['pamflet' => $pamflet]);
    }

    public function show($pamflet_id)
    {
        $pamflet = Pamflet::findOrFail($pamflet_id);
        $pamflet->increment('view_count');
        return view('guest.pamflet.show', compact('pamflet'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $pamflet = Pamflet::with('users')
                ->where('judul', 'like', "%".$search."%")
                ->orWhere('deskripsi', 'like', "%".$search."%")
                ->paginate(5);
        return view('guest.pamflet.search', [
            'pamflet' => $pamflet,
            'search' => $search
        ]);
    }
}
