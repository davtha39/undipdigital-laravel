<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guideline;
use App\Models\Magazine;
use App\Models\Ebook;
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
        $totalguideline = Guideline::count();
        $totalmagazine = Magazine::count();
        $totalebook = Ebook::count();
        $totalpamflet = Pamflet::count();
        return view('admin.dashboard', compact(
            'totaluser', 
            'totalguideline',
            'totalmagazine',
            'totalebook',
            'totalpamflet'
        ));
    }

    public function userDashboard()
    {
        $totalguideline = Guideline::count();
        $totalmagazine = Magazine::count();
        $totalebook = Ebook::count();
        $totalpamflet = Pamflet::count();
        return view('user.dashboard', compact( 
            'totalguideline',
            'totalmagazine',
            'totalebook',
            'totalpamflet'
        ));
    }
}
