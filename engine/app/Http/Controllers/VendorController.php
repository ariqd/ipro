<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
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
//        dd($input);

        if ($request->has('image')) {
            $file = $input['image'];
            $file3 = $input['name'] . "foto-" . date("dmyhis") . "." . $file->getClientOriginalExtension();
            $file->move(public_path('../../assets/img/uploads/vendors'), $file3);
            $input["image"] = $file3;
        }

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

        if ($request->has('image')) {
            $file = $input['image'];
            $file3 = $input['name'] . "foto-" . date("dmyhis") . "." . $file->getClientOriginalExtension();
            $file->move(public_path('../../assets/img/uploads/vendors'), $file3);
            $input["image"] = $file3;
        }

        Vendor::find($id)->update($input);

        return redirect('vendors')->with('info', 'Vendor Updated!');
    }
}
