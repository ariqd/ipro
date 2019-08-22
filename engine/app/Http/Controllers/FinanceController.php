<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setting;
use Carbon\Carbon;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = 1;
        $month =date("n")-1;
        $day = 15;
        if($day < 15){
            $month--;
        }
        $monthmoduloberjalan = $month - ($month % $setting);
        $monthmodulosisa = $monthmoduloberjalan + $setting;


        $d['sales'] = User::sales()->get();
        $settings = Setting::where(['name' => 'finance-period-start'])
            ->orWhere(['name' => 'finance-period-end'])->get()->keyBy('name');
        $d['from'] = date("d F",mktime(0, 0, 0, $monthmoduloberjalan+1  , 15, date("Y")));
        $d['to'] = date("d F",mktime(0, 0, 0, $monthmodulosisa+1, 14, date("Y")));

        // dd($d);

        return view('finance.index', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
