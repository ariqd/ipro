<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return view('purchase.index');
    }

    public function create()
    {
        return view('purchase.form');
    }

    public function addItems()
    {
        return view('purchase.items');
    }
}
