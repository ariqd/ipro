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

    public function edit($id)
    {
        $d['warehouse'] = Warehouse::find($id);
        $d['branch'] = $d['warehouse']->branch;
        $d['edit'] = true;

        return view('warehouse.form', $d);
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::find($id);
        $input = $request->all();
        $warehouse->update($input);

        return redirect('branches')->with('info', 'Cabang berhasil diubah menjadi cabang ' . $warehouse->name);
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->delete();

        return redirect('branches')->with('info', 'Cabang ' . $warehouse->name . ' berhasil dihapus!');
    }
}
