<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Sale;
use App\Setting;
use App\Commission;
use PDF;
use Carbon\Carbon;
use App\Sale_Detail;
use Illuminate\Database\Eloquent\Builder;
use DB;

class CommissionController extends Controller
{
    public function setKomisi(User $user)
    {
        return view('finance.commission.form', compact('user'));
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
        // $settings = Setting::where(['name' => 'finance-period-start'])
        //     ->orWhere(['name' => 'finance-period-end'])->get()->keyBy('name');


        // $from = Carbon::create(date('Y'), date('m') - 1, $settings['finance-period-end']->value, 00, 00, 00);
        // $to = Carbon::create(date('Y'), date('m'), $settings['finance-period-start']->value, 00, 00, 00);
        $setting = 1;
        $month =date("n")-1;
        $day = 15;
        if($day < 15){
            $month--;
        }
        $monthmoduloberjalan = $month - ($month % $setting);
        $monthmodulosisa = $monthmoduloberjalan + $setting;

        $from = date("Y-m-d",mktime(0, 0, 0, $monthmoduloberjalan+1  , 15, date("Y")));
        $to = date("Y-m-d",mktime(0, 0, 0, $monthmodulosisa+1, 14, date("Y")));
        // Tanggal periode awal
        // $from = Carbon::create(date('Y'), date('m'), $settings['finance-period-start']->value, 00, 00, 00);

        // // Tanggal akhir periode ( + 1 bulan)
        // $to = Carbon::create(date('Y'), date('m') + 1, $settings['finance-period-end']->value, 00, 00, 00);
        $totalSO = 0;
        // DB::enableQueryLog();
        $sales_orders = Sale_Detail::join('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->where(function ($query) use ($user) {
                $query->where('sales_orders.user_id', '=', $user->id);
                $query->orwhere('sales_orders.admin_id', '=', $user->id);
                $query->orwhere('sales_orders.sales_id', '=', $user->id);
            })
            ->where([
                ['sales_orders.no_so', '!=', ''],
            ])
            ->whereBetween('sales_orders.created_at', [$from, $to])
            ->orderBy('sales_orders.created_at', 'desc')
            ->get();
        // dd(DB::getQueryLog());
        //hitung total SO setelah komisi per barang
        $totalsemuakomisi = 0;
        foreach ($sales_orders as $value) {
            if ($user->id == 5) {
                if ($value->sales_id != null) {
                    if ($value->stock->item->category->brand->id == 0) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.01;
                        $value['komisi_achieve_referal'] = $value->total * 0.005 * 0.01;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.01;
                        $value['komisi_achieve_referal'] = $value->total * 0.02 * 0.01;
                    }
                } elseif ($value->admin_id != null) {
                    if ($value->stock->item->category->brand->id == 0) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.016;
                        $value['komisi_achieve_admin'] = $value->total * 0.005 * 0.004;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.01 * 0.016;
                        $value['komisi_achieve_admin'] = $value->total * 0.02 * 0.01 * 0.04;
                    }
                } else {
                    if ($value->stock->item->category->brand->id == 0) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.02;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.01 * 0.02;
                    }
                }
            } else {
                if ($value->sales_id != null) {
                    if ($value->stock->item->category->brand->id == 0) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.01;
                        $value['komisi_achieve_referal'] = $value->total * 0.005 * 0.01;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.01;
                        $value['komisi_achieve_referal'] = $value->total * 0.02 * 0.01;
                    }
                } elseif ($value->admin_id != null) {
                    if ($value->stock->item->category->brand->id == 0) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.015;
                        $value['komisi_achieve_admin'] = $value->total * 0.005 * 0.005;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.015;
                        $value['komisi_achieve_admin'] = $value->total * 0.02 * 0.005;
                    }
                } else {
                    if ($value->stock->item->category->brand->id == 0) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.02;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.02;
                    }
                }
            }
            $totalSO += $value->total;
            $totalsemuakomisi += $value['komisi_achieve'];

            //insert/update to db
            // $value->komisi_not_achieve = $value['komisi_achieve'] * 0.3;
            // $value->komisi_achieve = $value['komisi_achieve'];
            // $value->komisi_achieve_admin = $value['komisi_achieve_admin'];
            // $value->komisi_achieve_referal = $value['komisi_achieve_referal'];
            // $value->save();
        }

        if ($totalSO < $user->commission->achievement) {
            foreach ($sales_orders as $value) {
                $value['komisi_achieve'] = $value['komisi_achieve'] * 0.3;
            }
        }

        $komisi = 0;
        $komisisalesReferal = 0;
        $komisiadmin = 0;
        $data["achieved"] = true;
        if ($totalSO < $user->commission->achievement) {
            $data["achieved"] = false;
        }
        $data["total"] = $totalSO;
        $data["total_komisi"] = $totalsemuakomisi;

        $from = date("d F",mktime(0, 0, 0, $monthmoduloberjalan+1  , 15, date("Y")));
        $to = date("d F",mktime(0, 0, 0, $monthmodulosisa+1, 14, date("Y")));
        return view('finance.commission.show', compact('user', 'sales_orders', 'from', 'to', 'data'));
    }

    public function printKomisi($id)
    {
        $user = User::find($id);
        $settings = Setting::where(['name' => 'finance-period-start'])
            ->orWhere(['name' => 'finance-period-end'])->get()->keyBy('name');

        // Tanggal periode awal
        $from = Carbon::create(date('Y'), date('m'), $settings['finance-period-start']->value, 00, 00, 00);

        // Tanggal akhir periode ( + 1 bulan)
        $to = Carbon::create(date('Y'), date('m') + 1, $settings['finance-period-end']->value, 00, 00, 00);

        $sales_orders = Sale_Detail::join('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->where([
                ['sales_orders.user_id', '=', $user->id],
                ['sales_orders.no_so', '!=', ''],
            ])
            ->whereBetween('sales_orders.created_at', [$from, $to])
            ->orderBy('sales_orders.created_at', 'desc')
            ->get();

        // Count commission
        $sales_orders = $sales_orders->map(function ($value, $key) use ($user) {
            if ($value->stock->item->category->brand->id == 0) {
                $value['persen'] = '0,5 %';
                $value['komisi'] = $value->total * 0.005;
            } else {
                $value['persen'] = $user->commission->percentage . ' %';
                $value['komisi'] = $value->total * ($user->commission->percentage / 100);
            }
            $value['buat_sales'] = $value['komisi'] * 0.9;
            $value['buat_admin'] = $value['komisi'] * 0.1;

            return $value;
        });

        $data['total'] = 0;
        $data['total_komisi'] = 0;
        $data['total_buat_sales'] = 0;
        $data['total_buat_admin'] = 0;
        $data['achieved'] = true;
        $data['percentage'] = 1;

        foreach ($sales_orders as $sales_order) {
            $data['total'] += $sales_order->total;
            $data['total_komisi'] += $sales_order->komisi;
            $data['total_buat_sales'] += $sales_order->buat_sales;
            $data['total_buat_admin'] += $sales_order->buat_admin;
        }

        if ($data['total'] < $user->commission->achievement) {
            $data['achieved'] = false;
            $data['percentage'] = 0.3;
        }
        return view("print.commission", compact('user', 'sales_orders', 'from', 'to', 'data'));
    }
}
