<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Brand;
use App\Category;
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
    	$d['items'] = Item::select("items.*","brands.name as brandname","categories.name as categoryname")
        ->join("brands","brands.id","items.brand_id")
        ->join("categories","categories.id","items.category_id")
        ->get();

        if (!empty($request->all())) {
          $d['filtered'] = TRUE;
      }

      return view('item.index', $d);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        $brand = Brand::all();
        $category = Category::all();
        return view('item.form',[
            "brands"=>$brand,
            "categories"=>$category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$input = $request->all();
    	unset($input['_token']);

    	$validate = \Validator::make($input, [
    		'name' => 'required',
    		'category_id' => 'required|numeric',
    		'brand_id' => 'required|numeric'
    	]);

    	if ($validate->fails()) {
    		return redirect('item')->withErrors($validate)->withInput($input);
    	} else {
    		$item = Item::create($input);
    		return redirect('items')->with('info', $item->name . ' berhasil ditambahkan!');
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$d['item'] = Item::find($id);
    	$d['isEdit'] = TRUE;
    	return view('item.form', $d);
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
    	$input = $request->all();
    	unset($input['_token']);

    	$validate = Validator::make($input, [
    		'name' => 'required',
    		'category_id' => 'required|numeric',
    		'brand_id' => 'required|numeric'
    	]);

    	if ($validate->fails()) {
    		return redirect('inventories')->withErrors($validate)->withInput($input);
    	} else {
    		$item = Item::find($id);

    		if ($item->update($input)) {
    			return redirect('item')->with('info', $item->name . ' berhasil diubah!');
    		} else {
    			return redirect('item')->with('error', $item->name . ' gagal diubah!');
    		}
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	Item::destroy($id);
    	return redirect('/item')->with('info', 'Item berhasil dihapus!');
    }
}
