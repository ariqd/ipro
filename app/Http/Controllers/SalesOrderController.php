<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesOrderController extends Controller
{
    public function index()
    {
//        $d['customers'] = Customer::all();
        return view('sale.index');
    }

    public function create()
    {
        $d['customers'] = Customer::all();
        return view('sale.form', $d);
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
}
