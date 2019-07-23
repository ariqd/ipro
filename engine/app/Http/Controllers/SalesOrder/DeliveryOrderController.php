<?php

namespace App\Http\Controllers\SalesOrder;

use App\Sale;
use App\Branch;
use App\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Delivery_Order;
use App\Delivery_Order_Detail;
use App\Sale_Detail;
use App\Stock;

class DeliveryOrderController extends Controller
{
    public function index()
    {
        //
    }

    public function getForm($id)
    {
        $d['sale'] = Sale::find($id);

        return view('sale.surat-jalan.form-approve', $d);
    }

    public function store(Request $request, $id)
    {
        $counter = Counter::where("name", "=", "DO")->first();
        $branch_id = Auth::user()->branch_id;
        $branch = Branch::find($branch_id);
        $nodo = "DO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $do = Delivery_Order::create([
            "nomor_surat" => $nodo,
            "sales_order_id" => $id,
        ]);
        $countdata = count($request->do);
        for ($i = 0; $i < $countdata; $i++) {
            $id = $request->do[$i];
            $qty_kirim = $request->qty_kirim[$i];
            Delivery_Order_Detail::create([
                "do_id" => $do->id,
                "sales_order_detail_id" => $id,
                "qty_kirim" => $qty_kirim
            ]);

            //
            $detail = Sale_Detail::find($id);
            $detail->qty_kirim += $qty_kirim;
            $detail->save();

            //minus
            $stock = Stock::find($detail->stock_id);
            $stock->quantity -= $qty_kirim;
            $stock->hold -= $qty_kirim;
            $stock->save();
        }

        $counter->counter += 1;
        $counter->save();

        return redirect("sales-orders")->with("info", "Delivery Order Dibuat dengan Nomor $nodo");
    }
}

    // public function postPaymentForm($id, Request $request)
    // {
    //     $counter = Counter::where("name", "=", "SO")->first();
    //     $branch_id = Auth::user()->branch_id;
    //     $branch = Branch::find($branch_id);
    //     $nopo = "SO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

    //     $sale = Sale::find($id);
    //     $sale->no_so = $nopo;
    //     $sale->notes = $request->notes;
    //     $sale->save();

    //     $counter->counter += 1;
    //     $counter->save();

    //     return redirect("sales-orders/check/approve")->with("info", "SO berhasil disetujui");
    // }
