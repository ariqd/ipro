<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Branch;
use App\Brand;
use App\Category;
use App\Counter;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return view('purchase.index');
    }

    public function create()
    {   //PO/SO Date kodecabang, Cabang, Urut
        //PO 160419 01 BDG 00001
        $counter = Counter::where("name","=","PO")->first();
        $branch_id = Auth::user()->branch_id;
        $branch = Branch::find($branch_id);
        $data['brands'] = Brand::all();
        $data['categories'] = Category::all();
        $data['no_po'] = "PO".date("ymd").str_pad($branch_id, 2, 0, STR_PAD_LEFT).str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        return view('purchase.form', $data);
    }

    public function show()
    {
      //
    }

    public function store(Request $request)
    {
        dd($request->all());

        $counter = Counter::where("name","=","PO")->first();
        $branch_id = Auth::user()->branch_id;
        $branch = Branch::find($branch_id);
        $nopo = "PO".date("ymd").str_pad($branch_id, 2, 0, STR_PAD_LEFT).str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

    }

    public function addItems()
    {
        return view('purchase.items');
    }

    public function getCategories($brand_id)
    {
        return response()->json();
    }
}
