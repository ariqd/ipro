<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::with('categories')->latest()->get();

        return view("category.index", ["brands" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['brands'] = Brand::latest()->get();

        return view('category.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->lainlain == "on") {
            $arr["lainlain"] = 1;
            $request->merge($arr);
        } else {
            $arr["lainlain"] = 0;
            $request->merge($arr);
        }
        $category = Category::create($request->all());
        return redirect('categories')->with('info', 'Tambah kategori ' . $category->name . ' sukses!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['category'] = Category::find($id);

        return view('category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d['category'] = Category::find($id);
        $d['brands'] = Brand::all();
        $d['edit'] = TRUE;

        return view('category.form', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($request->lainlain == "on") {
            $arr["lainlain"] = 1;
            $request->merge($arr);
        } else {
            $arr["lainlain"] = 0;
            $request->merge($arr);
        }
        $category->update($request->all());

        return redirect('categories')->with('info', 'Edit kategori sukses!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('categories')->with('info', 'Hapus kategori sukses!');
    }

    public function search(Request $request, $id)
    {
        $data = Category::select("*");
        $data = $data->where("brand_id", "=", $id);
        $data = $data->get();

        return response()->json($data, 200);
    }
}
