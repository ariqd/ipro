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
        $d["data"] = Purchase::latest()->with('details')->get();

        return view('purchase.index', $d);
    }

    public function create()
    {
        $counter = Counter::PO();
        $data['brands'] = Brand::all();
        $data['categories'] = Category::all();
        $data['sales'] = Sale::latest()->get();
        $data['no_po'] = "PO" . date("ymd") . str_pad(auth()->user()->branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

        return view('purchase.form', $data);
    }

    public function show($id)
    {
        $d["header"] = Purchase::find($id);
        $d["line"] = $d["header"]->details()->get();
        $d['total_amount'] = 0;
        $d['total_weight'] = 0;
        $d['total_qty'] = 0;
        $d['total_qty_approved'] = 0;
        foreach ($d["line"] as $value) {
            $value["item"] = $value->item()->first();
            $value["item"]["category"] = $value["item"]->category()->first();
            $value["item"]["category"]["brand"] = $value["item"]["category"]->brand()->first();

            $d['total_weight'] += $value->item->weight;
            $d['total_qty'] += $value->qty;
            $d['total_qty_approved'] += $value->qty_approval;
            $d['total_amount'] += $value->total_price;
        }

        return view("purchase.show", $d);
    }

    public function store(Request $request)
    {
        $counter = Counter::where("name", "=", "PO")->first();
        $branch_id = Auth::user()->branch_id;
        $nopo = "PO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $item = "item-id";
        $count = count($request->$item);
        $purchase = [
            "purchase_number" => $nopo
        ];
        $purchase = Purchase::create($purchase);
        for ($i = 0; $i < $count; $i++) {
            if (!empty($request->sales[$i])) {
                $purchase_detail = [
                    "item_id" => $request->$item[$i],
                    "qty" => $request->qty[$i],
                    "purchase_price" => $request->modal[$i],
                    "total_price" => $request->qty[$i] * $request->modal[$i],
                    "purchase_id" => $purchase->id,
                    "sales_id" => $request->sales[$i]
                ];
            } else {
                $purchase_detail = [
                    "item_id" => $request->$item[$i],
                    "qty" => $request->qty[$i],
                    "purchase_price" => $request->modal[$i],
                    "total_price" => $request->qty[$i] * $request->modal[$i],
                    "purchase_id" => $purchase->id
                ];
            }
            
            $purchase_item = Purchase_Detail::create($purchase_detail);
            $item = $purchase_item->item;
            $item->po_price = $purchase_item->purchase_price;
            $item->save();
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
        $purchase_order = Purchase::find($id);

        foreach ($purchase_order->details as $value) {
            $i = $value->id;
            $stringqty = "qty-$i";
            if ($request->has("approve-$i")) {
                if ($request->$stringqty == null) {
                    $value->qty_approval = $value->qty;
                } else {
                    $value->qty_approval = $request->$stringqty;
                }
                $value->approval_finance = 1;
            } else {
                $value->qty_approval = 0;
                $value->approval_finance = 0;
            }
            $value->save();
        }

        $approvedItems = $purchase_order->details()->approved()->count();
        $purchase_order->approval_status = $approvedItems <= 0 ? false : true;
        $purchase_order->save();

        return redirect("purchase-orders")->with("info", "PO dengan nomor $purchase_order->purchase_number disetujui");
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
        return $pdf->download("PO" . date("Ymdhis") . ".pdf");
    }

    public function printMemoPengambilanProduk($id)
    {
        $header = Purchase::find($id);
        $line = Purchase_Detail::with("sale", "item.category.brand")->where("purchase_id", $id)->get();
        // foreach ($line as $key) {
        //     $key["item"] = $key->item()->first();
        //     $key["purchase_details"]['sales'] = $key->sale()->first();
        //     $key["item"]["category"] = $key["item"]->category()->first();
        //     $key["item"]["brand"] = $key["item"]["category"]->brand()->first();
        // }
        // $d["line"] = $d["header"]->details()->get();
        $pdf = PDF::loadview("print.memo", [
            "header" => $header,
            "line" => $line
        ]);
        return $pdf->download("Memo" . date("Ymdhis") . ".pdf");
    }
}
