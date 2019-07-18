<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingsController extends Controller
{
    public function index() 
    {
        $d['settings'] = Setting::all()->keyBy('name');
        // dd($d);

        return view('settings.index', $d);
    }
}
