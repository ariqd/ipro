<?php

namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    private $types = [
        'admin' => 'Admin',
        'sales' => 'Sales Cabang',
        'finance' => 'Finance',
        'gudang' => 'Gudang',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d['users'] = User::all();
        return view('account.index', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $d['types'] = $this->types;
        $d['branches'] = Branch::all();

        return view('account.form', $d);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $validator = Validator::make($input, [
            'username' => 'required|unique:users',
            'role' => 'required'
        ], [
            'required' => 'Kolom :attribute wajib diisi!',
            'unique' => 'Username has been taken'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        // $input['password'] = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; //secret
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        return redirect('accounts')->with('info', 'User ' . $user->name . ' created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d['user'] = User::find($id);
        $d['isEdit'] = TRUE;
        $d['types'] = $this->types;
        $d['branches'] = Branch::all();

        return view('account.form', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        unset($input['_token']);

        $user = User::find($id);

        if (empty($input['password']))
            $input['password'] = $user->password;
        else
            $input['password'] = bcrypt($input['password']);

        $user->update($input);

        return redirect('accounts')->with('info', 'User ' . $user->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
