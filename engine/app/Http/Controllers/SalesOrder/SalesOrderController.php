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
use App\User;
use App\Stock;

class SalesOrderController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'gudang')
            $d['sales'] = Sale::with(['customer', 'user.branch'])->latest()->get();
        else
            $d['sales'] = Sale::mySales()->with(['customer', 'user.branch'])->latest()->get();

        if (Auth::user()->role == 'finance')
            return redirect('sales-orders/check/approve');

        return view('sale.index', $d);
    }

    public function create()
    {
        $counter = Counter::where("name", "=", "QO")->first();
        $branch_id = Auth::user()->branch_id;
        $d['no_qo'] = "QO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $d['customers'] = Customer::orderBy('created_at', 'desc')->get();
        $d['brands'] = Brand::all();
        $d['branches'] = Branch::all();
        $d['sales'] = User::sales()->get()->except(auth()->id());

        return view('sale.form', $d);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $input['user_id'] = Auth::id();
        if (Auth::user()->role == "admin") {
            $input['user_id'] = Auth::id();
        }
        $sales_order_details = $input['item'];
        unset($input['item']);

        $counter = Counter::where("name", "=", "QO")->first();
        $branch_id = Auth::user()->branch_id;
        $no_po = "QO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $input["quotation_id"] = $no_po;

        $sales_order = Sale::create($input);
        $counter->counter += 1;
        $counter->save();

        foreach ($sales_order_details as $sales_order_detail) {
            $stock = Stock::find($sales_order_detail['stock_id']);
            if ($sales_order_detail['qty'] > $stock->quantity) {
                $sales_order->delete();
                return redirect()->back()->withError('Jumlah pesanan ' . $stock->item->name . ' melebihi jumlah yang tersedia!')->withInput($input);
            }
            $sales_order_detail['sales_order_id'] = $sales_order->id;
            Sale_Detail::create($sales_order_detail);
            $stock->hold += $sales_order_detail['qty'];
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
        $d['branches'] = Branch::all();
        $d['sales'] = User::sales()->get()->except(auth()->id());

        return view('sale.form', $d);
    }

    public function update(Request $request, $id)
    {
        // todo: buat update SO
    }

    public function notaKhusus()
    {
        $counter = Counter::where("name", "=", "QO")->first();
        $branch_id = Auth::user()->branch_id;
        $d['no_qo'] = "";
        $d['customers'] = Customer::orderBy('created_at', 'desc')->get();
        $d['brands'] = Brand::all();
        $d['branches'] = Branch::all();
        $d['sales'] = User::where("role", "like", "%sales%")->get();

        return view('sale.nota-khusus', $d);
    }

    public function notaKhususCreate(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $input['user_id'] = Auth::id();
        if (Auth::user()->role == "admin") {
            $input['user_id'] = Auth::id();
        }
        $sales_order_details = $input['item'];
        unset($input['item']);

        // $counter = Counter::where("name", "=", "QO")->first();
        // $branch_id = Auth::user()->branch_id;
        // $no_po = "QO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $input["quotation_id"] = $request->quotation_id;

        $sales_order = Sale::create($input);
        // $counter->counter += 1;
        // $counter->save();

        foreach ($sales_order_details as $sales_order_detail) {
            $stock = Stock::find($sales_order_detail['stock_id']);
            // if ($sales_order_detail['qty'] > $stock->quantity) {
            //     $sales_order->delete();
            //     return redirect()->back()->withError('Jumlah pesanan ' . $stock->item->name . ' melebihi jumlah yang tersedia!')->withInput($input);
            // }
            $sales_order_detail['sales_order_id'] = $sales_order->id;
            // Sale_Detail::create($sales_order_detail);
            // $stock->hold += $sales_order_detail['qty'];
            // $stock->save();
        }

        return redirect('sales-orders')->with('info', 'Sales Order Created');
    }
}
