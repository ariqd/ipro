<?php

namespace App\Http\Controllers\SalesOrder;

use App\Sale;
use App\Branch;
use App\Counter;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class SalesOrderApproveController extends Controller
{
    public function index()
    {
        $d['sales'] = Sale::all();
       // $d['sales'] = Sale::whereNull("no_so")->get();
        // $d['sales'] = Sale::notApproved()->get();

        return view('sale.index', $d);
    }

    public function getPaymentForm($id)
    {
        $d['sale'] = Sale::find($id);
        $d['sale_detail'] = $d['sale']->details()->first();

        return view('sale.form-approve', $d);
    }

    public function postPaymentForm($id, Request $request)
    {
        $sale = Sale::find($id);

        $counter = Counter::where("name", "=", "SO")->first();
        $branch_id = Auth::user()->branch_id;
        $branch = Branch::find($branch_id);
        $nopo = "SO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

        $sale->no_so = $nopo;
        $sale->notes = $request->notes;
        $sale->save();

        $counter->counter += 1;
        $counter->save();
        return redirect()->back()->with("info", "SO berhasil disetujui, <a href='approve/print' class='btn btn-danger'>Print Kwitansi</a>");
    }

    public function makeKwitansi($id)
    {
        $sale = Sale::find($id);
        $customer = $sale->customer;
        $data["terbilang"] = $this->angkaTerbilang($sale->grandtotal + $sale->ongkir);
        $data["project_name"] = $sale->project;
        $data["updated_at"] = $sale->updated_at;
        $data["customer_name"] = $customer->project_owner;
        $data["nominal"] = $sale->grandtotal;
        $data["QO"] = $sale->quotation_id;
        $data["SO"] = $sale->no_so;
        $pdf = PDF::loadView('print.kwitansi',$data);
        return $pdf->stream('invoice.pdf');
    }
}
