<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale = Sale::whereNull("no_so")->get();
        $d["unfinished"] = count($sale);
        return view('home', $d);
    }
}
