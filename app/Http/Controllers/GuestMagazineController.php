<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;

class GuestMagazineController extends Controller
{
    protected $primaryKey = 'magazine_id';

    public function index()
    {
        $magazine = Magazine::with('users')->latest()->paginate(5);
        return view('guest.magazine.index', ['magazine' => $magazine]);
    }

    public function show($magazine_id)
    {
        $magazine = Magazine::findOrFail($magazine_id);
        $magazine->increment('view_count');
        return view('guest.magazine.show', compact('magazine'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $magazine = Magazine::with('users')
                ->where('judul', 'like', "%".$search."%")
                ->orWhere('deskripsi', 'like', "%".$search."%")
                ->paginate(5);
        return view('guest.magazine.search', [
            'magazine' => $magazine,
            'search' => $search
        ]);
    }
}
