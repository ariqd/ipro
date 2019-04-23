<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Branch;
use App\Customer;
use App\Category;
use App\Item;
use App\Sale;
use App\Sale_Detail;
use App\Stock;
use App\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesOrderController extends Controller
{
    public function index()
    {
//        $d['customers'] = Customer::all();
        $d['sales'] = Sale::all();

        return view('sale.index', $d);
    }

    public function create()
    {
      $counter = Counter::where("name","=","QO")->first();
      $branch_id = Auth::user()->branch_id;
      $branch = Branch::find($branch_id);
      $data['no_po'] = "QO".date("ymd").str_pad($branch_id, 2, 0, STR_PAD_LEFT).str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
      $d['customers'] = Customer::all();
      $d['brands'] = Brand::all();

      return view('sale.form', $d);
  }

  public function store(Request $request)
  {
//        $subtotal = 0;
    $input = $request->all();
    unset($input['_token']);

    $input['user_id'] = Auth::id();
    $sales_order_details = $input['item'];
    unset($input['item']);
    $counter = Counter::where("name","=","QO")->first();
    $branch_id = Auth::user()->branch_id;
    $branch = Branch::find($branch_id);
    $no_po = "QO".date("ymd").str_pad($branch_id, 2, 0, STR_PAD_LEFT).str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
    $input["quotation_id"]=$nopo;
    $sales_order = Sale::create($input);
    $counter->counter +=1;
    $counter->save();
    foreach ($sales_order_details as $sales_order_detail) {
        $sales_order_detail['sales_order_id'] = $sales_order->id;
        Sale_Detail::create($sales_order_detail);
    }

    return redirect('sales-orders')->with('info', 'Sales Order Created');

}

public function createCustomer()
{
    return view('sale.create-customer');
}

public function insertCustomer(Request $request)
{
    $input = $request->all();
    unset($input['_token']);

    $input['user_id'] = Auth::id();
//        dd($request->all());
    $customer = Customer::create($input);

    return redirect('sales-orders/create')->with('info', 'Customer created!');
}

public function getCustomer($id)
{
    $fill = Customer::find($id);

    return response()->json([
        'success' => true,
        'fill' => $fill
    ]);
}

public function getCategories($brand_id)
{
    $categories = Category::where('brand_id', '=', $brand_id);

    return response()->json([
        'categories' => $categories
    ]);
}

public function searchStocks()
{
    $category_id = request()->get('category_id');

    $stocks = Stock::with('item')
    ->whereHas('item', function ($query) use ($category_id) {
        $query->where('category_id', '=', $category_id);
    })->tap(function ($query) {
        Auth::user()->role == 'admin' ?: $query->where('branch_id', '=', Auth::user()->branch_id);
    });

    return response()->json($stocks->get(), 200);
}

public function show($id)
{
    $d['sale'] = Sale::find($id);

    return view('sale.show', $d);
}

public function edit($id)
{
    $d['isEdit'] = TRUE;
    $d['sale'] = Sale::find($id);
    $d['customers'] = Customer::all();
    $d['brands'] = Brand::all();

    return view('sale.form', $d);
}

public function update(Request $request, $id)
{

}

public function searchDetailSO($id)
{
    $query = Sale::where("no_so","=",$id)->first();
    $data["header"]=$query;
    $data["detail"] = $query->details()->get();
    foreach ($data["detail"] as $key) {
        $key["stock"]=$key->stock()->first();
        $key["item"]= $key["stock"]->item()->first();
        $key["category"]= $key["item"]->category()->first();
        $key["brand"]=$key["category"]->brand()->first();

            // $key->stock;
            // $key->item;
            // $key->category;
            // $key->brand;
    }
    return response()->json($data, 200);
}

public function searchApprove($id)
{
    $query = Sale::where("no_so","=",$id)->first();
    $data["header"]=$query;
    $data["detail"] = $query->details()->get();
    foreach ($data["detail"] as $key) {
        $key["stock"]=$key->stock()->first();
        $key["item"]= $key["stock"]->item()->first();
        $key["category"]= $key["item"]->category()->first();
        $key["brand"]=$key["category"]->brand()->first();

            // $key->stock;
            // $key->item;
            // $key->category;
            // $key->brand;
    }
    return response()->json($data, 200);
}

public function unapprovedList()
{
//        $d['customers'] = Customer::all();
    $d['sales'] = Sale::whereNull("no_so")->get();
    return view('sale.index', $d);
}

public function getPaymentForm($id)
{
    $d['sale'] = Sale::find($id);
    $d['sale_detail'] = $d['sale']->details()->first();
    return view('sale.formapprove',$d);
}

public function postPaymentForm($id, Request $request)
{
    $counter = Counter::where("name","=","SO")->first();
    $branch_id = Auth::user()->branch_id;
    $branch = Branch::find($branch_id);
    $nopo = "SO".date("ymd").str_pad($branch_id, 2, 0, STR_PAD_LEFT).str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

    $sale = Sale::find($id);
    $sale->no_so = $nopo;
    $sale->notes = $request->notes;
    $sale->save();

    $counter->counter +=1;
    $counter->save();

    return redirect("sales-orders/check/approve")->with("info","SO berhasil disetujui");
}
}
