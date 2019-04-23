<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Customer;
use App\Category;
use App\Item;
use App\Sale;
use App\Sale_Detail;
use App\Stock;
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
        $d['customers'] = Customer::all();
        $d['brands'] = Brand::all();
//        $d['categories'] = Category::all();
//        $d['stocks'] = Stock::all();
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

        $sales_order = Sale::create($input);

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
        $query = Sale::where("no_order","=",$id)->first();
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
}
