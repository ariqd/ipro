<?php

namespace App\Http\Controllers\SalesOrder;

use App\Branch;
use App\Commission;
use App\Commission_Detail;
use App\Counter;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Sale;
use App\Sale_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class SalesOrderApproveController extends Controller
{
    public function index()
    {
        $d['sales'] = Sale::latest()->with(['customer', 'user.branch'])->get();

        return view('sale.index', $d);
    }

    public function getPaymentForm($id)
    {
        $d['sale'] = Sale::find($id);
        $d['sale_detail'] = $d['sale']->details()->first();

        return view('sale.form-approve', $d);
    }

    public function postPaymentForm($id, Request $request)
    {
        $sale = Sale::find($id);

        $counter = Counter::where("name", "=", "SO")->first();
        $branch_id = Auth::user()->branch_id;
        $noso = "SO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

        $sale->no_so = $noso;
        $sale->notes = $request->notes;
        $sale->tgl_pembayaran = $request->tgl_pembayaran;
        $sale->atas_nama = $request->atas_nama;
        $sale->perihal = $request->perihal;
        $sale->save();

        $counter->counter += 1;
        $counter->save();

        //calculatecommission
        $sales_orders = Sale_Detail::join('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->where("sales_orders.id", "=", $id)
            ->get();

        $totalachieve = 0;
        $totalachievesales = 0;
        $totalachieveadmin = 0;

        $totalSO = 0;

        $totalkomisiachieve = 0;
        $totalkomisinotachieve = 0;

        $totalkomisiachievesales = 0;
        $totalkomisinotachievesales = 0;

        $totalkomisiachieveadmin = 0;
        $totalkomisinotachieveadmin = 0;

        $role = "";
        foreach ($sales_orders as $value) {
            if ($value->user_id == 5) {
                //HO
                if ($value->sales_id != null) {
                    //Bahu Membahu
                    if ($value->stock->item->category->lainlain == 1) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.5;
                        $value['komisi_achieve_referal'] = $value->total * 0.005 * 0.5;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.5;
                        $value['komisi_achieve_referal'] = $value->total * 0.02 * 0.5;
                    }
                    $totalachieve += $value->total * 0.5;
                    $totalachievesales += $value->total * 0.5;
                    $role = "Referral";
                } elseif ($value->admin_id != null) {
                    //Ditulisin
                    if ($value->stock->item->category->lainlain == 1) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.8;
                        $value['komisi_achieve_admin'] = $value->total * 0.005 * 0.2;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.8;
                        $value['komisi_achieve_admin'] = $value->total * 0.02 * 0.2;
                    }
                    $totalachieve += $value->total * 0.8;
                    $totalachieveadmin += $value->total * 0.2;
                    $role = "Admin";
                } else {
                    //Solo
                    if ($value->stock->item->category->lainlain == 1) {
                        $value['komisi_achieve'] = $value->total * 0.005;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02;
                    }
                    $totalachieve += $value->total;
                }
            } else {
                //Sales
                if ($value->sales_id != null) {
                    //Bahu Membahu
                    if ($value->stock->item->category->lainlain == 1) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.5;
                        $value['komisi_achieve_referal'] = $value->total * 0.005 * 0.5;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.5;
                        $value['komisi_achieve_referal'] = $value->total * 0.02 * 0.5;
                    }
                    $totalachieve += $value->total;
                    $totalachievesales += $value->total;
                    $role = "Sales";
                } elseif ($value->admin_id != null) {
                    //Ditulisin
                    if ($value->stock->item->category->lainlain == 1) {
                        $value['komisi_achieve'] = $value->total * 0.005 * 0.75;
                        $value['komisi_achieve_admin'] = $value->total * 0.005 * 0.25;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02 * 0.75;
                        $value['komisi_achieve_admin'] = $value->total * 0.02 * 0.25;
                    }
                    $totalachieve += $value->total * 0.8;
                    $totalachieveadmin += $value->total * 0.2;
                    $role = "Admin";
                } else {
                    //Solo
                    if ($value->stock->item->category->lainlain == 1) {
                        $value['komisi_achieve'] = $value->total * 0.005;
                    } else {
                        $value['komisi_achieve'] = $value->total * 0.02;
                    }
                    $totalachieve += $value->total;
                }
            }

            $totalkomisiachieve += $value['komisi_achieve'];
            $totalkomisinotachieve += $value['komisi_achieve'] * 0.3;

            $totalkomisiachievesales += $value['komisi_achieve_referal'];
            $totalkomisinotachievesales += $value['komisi_achieve_referal'] * 0.3;

            $totalkomisiachieveadmin += $value['komisi_achieve_admin'];
            $totalkomisinotachieveadmin += $value['komisi_achieve_admin'] * 0.3;

            $totalSO += $value->total;
        }

        // end calulate commission

        // save komisi untuk sales utama
        $commission = Commission::where('user_id', $sale->user->id)->first();
        if (!$commission) {
            return redirect()->back()->with('error', 'Komisi sales ' . $sale->user->name . ' belum disetting untuk periode ini!');
        }
        $commission->total_commission += $totalkomisiachieve;
        $commission->total_commission_not_achieve += $totalkomisinotachieve;
        $commission->achieved += $totalachieve;
        $commission->save();

        Commission_Detail::create([
            "user_id" => $sale->user->id,
            "commission" => $totalkomisiachieve,
            "commission_not_achieve" => $totalkomisinotachieve,
            "sales_order_id" => $sale->id,
            "role" => $role,
        ]);

        // save komisi jika bahu membahu
        if ($sale->sales_id != null) {
            $commission = Commission::where('user_id', $sale->sales_id)->first();
            $commission->total_commission += $totalkomisiachievesales;
            $commission->total_commission_not_achieve += $totalkomisinotachievesales;
            $commission->achieved += $totalachievesales;
            $commission->save();

            Commission_Detail::create([
                "user_id" => $sale->sales_id,
                "commission" => $totalkomisiachievesales,
                "commission_not_achieve" => $totalkomisinotachievesales,
                "sales_order_id" => $sale->id,
                "role" => $role,
            ]);
        }

        // save komisi jika ada admin
        if ($sale->admin_id != null) {
            $commission = Commission::where('user_id', $sale->admin_id)->first();
            $commission->total_commission += $totalkomisiachieveadmin;
            $commission->total_commission_not_achieve += $totalkomisinotachieveadmin;
            $commission->achieved += $totalachieveadmin;
            $commission->save();
            Commission_Detail::create([
                "user_id" => $sale->admin_id,
                "commission" => $totalkomisiachieveadmin,
                "commission_not_achieve" => $totalkomisinotachieveadmin,
                "sales_order_id" => $sale->id,
                "role" => $role,
            ]);
        }
        return redirect()->back()->with("info", "SO berhasil disetujui, <a href='approve/print' class='btn btn-light'>Print Kwitansi</a>");
    }

    public function makeKwitansi($id)
    {
        $sale = Sale::find($id);
        $customer = $sale->customer;
        $data["terbilang"] = $this->angkaTerbilang($sale->grand_total + $sale->ongkir);
        $data["project_name"] = $sale->project;
        $data["updated_at"] = $sale->updated_at;
        $data["customer_name"] = $customer->project_owner;
        $data["nominal"] = $sale->grand_total + $sale->ongkir;
        $data["QO"] = $sale->quotation_id;
        $data["SO"] = $sale->no_so;
        $pdf = PDF::loadView('print.kwitansi', $data);
        return $pdf->stream('invoice ' . date("Ymd") . '.pdf');
    }
}
