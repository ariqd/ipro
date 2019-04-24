<?php

namespace App\Http\Controllers\SalesOrder;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalesOrderCustomerController extends Controller
{
    public function index($id)
    {
        $fill = Customer::find($id);

        return response()->json([
            'success' => true,
            'fill' => $fill
        ]);
    }

    public function create()
    {
        return view('sale.create-customer');
    }

    public function insert(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $input['user_id'] = Auth::id();
        $customer = Customer::create($input);

        return redirect('sales-orders/create')->with('info', 'Customer ' . $customer->project_owner . 'created!');
    }
}
