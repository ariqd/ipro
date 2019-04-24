<?php

namespace App\Http\Controllers\SalesOrder;

use App\Sale;
use App\Branch;
use App\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalesOrderApproveController extends Controller
{
    public function index()
    {
//        $d['sales'] = Sale::whereNull("no_so")->get();
        $d['sales'] = Sale::notApproved()->get();

        return view('sale.index', $d);
    }

    public function getPaymentForm($id)
    {
        $d['sale'] = Sale::find($id);
        $d['sale_detail'] = $d['sale']->details()->first();

        return view('sale.formapprove', $d);
    }

    public function insert($id, Request $request)
    {
        $counter = Counter::where("name", "=", "SO")->first();
        $branch_id = Auth::user()->branch_id;
        $branch = Branch::find($branch_id);
        $nopo = "SO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

        $sale = Sale::find($id);
        $sale->no_so = $nopo;
        $sale->notes = $request->notes;
        $sale->save();

        $counter->counter += 1;
        $counter->save();

        return redirect("sales-orders/check/approve")->with("info", "SO berhasil disetujui");
    }
}
