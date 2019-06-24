<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Branch;
use Illuminate\Http\Response;
use DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // SELECT users.branch_id, count(sales_orders.id) FROM `sales_orders` join users on sales_orders.user_id = users.id GROUP BY users.branch_id 
        $branches = Branch::all();
        $datapenjualankota = Sale::select(DB::raw('count(sales_orders.id) as y, branches.name as x'))
        ->join("users","users.id","=","sales_orders.user_id")
        ->join("branches","branches.id","=","users.branch_id")
        ->groupby("branches.name")->get();

        $revenue = 0;
        $ton = 0;
        $salefinish = 0;
        $saleunfinish = 0;
        $totalsale = 0;
        $month = date("m");
        $year = date("Y");
        if($request->has("month")){
            $month = $request->month;
        }
        if($request->has("year")){
            $year = $request->year;
        }

        $dateString = $year."-".$month."-"."01";
        $namemonth = date("F",strtotime($dateString));
        $sale = Sale::wheremonth('created_at', $month)->whereyear('created_at', $year)->get();
        // $salecity = Sale::leftjoin("user", "user.id", "sale.user_id")->where("user.branch_id",$branch_id)wheremonth('created_at', $month)->whereyear('created_at', $year)->get();

        $salebydayf = array();
        $salebydayu = array();
        $countday = array();
        //init
        for ($i = 1; $i <= date("t", strtotime($dateString)); $i++) {
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

        $totalsale = count($sale);
        // dd($d);
        $graph["branches"] = $branches;
        $graph["monthname"] = $namemonth;
        $graph["month"] = $month;
        $graph["year"] = $year;
        $graph["revenue"] = $revenue;
        $graph["ton"] = $ton / 1000;
        $graph["salefinish"] = $salefinish;
        $graph["saleunfinish"] = $saleunfinish;
        $graph["totalsale"] = $totalsale;
        $graph["countday"] = $countday;
        $graph["salebydayf"] = $salebydayf;
        $graph["salebydayu"] = $salebydayu;
        $graph["bar"] = $datapenjualankota;
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
