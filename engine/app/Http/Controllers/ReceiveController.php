<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Receive;
use App\Receive_Detail;
use App\Purchase;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Receive::all();
        foreach ($data as $key) {
            $key["purchase"]=$key->purchase()->first();
        }

        return view("receive.index",["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $d['purchase']=Purchase::where("approval_status","=","1")->get();
        return view("receive.form",$d);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $receive = Receive::create([
            "purchase_id"=>$request->purchaseid,
            "receipt"=>$request->receipt
        ]);

        for ($i=0; $i <count($request->qty) ; $i++) { 
            $data["receive_id"]=$receive->id;
            $data["qty_get"]=$request->qtyget[$i];
            $data["purchase_detail_id"]=$request->purchasedetailid[$i];
            Receive_Detail::create($data);
        }
        return redirect('goods-receive')->with("info","Barang diterima dengan nomor ".$request->receipt);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $header = Receive::find($id);
        $header["PO"] = $header->purchase()->first();
        $line = Receive_Detail::where("receive_id",$id)->get();
        foreach ($line as $key) {
            $key['purchase_details'] = $key->purchaseDetail()->first();
            $key["item"] = $key['purchase_details']->item()->first();
            $key["purchase_details"]['sales'] = $key["purchase_details"]->sale()->first();
            $key["item"]["category"] = $key["item"]->category()->first();
        }
        return view("receive.show",[
            "header"=>$header,
            "line"=>$line
        ]);
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
