<?php

namespace App\Http\Controllers\SalesOrder;

use App\Sale;
use App\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalesOrderSearchController extends Controller
{
    public function searchStocks()
    {
        $category_id = request()->get('category_id');

        $stocks = Stock::with('item')
            ->whereHas('item', function ($query) use ($category_id) {
                $query->where('category_id', '=', $category_id);
            })->tap(function ($query) {
                Auth::user()->role == 'admin' ?: $query->where('branch_id', '=', Auth::user()->branch_id);
            })->with('branch');

        return response()->json($stocks->get(), 200);
    }

    public function searchDetailSO($id)
    {
        $query = Sale::where("no_so", "=", $id)->first();
        $data["header"] = $query;
        $data["detail"] = $query->details()->get();

        foreach ($data["detail"] as $key) {
            $key["stock"] = $key->stock()->first();
            $key["item"] = $key["stock"]->item()->first();
            $key["category"] = $key["item"]->category()->first();
            $key["brand"] = $key["category"]->brand()->first();
        }

        return response()->json($data, 200);
    }

    public function searchApprove($id)
    {
        $query = Sale::where("no_so", "=", $id)->first();
        $data["header"] = $query;
        $data["detail"] = $query->details()->get();

        foreach ($data["detail"] as $key) {
            $key["stock"] = $key->stock()->first();
            $key["item"] = $key["stock"]->item()->first();
            $key["category"] = $key["item"]->category()->first();
            $key["brand"] = $key["category"]->brand()->first();
        }

        return response()->json($data, 200);
    }
}
