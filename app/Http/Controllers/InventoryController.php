<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d['inventories'] = Inventory::all();
        return view('inventory.index', $d);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'brand' => 'required',
            'code' => 'required',
            'name' => 'required',
            'stock' => 'required|numeric',
            'weight' => 'required|numeric',
            'area' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return redirect('inventories')->withErrors($validate)->withInput($input);
        } else {
            $inventory = Inventory::create($input);
            return redirect('inventories')->with('info', $inventory->name. ' berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $d['inventory'] = Inventory::find($id);
        return view('inventory.show', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d['inventory'] = Inventory::find($id);
        $d['isEdit'] = TRUE;
        return view('inventory.form', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'brand' => 'required',
            'code' => 'required',
            'name' => 'required',
            'stock' => 'required|numeric',
            'weight' => 'required|numeric',
            'area' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return redirect('inventories')->withErrors($validate)->withInput($input);
        } else {
            $inventory = Inventory::find($id);

            if ($inventory->update($input)) {
                return redirect('inventories')->with('info', $inventory->name. ' berhasil diubah!');
            } else {
                return redirect('inventories')->with('error', $inventory->name. ' gagal diubah!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::destroy($id);
        return redirect('/inventories')->with('info', $inventory->name.' berhasil dihapus!');
    }
}
