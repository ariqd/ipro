<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $d['branches'] = Branch::with('warehouses')->get();

        return view('branch.index', $d);
    }

    public function create()
    {
        return view('branch.form');
    }

    public function store(Request $request)
    {
        Branch::create($request->all());

        return redirect('branches')->with('info', 'Tambah cabang sukses!');
    }

    public function edit($id)
    {
        $d['branch'] = Branch::find($id);
        $d['isEdit'] = TRUE;
        
        return view('branch.form', $d);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::find($id);
        $branch->update($request->all());
        return redirect('branches')->with('info', 'Edit cabang sukses!');
    }

    public function destroy($id)
    {
        $branch = Branch::find($id);
        $branch->delete();

        return redirect('branches')->with('info', 'Hapus kategori sukses!');
    }
}
