<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Brand;
use App\Category;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $d['items'] = Item::with('category.brand')->latest()->get();

        return view('item.index', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::has('brand')->orderBy('name', 'desc')->get();

        return view('item.form', ["categories" => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $validator = Validator::make($input, [
            'name' => 'required',
            'purchase_price' => 'required|numeric',
            'weight' => 'required|numeric',
            'code' => 'required',
            'height' => 'required|numeric',
            'area' => 'required|numeric',
            'length' => 'required|numeric'
        ], [
            'required' => 'Kolom :attribute harus diisi',
            'numeric' => 'Kolom :attribute harus berupa angka'
        ]);

        if ($validator->fails())
            return redirect('items')->withErrors($validator)->withInput();

        $item = Item::create($input);

        return redirect('items')->with('info', $item->name . ' berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $d['item'] = Item::find($id);

        return view('item.show', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d['item'] = Item::find($id);
        $d['isEdit'] = TRUE;
        $d['categories'] = Category::has('brand')->orderBy('name', 'desc')->get();

        return view('item.form', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'name' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect('inventories')->withErrors($validate)->withInput($input);
        } else {
            $item = Item::find($id);

            if ($item->update($input)) {
                return redirect('items')->with('info', $item->name . ' berhasil diubah!');
            } else {
                return redirect('items')->with('error', $item->name . ' gagal diubah!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect('items')->with('info', 'Item berhasil dihapus!');
    }


    public function search(Request $request, $id)
    {
        $data = Item::select("*");
        $data = $data->where("category_id", "=", $id);
        $data = $data->get();

        return response()->json($data, 200);
    }

    public function searchdetail(Request $request, $id)
    {
        $query = Item::find($id);
        $data["item"] = $query;
        $data["item"]["category"] = $query->category()->first();
        $data["item"]["brand"] = $query->category->brand()->first();
        return response()->json($data, 200);
    }
}
