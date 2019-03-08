<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return view('purchase.index');
    }

    public function create()
    {
        $data['brands'] = Brand::all();
        $data['categories'] = Category::all();

        return view('purchase.form', $data);
    }

    public function show(){
        $asu = Category::select("name")->where("brand_id",1)->get();
        foreach($asu as $anakasu){
            echo $anakasu->name;
        }
        dd($asu);
    }

    public function store(Request $request){
        dd($request->all());
    }

    public function addItems()
    {
        return view('purchase.items');
    }

    public function getCategories($brand_id)
    {
//        $data['categories'] = Category::where('brand')
        return response()->json();
    }
}
