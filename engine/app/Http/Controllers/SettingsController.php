<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Carbon\Carbon;

class SettingsController extends Controller
{
    public function index() 
    {
        $d['settings'] = Setting::all()->keyBy('name');
        $d['today'] = Carbon::today();

        return view('settings.index', $d);
    }

    public function update(Request $request) 
    {
        dd($request->all());
    }
}
