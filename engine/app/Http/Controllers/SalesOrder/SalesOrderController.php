<?php

namespace App\Http\Controllers\SalesOrder;

use App\Branch;
use App\Brand;
use App\Counter;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Sale;
use App\Sale_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Stock;

class SalesOrderController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'sales') {
            $d['sales'] = Sale::mySales()->with(['customer', 'user.branch'])->latest()->get();
        } else if (Auth::user()->role == 'koordinator_wilayah') {
            $d['sales'] = Sale::myArea()->with(['customer', 'user.branch'])->latest()->get();
        } else {
            $d['sales'] = Sale::with(['customer', 'user.branch'])->latest()->get();
        }

        // if (Auth::user()->role == 'finance' || Auth::user()->role == 'sales_ho')
        //     return redirect('sales-orders/check/approve');

        return view('sale.index', $d);
    }

    public function create()
    {
        $counter = Counter::where("name", "=", "QO")->first();
        $branch_id = Auth::user()->branch_id;
        $d['no_qo'] = "QO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $d['customers'] = Customer::latest()->get();
        $d['brands'] = Brand::all();
        $d['branches'] = Branch::all();
        $d['sales'] = User::sales()->get()->except(auth()->id());


        return view('sale.form', $d);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $input['user_id'] = Auth::id();
        // if (Auth::user()->role == "admin") {
        //     $input['user_id'] = Auth::id();
        // }
        $sales_order_details = $input['item'];
        unset($input['item']);

        $counter = Counter::where("name", "=", "QO")->first();
        $branch_id = Auth::user()->branch_id;
        $no_qo = "QO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $input["quotation_id"] = $no_qo;

        $d['max_discount'] = 14.5;
        if (Auth::user()->role == 'koordinator_wilayah') {
            $d['max_discount'] = 18.8;
        } else if (Auth::user()->role == 'sales_ho') {
            $d['max_discount'] = 22.85;
        }

        $sales_order = Sale::create($input);
        $counter->counter += 1;
        $counter->save();

        $discountCounter = 0; // Counter untuk barang yang diskonnya di atas 18.8%
        foreach ($sales_order_details as $sales_order_detail) {
            // Jika diskon barang di atas 18.8% counter naik
            if ($sales_order_detail['discount'] > 18.8) {
                $discountCounter++;
            }

            // Jika diskon di atas 22.85% & role Korwil atau Sales HO maka cancel pembuatan SO
            if ($sales_order_detail['discount'] > 22.85) {
                if (Auth::user()->role == 'koordinator_wilayah' || Auth::user() - role == 'Sales HO') {
                    $sales_order->delete();
                    return redirect()->back()->withError('Koordinator Wilayah & Sales HO tidak bisa memberi diskon di atas 22.85%')->withInput($input);
                }
            }

            // Jika diskon di atas 14.5% & role Korwil maka cancel pembuatan SO
            if ($sales_order_detail['discount'] > 14.5 && Auth::user()->role == 'sales') {
                $sales_order->delete();
                return redirect()->back()->withError('Sales tidak bisa memberi diskon di atas 14.5%')->withInput($input);
            }

            $stock = Stock::find($sales_order_detail['stock_id']);
            if ($sales_order_detail['qty'] > $stock->quantity) {
                $sales_order->delete();
                return redirect()->back()->withError('Jumlah pesanan ' . $stock->item->name . ' melebihi jumlah yang tersedia!')->withInput($input);
            }

            $sales_order_detail['sales_order_id'] = $sales_order->id;
            Sale_Detail::create($sales_order_detail);
            $stock->hold += $sales_order_detail['qty'];

            $stock->save();
        }

        if ($input['payment_method'] == 'CBD') { // Jika metode pembayarannya CBD
            // START Approve SO
            $no_so = "SO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
            $sales_order->no_so = $no_so;
            // END Approve SO

            // TAPI jika salesnya korwil & ada barang yang diskonnya di atas 18.8
            if (Auth::user()->role == 'koordinator_wilayah' && $discountCounter > 0) {
                $sales_order->no_so = null;  // Batal approve
            }
            // END

            $sales_order->save();
        }

        return redirect('sales-orders')->with('info', 'Sales Order Created');
    }

    public function show($id)
    {
        $d['sale'] = Sale::find($id);

        return view('sale.show', $d);
    }

    public function edit($id)
    {
        $d['isEdit'] = TRUE;
        $d['sale'] = Sale::find($id);
        $d['customers'] = Customer::all();
        $d['brands'] = Brand::all();
        $d['branches'] = Branch::all();
        $d['sales'] = User::sales()->get()->except(auth()->id());

        return view('sale.form', $d);
    }

    public function update(Request $request, $id)
    {
        // todo: buat update SO
    }

    public function notaKhusus()
    {
        $counter = Counter::where("name", "=", "QO")->first();
        $branch_id = Auth::user()->branch_id;
        $d['no_qo'] = "";
        $d['customers'] = Customer::orderBy('created_at', 'desc')->get();
        $d['brands'] = Brand::all();
        $d['branches'] = Branch::all();
        $d['sales'] = User::where("role", "like", "%sales%")->get();

        return view('sale.nota-khusus', $d);
    }

    public function notaKhususCreate(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $input['user_id'] = Auth::id();
        if (Auth::user()->role == "admin") {
            $input['user_id'] = Auth::id();
        }
        $sales_order_details = $input['item'];
        unset($input['item']);

        // $counter = Counter::where("name", "=", "QO")->first();
        // $branch_id = Auth::user()->branch_id;
        // $no_po = "QO" . date("ymd") . str_pad($branch_id, 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);
        $input["quotation_id"] = $request->quotation_id;

        $sales_order = Sale::create($input);
        // $counter->counter += 1;
        // $counter->save();

        foreach ($sales_order_details as $sales_order_detail) {
            $stock = Stock::find($sales_order_detail['stock_id']);
            // if ($sales_order_detail['qty'] > $stock->quantity) {
            //     $sales_order->delete();
            //     return redirect()->back()->withError('Jumlah pesanan ' . $stock->item->name . ' melebihi jumlah yang tersedia!')->withInput($input);
            // }
            $sales_order_detail['sales_order_id'] = $sales_order->id;
            // Sale_Detail::create($sales_order_detail);
            // $stock->hold += $sales_order_detail['qty'];
            // $stock->save();
        }

        return redirect('sales-orders')->with('info', 'Sales Order Created');
    }

    public function deleteDetail($sales_id, $details_id)
    {
        $detail = Sale_Detail::find($details_id);
        $detail->delete();

        return redirect('sales-orders/' . $sales_id . '/edit')->with('info', "Produk #$detail->id berhasil dihapus dari Sales Order");
    }
}
