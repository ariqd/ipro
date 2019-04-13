<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Stock;
use App\Item;
use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $d['brands'] = Stock::leftjoin('items','items.id','stocks.item_id')->leftjoin('brands','brands.id','items.brand_id')->distinct('brands.name')->pluck('brands.name');
//        $d['branches'] = Stock::leftjoin("branches","branches.id","stocks.branch_id")->distinct('branch_id')->pluck('branch_id');
//
//        $d['stocks'] = Stock::select("stocks.*","items.name as itemname","items.code","brands.name as brandname","categories.name as categoryname","branches.name as branchname")
//        ->leftjoin("items","items.id","stocks.item_id")
//        ->leftjoin("brands","brands.id","items.brand_id")
//        ->leftjoin("categories","categories.id","items.category_id")
//        ->leftjoin('branches','branches.id','stocks.branch_id')
//        ->get();

        $d['brands'] = Brand::all();
        $d['branches'] = Branch::all();

        $d['stocks'] = Stock::all();

        $d['filtered'] = FALSE;
        if (!empty($request->all())) {
            $d['filtered'] = TRUE;
        }

//        dd($d['brands']);

        return view('stock.index', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $d['items'] = Item::all();
        $d['branches'] = Branch::all();
        return view('stock.form', $d);
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

        $validate = Validator::make($input, [
            'item_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'quantity' => 'required|numeric',
//            'weight' => 'required|numeric',
//            'area' => 'required|numeric',
//            'width' => 'required|numeric',
//            'height' => 'required|numeric',
//            'length' => 'required|numeric',
//            'price' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return redirect('stocks')->withErrors($validate)->withInput($input);
        } else {
            $stock = Stock::create($input);
            return redirect('stocks')->with('info', $stock->name . ' berhasil ditambahkan!');
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
//      $d['stock'] = Stock::select("stocks.*","items.name as itemname","items.code","brands.name as brandname","categories.name as categoryname","branches.name as branchname")
//      ->leftjoin("items","items.id","stocks.item_id")
//      ->leftjoin("brands","brands.id","items.brand_id")
//      ->leftjoin("categories","categories.id","items.category_id")
//      ->leftjoin('branches','branches.id','stocks.branch_id')
//      ->where("stocks.id",$id)
//      ->first();
        $d['stock'] = Stock::find($id);
        return view('stock.show', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d['items'] = Item::all();
        $d['branches'] = Branch::all();
        $d['stock'] = Stock::find($id);
        $d['isEdit'] = TRUE;
        return view('stock.form', $d);
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
            'item_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
            'area' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return redirect('stocks')->withErrors($validate)->withInput($input);
        } else {
            $stock = Stock::find($id);

            if ($stock->update($input)) {
                return redirect('stocks')->with('info', $stock->name . ' berhasil diubah!');
            } else {
                return redirect('stocks')->with('error', $stock->name . ' gagal diubah!');
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
        Stock::destroy($id);
        return redirect('/stocks')->with('info', 'Produk berhasil dihapus!');
    }

    public function getTable(Request $request)
    {
        $stock = (new Stock())->newQuery();

        if ($request->has('brands')) {
            $stock->brands($request->brands);
        }

        if ($request->has('branches')) {
            $stock->branches($request->branches);
        }

        return $stock->get();
    }

    public function restock($id)
    {
        $d['stock'] = Stock::select("stocks.*", "items.name as itemname", "items.code", "brands.name as brandname", "categories.name as categoryname", "branches.name as branchname")
            ->leftjoin("items", "items.id", "stocks.item_id")
            ->leftjoin("brands", "brands.id", "items.brand_id")
            ->leftjoin("categories", "categories.id", "items.category_id")
            ->leftjoin('branches', 'branches.id', 'stocks.branch_id')
            ->where("stocks.id", $id)
            ->first();
        return view('stock.restock', $d);
    }

    public function restockSingular(Request $request, $id)
    {
//        return view('stock.restock', $d);
//        dd($request->all());
        $input = $request->all();
        unset($input['_token']);

        $stock = Stock::find($id);

        $stock->stock = $stock->stock + $input['add'];

        $stock->save();
        return redirect('/stocks')->with('info', 'Stok ' . $stock->name . ' berhasil ditambahkan ' . $input['add'] . ' pcs menjadi ' . $stock->stock . 'pcs per batang');
    }

    public function getDataByCategory($id)
    {
        $data["data"] = Stock::select("stocks.*", "items.name as itemname", "items.code", "categories.name as catname")
            ->leftjoin("items", "items.id", "stocks.item_id")
            ->leftjoin("categories", "categories.id", "items.category_id")
            ->where("category_id", $id)->get();
        return response($data, 200);

    }
}
