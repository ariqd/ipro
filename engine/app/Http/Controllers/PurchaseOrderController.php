<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Branch;
use App\Brand;
use App\Category;
use App\Purchase;
use App\Purchase_Detail;
use App\Counter;
use App\Item;
use App\Sale;
use PDF;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $d["data"] = Purchase::all();
        return view('purchase.index', $d);
    }

    public function create()
    {   //PO/SO Date kodecabang, Cabang, Urut
        //PO 160419 01 BDG 00001
        $counter = Counter::where("name", "=", "PO")->first();
        $branch_id = Auth::user()->branch_id;
        $branch = Branch::find($branch_id);
        $data['brands'] = Brand::all();
        $data['categories'] = Category::all();
        $data['sales'] = Sale::all();
        $data['no_po'] = "PO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        return view('purchase.form', $data);
    }

    public function show($id)
    {
        $d["header"] = Purchase::find($id);
        $d["line"] = $d["header"]->details()->get();
        foreach ($d["line"] as $value) {
            $value["item"] = $value->item()->first();
            $value["item"]["category"] = $value["item"]->category()->first();
            $value["item"]["category"]["brand"] = $value["item"]["category"]->brand()->first();
        }
        return view("purchase.show", $d);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $counter = Counter::where("name", "=", "PO")->first();
        $branch_id = Auth::user()->branch_id;
        $branch = Branch::find($branch_id);
        $nopo = "PO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $item = "item-id";
        $count = count($request->$item);
        $purchase = [
            "purchase_number" => $nopo
        ];
        $purchase = Purchase::create($purchase);
        for ($i = 0; $i < $count; $i++) {
            $itemdetail = Item::find($request->$item[$i]);
            if (!empty($request->sales[$i])) {
                $purchase_detail = [
                    "item_id" => $request->$item[$i],
                    "qty" => $request->qty[$i],
                    "purchase_price" => $itemdetail->purchase_price,
                    "total_price" => $request->qty[$i] * $itemdetail->purchase_price,
                    "purchase_id" => $purchase->id,
                    "sales_id" => $request->sales[$i]
                ];
            } else {
                $purchase_detail = [
                    "item_id" => $request->$item[$i],
                    "qty" => $request->qty[$i],
                    "purchase_price" => $itemdetail->purchase_price,
                    "total_price" => $request->qty[$i] * $itemdetail->purchase_price,
                    "purchase_id" => $purchase->id
                ];
            }
            Purchase_Detail::create($purchase_detail);
        }
        $counter->counter += 1;
        $counter->save();

        return redirect("purchase-orders")->with("info", "PO Berhasil Dibuat Dengan Nomor " . $nopo);
    }

    public function addItems()
    {
        return view('purchase.items');
    }

    public function getCategories($brand_id)
    {
        return response()->json();
    }

    public function approve(Request $request, $id)
    {
        $query = Purchase::find($id);
        $detail = $query->details()->get();
        $count = count($detail);
        foreach ($detail as $value) {
            $i = $value->id;
            $stringqty = "qty-$i";
            $stringapprove = "approve-$i";
            if ($request->has("approve-$i")) {
                if ($request->$stringqty == null) {
                    $value->qty_approval = $value->qty;
                } else {
                    $value->qty_approval = $request->$stringqty;
                }
                $value->approval_finance = 1;
                $value->save();
            } else {
                $value->approval_finance = 0;
                $value->save();
            }
        }
        $query->approval_status = 1;
        $query->save();

        return redirect("purchase-orders")->with("info", "PO dengan nomor $query->purchase_number disetujui");
    }


    public function search(Request $request, $id)
    {
        $query = Purchase::find($id);
        $data["header"] = $query;
        $data["detail"] = $query->details()->get();

        foreach ($data["detail"] as $key) {
            $key["item"] = $key->item()->first();
            $key["category"] = $key["item"]->category()->first();
            $key["brand"] = $key["category"]->brand()->first();
            $key["sales"] = $key->sale()->first();
        }
        return response()->json($data, 200);
    }

    public function printPO($id)
    {
        $data["data"] = Purchase::with("Details.Item.Category.Brand")->find($id);
        // $d["line"] = $d["header"]->details()->get();
        $pdf = PDF::loadview("print.purchase-order", $data);
        return $pdf->download("PO".date("Ymdhis").".pdf");
    }
}
