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
        $d['sales'] = User::sales()->get();
        $settings = Setting::where(['name' => 'finance-period-start'])
            ->orWhere(['name' => 'finance-period-end'])->get()->keyBy('name');

        $d['from'] = Carbon::create(date('Y'), date('m') - 1, $settings['finance-period-end']->value, 00, 00, 00);
        $d['to'] = Carbon::create(date('Y'), date('m'), $settings['finance-period-start']->value, 00, 00, 00);

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
