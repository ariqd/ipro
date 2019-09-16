<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::all();
        return view("brand.index", ["brands" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = Brand::create($request->all());

        if ($request->has('logo')) {
            $dir = "assets/img/logo";

            if (is_dir($dir) === false) {
                mkdir($dir);
            }

            $file = $request->logo;
            $file3 = "logo-" . date("dmyhis") . "." . $file->getClientOriginalExtension();
            $file->move($dir, $file3);
            $brand->logo = $file3;
            $brand->save();
        }

        return redirect('brands')->with('info', 'Tambah brand sukses!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d['brand'] = Brand::find($id);
        $d['isEdit'] = TRUE;

        return view('brand.form', $d);
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
        $brand = Brand::find($id);
        $brand->update($request->all());
        if ($request->has('logo')) {
            $dir = "assets/img/logo";

            if (is_dir($dir) === false) {
                mkdir($dir);
            }

            $file = $request->logo;
            $file3 = "logo-" . date("dmyhis") . "." . $file->getClientOriginalExtension();
            $file->move($dir, $file3);
            $brand->logo = $file3;
            $brand->save();
        }

        return redirect('brands')->with('info', 'Edit brand sukses!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::destroy($id);

        return redirect('/brands')->with('info', 'Merek berhasil dihapus!');
    }
}
