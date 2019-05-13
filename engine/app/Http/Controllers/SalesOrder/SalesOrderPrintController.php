<?php

namespace App\Http\Controllers\SalesOrder;

use Illuminate\Support\Facades\App;
use PDF;
use App\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesOrderPrintController extends Controller
{
    public function makeQuotation($id)
    {
//        // Fetch sales order from database
       // $data = Sale::find($id);
////        dd($data);
//
//        // Send data to the view using loadView function of PDF facade
//        $pdf = PDF::loadView('print.kwitansi', compact('data'));
//
//        // Finally, download the file using download function
//        return $pdf->download('sales-order_quotation_' . date('Y-m-d') . '.pdf');

//        $pdf = App::make('dompdf.wrapper');
//        $pdf->loadHTML('<h1>Test</h1>');
//        return $pdf->stream();
        $data = Sale::find($id);
        $pdf = PDF::loadView('print.kwitansi', ['sale' => $data]);
        return $pdf->download('invoice.pdf');
    }


    public function makeInvoice($id, Request $request)
    {
//        // Fetch sales order from database
       // $data = Sale::find($id);
////        dd($data);
//
//        // Send data to the view using loadView function of PDF facade
//        $pdf = PDF::loadView('print.kwitansi', compact('data'));
//
//        // Finally, download the file using download function
//        return $pdf->download('sales-order_quotation_' . date('Y-m-d') . '.pdf');

//        $pdf = App::make('dompdf.wrapper');
//        $pdf->loadHTML('<h1>Test</h1>');
//        return $pdf->stream();
        $data = Sale::find($id);
        $data["user"] = $data->user;
        $data["detail"] = $data->details;
        if($request->has("markup")){
            $data["markup"] = 0;
        }else{
            $data["markup"] = 1;
        }
        foreach ($data["detail"] as $key) {
            $key["stock"]= $key->stock;
            $key["stock"]["item"]= $key["stock"]->item;
        }
        $pdf = PDF::loadView('print.sales-order', ['sale' => $data]);
        return $pdf->download('invoice.pdf');
    }
}
