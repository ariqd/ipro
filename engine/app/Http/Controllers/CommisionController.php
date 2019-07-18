<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Commision;
use PDF;

class CommisionController extends Controller
{
    public function setKomisi(User $user)
    {
        return view('finance.commission.form', compact('user'));
    }

    public function printKomisi($user)
    {
        $pdf = PDF::loadView('print.commision');
        return $pdf->download("komisi.pdf");
    }
}
