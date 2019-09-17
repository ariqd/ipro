<?php

namespace App\Http\Controllers;

use App\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//use Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->role != "admin") {
            $data['customers'] = Customer::mine()->get();
        } else {
            $data['customers'] = Customer::all();
        }

        return view('customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('customer.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'project_owner' => 'required',
            'no_ktp' => 'unique:customers',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
        ], [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validate->fails()) {
            return redirect('customers')->with('error', 'Your data is not complete.')->withErrors($validate->errors())->withInput($input);
        } else {
            $input['user_id'] = Auth::id();
            $customer = Customer::create($input);

            return redirect('customers')->with('info', 'Create customer ' . $customer->project_owner . ' success!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.form', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()->back()->with('info', 'Edit sukses!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     * @throws Exception
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->back()->with('info', 'Hapus sukses!');
    }
}
