<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Sale;
use App\Setting;
use App\Commission;
use App\Commission_Detail;
use PDF;
use Carbon\Carbon;
use App\Sale_Detail;
use Illuminate\Database\Eloquent\Builder;
use DB;

class CommissionController extends Controller
{
    public function setKomisi(User $user)
    {
        $setting = 1;
        $month =date("n")-1;
        $day = 15;
        if($day < 15){
            $month--;
        }
        $monthmoduloberjalan = $month - ($month % $setting);
        $monthmodulosisa = $monthmoduloberjalan + $setting;
        $from = date("d F",mktime(0, 0, 0, $monthmoduloberjalan+1  , 15, date("Y")));
        $to = date("d F",mktime(0, 0, 0, $monthmodulosisa+1, 14, date("Y")));
        return view('finance.commission.form', compact('user','from','to'));
    }

    public function storeKomisi(Request $request, User $user)
    {
        $input = $request->all();

        $input['achievement'] = str_replace(',', '', $input['achievement']);
        $input['user_id'] = $user->id;

        //hitung periode
        $setting = 3;
        $month =date("n")-1;
        $day = 15;
        if($day < 15){
            $month--;
        }
        $monthmoduloberjalan = $month - ($month % $setting);
        $monthmodulosisa = $monthmoduloberjalan + $setting;

        $period_start = date("Y-m-d",mktime(0, 0, 0, $monthmoduloberjalan+1  , 15, date("Y")));
        $period_end = date("Y-m-d",mktime(0, 0, 0, $monthmodulosisa+1, 14, date("Y")));
        $input["period_start"] = $period_start;
        $input["period_end"] = $period_end;
        Commission::create($input);

        return redirect('finances')->withInfo('Komisi berhasil di set untuk ' . $user->name);
    }

    public function show(User $user)
    {
        $setting = 1;
        $month =date("n")-1;
        $day = 15;
        if($day < 15){
            $month--;
        }
        $monthmoduloberjalan = $month - ($month % $setting);
        $monthmodulosisa = $monthmoduloberjalan + $setting;
        $commission = Commission::where("user_id","=",$user->id)->first();
        $detail_commission = Commission_Detail::with("sale.details.stock.item")
        ->where("commissions_details.user_id","=",$user->id)
        ->whereBetween('commissions_details.created_at', [$commission->period_start, $commission->period_end])
        ->get();
        $from = date("d F",mktime(0, 0, 0, $monthmoduloberjalan+1  , 15, date("Y")));
        $to = date("d F",mktime(0, 0, 0, $monthmodulosisa+1, 14, date("Y")));
        return view('finance.commission.show', compact('user', 'detail_commission', 'from', 'to', 'commission'));

        }

    public function printKomisi($id)
    {
        $user = User::find($id);
        $setting = 1;
        $month =date("n")-1;
        $day = 15;
        if($day < 15){
            $month--;
        }
        $monthmoduloberjalan = $month - ($month % $setting);
        $monthmodulosisa = $monthmoduloberjalan + $setting;
        $commission = Commission::where("user_id","=",$user->id)->first();
        $detail_commission = Commission_Detail::with("sale.details.stock.item")
        ->where("commissions_details.user_id","=",$user->id)
        ->whereBetween('commissions_details.created_at', [$commission->period_start, $commission->period_end])
        ->get();
        $from = date("d F",mktime(0, 0, 0, $monthmoduloberjalan+1  , 15, date("Y")));
        $to = date("d F",mktime(0, 0, 0, $monthmodulosisa+1, 14, date("Y")));

        $pdf = PDF::loadView("print.commission", compact('user', 'detail_commission', 'from', 'to', 'commission'));
        return $pdf->download('Komisi.pdf');
        // return view("print.commission", compact('user', 'detail_commission', 'from', 'to', 'commission'));
    }
}
