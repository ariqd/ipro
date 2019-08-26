<?php

namespace App\Http\Controllers\SalesOrder;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'project_owner' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('sales-orders/create')
                ->with('error', 'Data customer yang dibutuhkan belum terisi seluruhnya!')
                ->withErrors($validator)
                ->withInput();
        }

        $input['user_id'] = Auth::id();
        $customer = Customer::create($input);

        return redirect('sales-orders/create')
            ->withInfo('Customer ' . $customer->project_owner . ' berhasil dibuat! Silahkan pilih Customer di kolom Customer');
    }
}
