<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Ejournal;
use App\Models\Pamflet;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminDashboard()
    {
        $totaluser = User::count();
        $totalebook = Ebook::count();
        $totalejournal = Ejournal::count();
        $totalpamflet = Pamflet::count();
        return view('admin.dashboard', compact(
            'totaluser', 
            'totalebook',
            'totalejournal',
            'totalpamflet'
        ));
    }

    public function userDashboard()
    {
        $totalebook = Ebook::count();
        $totalejournal = Ejournal::count();
        $totalpamflet = Pamflet::count();
        return view('user.dashboard', compact( 
            'totalebook',
            'totalejournal',
            'totalpamflet'
        ));
    }
}
