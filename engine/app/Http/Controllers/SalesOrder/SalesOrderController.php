<?php

namespace App\Http\Controllers\SalesOrder;

use App\Branch;
use App\Brand;
use App\Counter;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Sale;
use App\Sale_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesOrderController extends Controller
{
    public function index()
    {
        $d['sales'] = Sale::all();

        return view('sale.index', $d);
    }

    public function create()
    {
        $counter = Counter::where("name", "=", "QO")->first();
        $branch_id = Auth::user()->branch_id;
        $d['no_qo'] = "QO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $d['customers'] = Customer::all();
        $d['brands'] = Brand::all();
        $d['branches'] = Branch::all();

        return view('sale.form', $d);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $input['user_id'] = Auth::id();
        $sales_order_details = $input['item'];
        unset($input['item']);

        $counter = Counter::where("name", "=", "QO")->first();
        $branch_id = Auth::user()->branch_id;
        $branch = Branch::find($branch_id);
        $no_po = "QO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $input["quotation_id"] = $no_po;
        //                dd($input);

        $sales_order = Sale::create($input);
        $counter->counter += 1;
        $counter->save();

        foreach ($sales_order_details as $sales_order_detail) {
            $sales_order_detail['sales_order_id'] = $sales_order->id;
            Sale_Detail::create($sales_order_detail);
            $stock = Stock::find($sales_order_detail->stock_id);
            // $stock->pesenan += $sales_order_detail->quantity;
            $stock->save();
        }

        return redirect('sales-orders')->with('info', 'Sales Order Created');
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
        // todo: buat update SO
    }
}
