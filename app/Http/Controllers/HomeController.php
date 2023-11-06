<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guideline;
use App\Models\Magazine;
use App\Models\Ebook;
use App\Models\Pamflet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $guideline = Guideline::with('users')->latest()->take(3)->get();
        $magazine = Magazine::with('users')->latest()->take(3)->get();
        $ebook = Ebook::with('users')->latest()->take(3)->get();
        $pamflet = Pamflet::with('users')->latest()->take(3)->get();
        return view('guest.home', compact(
            'guideline',
            'magazine',
            'ebook',
            'pamflet'
        ));
    }
    
    // public function search(Request $request)
    // {
    //     $search = $request->search;
    //     $ebook = Ebook::query()
    //                 ->whereHas('')
        
    //     with('users')
    //             ->where('judul', 'like', "%".$search."%")
    //             ->orWhere('deskripsi', 'like', "%".$search."%")
    //             ->paginate(5);
    //     return view('guest.ebook.search', [
    //         'ebook' => $ebook,
    //         'search' => $search
    //     ]);
    // }
}
