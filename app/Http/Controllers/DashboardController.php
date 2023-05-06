<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itemtype;

class DashboardController extends Controller
{
    public function index()
    {
        $itemtype = Itemtype::where('store',session('store'))->get();

        return view('pages.dashboard',compact('itemtype'));
    }
}
