<?php

namespace App\Http\Controllers\SalesOrder;

use App\Counter;
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
        $customer = $data->customer;
        $data["terbilang"] = $this->angkaTerbilang($data->grand_total + $data->ongkir);
        $data["project_name"] = $data->project;
        $data["updated_at"] = $data->updated_at;
        $data["customer_name"] = $customer->project_owner;
        $data["nominal"] = $data->grand_total + $data->ongkir;
        $data["QO"] = $data->quotation_id;
        $data["SO"] = $data->no_so;
        $pdf = PDF::loadView('print.kwitansi', $data);
        return $pdf->download('invoice.pdf');
    }


    public function makeSO($id, Request $request)
    {
        $data = Sale::find($id);
        $data["user"] = $data->user;
        $data["detail"] = $data->details;
        // $this->angkaTerbilang();
        if ($request->has("markup")) {
            $data["markup"] = 1;
        } else {
            $data["markup"] = 0;
        }
        foreach ($data["detail"] as $key) {
            $key["stock"] = $key->stock;
            $key["stock"]["item"] = $key["stock"]->item;
        }

        $pdf = PDF::loadView('print.sales-order', ['sale' => $data]);
        return $pdf->download('invoice.pdf');
    }


    public function makeInvoice($id, Request $request)
    {
        $data = Sale::find($id);
        $counter = Counter::where("name","=","INV")->first();
        $roman = $this->romanNumber(date("m"));
        $inv = $counter->counter."/".$counter->name."/".$roman;
        $data["nomor"] = $data->user;
        $data["user"] = $data->user;
        $data["detail"] = $data->details;
        $data["customer"] = $data->customer;
        $data["inv"] = $inv;
        $counter->counter +=1;
        $counter->save();
        // $this->angkaTerbilang();
        if ($request->has("markup")) {
            $data["markup"] = 0;
        } else {
            $data["markup"] = 1;
        }
        foreach ($data["detail"] as $key) {
            $key["stock"] = $key->stock;
            $key["stock"]["item"] = $key["stock"]->item;
            $key["stock"]["item"]["category"] = $key["stock"]["item"]->category;
            $key["stock"]["item"]["brand"] = $key["stock"]["item"]["category"]->brand;
        }
        $pdf = PDF::loadView('print.invoice', ['sale' => $data]);
        return $pdf->download('invoice.pdf');
    }
}
