<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use models
use App\Models\AccountType;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_types = AccountType::orderBy('id', 'desc')->get();
        return view('backend.pages.account-types.index', compact('account_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.account-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['created_by' => user()->id]);
        $request->merge(['updated_by' => user()->id]);
        $account_type = AccountType::create($request->toArray());
        if($account_type){
            return redirect()->route('manage-account-types.index')->with('success', 'Account type created successfuly!');;
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account_type = AccountType::find($id);
        return view('backend.pages.account-types.edit', compact('account_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $account_type = AccountType::find($id);
        if($account_type){
            $request->merge(['updated_by' => user()->id]);
            $account_type = $account_type->update($request->toArray());
        }
        return redirect()->route('manage-account-types.index')->with('success', 'Account type updated successfuly!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account_type = AccountType::find($id);
        if($account_type){
            $account_type->delete();
            return response()->json([
                'status' => 1
            ]);
        }
    }
}