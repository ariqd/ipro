<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        $d['vendors'] = Vendor::all();

        return view('vendor.index', $d);
    }

    public function create()
    {
        return view('vendor.form');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $input['user_id'] = Auth::id();
        $vendor = Vendor::create($input);

        return redirect('vendors')->with('info', 'Vendor ' . $vendor->name . ' Created!');
    }

    public function edit($id)
    {
        $d['vendor'] = Vendor::find($id);
        $d['isEdit'] = TRUE;

        return view('vendor.form', $d);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        unset($input['_token']);

        Vendor::find($id)->update($input);

        return redirect('vendors')->with('info', 'Vendor Updated!');
    }
}
