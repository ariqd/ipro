<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return view('po.index');
    }

    public function create()
    {
        return view('po.form');
    }

    public function addItems()
    {
        return view('po.items');
    }
}