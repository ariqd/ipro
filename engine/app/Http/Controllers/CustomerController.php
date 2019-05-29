<?php

namespace App\Http\Controllers;

use App\Customer;
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
        $data['customers'] = Customer::all();

        if (Auth::user()->role != "admin") {
            $data['customers'] = Customer::where("user_id", Auth::id())->get();
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
            'no_ktp' => 'required|unique:customers',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'fax' => 'required',
        ]);

        if ($validate->fails()) { // if validation fails
            return redirect('customers')->with('error', 'Your data is not complete.')->withErrors($validate->errors())->withInput($input);
        } else {
            $input['user_id'] = Auth::id();
            Customer::create($input);

            return redirect('customers')->with('info', 'Create customer success!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
