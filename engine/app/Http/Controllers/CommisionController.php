<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Commision;

class CommisionController extends Controller
{
    public function setKomisi(User $user)
    {
        return view('finance.commission.form', compact('user'));
    }
}
