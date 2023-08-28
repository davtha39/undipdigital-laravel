<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;

class GuestEbookController extends Controller
{
    protected $primaryKey = 'ebook_id';

    public function index()
    {
        $ebook = Ebook::with('users')->latest()->paginate(5);
        return view('guest.ebook.index', ['ebook' => $ebook]);
    }

    public function show($ebook_id)
    {
        $ebook = Ebook::findOrFail($ebook_id);
        $ebook->increment('view_count');
        return view('guest.ebook.show', compact('ebook'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $ebook = Ebook::with('users')
                ->where('judul', 'like', "%".$search."%")
                ->orWhere('deskripsi', 'like', "%".$search."%")
                ->paginate(5);
        return view('guest.ebook.search', [
            'ebook' => $ebook,
            'search' => $search
        ]);
    }
}
