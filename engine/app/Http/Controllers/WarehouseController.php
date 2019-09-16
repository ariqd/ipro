<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Warehouse;
use Illuminate\Http\Request;

class WarehouseController
{
    public function create(Branch $branch)
    {
        return view('warehouse.form', compact('branch'));
    }

    public function store(Request $request) 
    {
        $input = $request->all();
        unset($input['_token']);

        Warehouse::create($input);

        return redirect('branches')->with('info', 'Cabang berhasil dibuat');
    }
}
