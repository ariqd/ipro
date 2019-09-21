<?php

namespace App\Http\Controllers;

use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $revenue = 0;
        $ton = 0;
        $salefinish = 0;
        $saleunfinish = 0;
        $sale = Sale::all();
        $salebydayf = [];
        $salebydayu = [];
        $countday = [];

        for ($i = 1; $i <= date("t"); $i++) {
            $countday[$i] = $i;
            $salebydayf[$i] = 0;
            $salebydayu[$i] = 0;
        }

        foreach ($sale as $key) {
            $day = date("j", strtotime($key->created_at));
            $flag = 0;
            if ($key->no_so != null) {
                $salefinish++;
                $salebydayf[$day]++;
                $flag = 1;
                $revenue += $key->grand_total + $key->ongkir;
            } else {
                $saleunfinish++;
                $salebydayu[$day]++;
                $flag = 0;
            }

            $key["detail"] = $key->details;
            foreach ($key["detail"] as $value) {
                $value["stock"] = $value->stock;
                $value["stock"]["item"] = $value["stock"]->item;
                if ($flag == 1) {
                    $ton += $value["stock"]["item"]->weight;
                }
            }
        }

        $graph["revenue"] = $revenue;
        $graph["ton"] = $ton / 1000;
        $graph["salefinish"] = $salefinish;
        $graph["saleunfinish"] = $saleunfinish;
        $graph["totalsale"] = $sale->count();
        $graph["countday"] = $countday;
        $graph["salebydayf"] = $salebydayf;
        $graph["salebydayu"] = $salebydayu;

        $graph['salesByDate'] = [];
        $today = Carbon::today();

        for ($i = 0; $i < 5; $i++) {
            $graph['salesByDate'][$today->toDateString()] = Sale::whereDate('created_at', $today)->latest()->get();
            $today->subDay();
        }
        
        return view('dashboard.index', $graph);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
