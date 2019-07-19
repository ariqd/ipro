<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Commission;
use PDF;
use App\Sale;

class CommissionController extends Controller
{
    public function setKomisi(User $user)
    {
        return view('finance.commission.form', compact('user'));
    }

    public function storeKomisi(Request $request, User $user)
    {
        $input = $request->all();

        $input['achievement'] =  str_replace(',', '', $input['achievement']);
        $input['user_id'] = $user->id;

        Commission::create($input);

        return redirect('finances')->withInfo('Komisi berhasil di set untuk ' . $user->name);
    }

    public function printKomisi($user)
    {
        // $pdf = PDF::loadView('print.commission');
        // return $pdf->download("komisi.pdf");
        return view("print.commission");
    }

    public function show(User $user)
    {
        $from = date('2019-07-15');
        $to = date('2019-08-14');

        // Get SO based on period
        $sales_orders = Sale::where([
            ['user_id', '=', $user->id],
            ['no_so', '!=', ''],
        ])
            ->whereBetween('created_at', [$from, $to])
            ->get();

        // Count commission
        $new_sales_orders = $sales_orders->map(function ($value, $key) use ($user) {
            $value['total_komisi'] = $value['grand_total'] * ($user->commission->percentage / 100);
            return $value;
        });
        $total = 0;
        foreach ($new_sales_orders as $finance) {
            $total += $finance['total_komisi'];
        }

        // Update total commission
        if ($user->commission->total_commission != $total) {
            $commission = Commission::where('user_id', $user->id)->first();
            $commission->total_commission = $total;
            $commission->save();
        }

        return view('finance.commission.show', compact('user', 'total', 'sales_orders'));
    }

    // public function count() 
    // {
    //     $user = 
    //     //
    // }
}
