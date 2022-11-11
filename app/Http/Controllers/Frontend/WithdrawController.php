<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountType;
use App\Models\PaymentMethod;
use App\Models\IndirectEarning;
use App\Models\TotalEarning;
use App\Models\DirectEarning;
use App\Models\Withdraw;
use App\Models\Hit;
use App\Models\HitBonus;
use App\Models\CurrentEarning;
use Auth;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $user = Auth::user();
        $withdraw_amount = Withdraw::where('user_id', Auth::user()->id)->sum('amount');
        $current = CurrentEarning::where('user_id', Auth::user()->id)->first();
        $current_balance = $current ? $current->amount : 0;
        $bonus = HitBonus::where('user_id', Auth::user()->id)->first();
        $bonus_balance = $bonus ? $bonus->amount : 0;
        $direct_earning = DirectEarning::where('user_id', Auth::user()->id)->first();
        $payment_methods = PaymentMethod::all();
        return view('frontend.pages.withdraw.index',compact('withdraw_amount','payment_methods','user','current_balance', 'bonus_balance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current = CurrentEarning::where('user_id', Auth::user()->id)->first();
        $bonus = HitBonus::where('user_id', Auth::user()->id)->first();
        $current_balance = $current ? $current->amount : 0;
        $bonus_balance = $bonus ? $bonus->amount : 0;
        $current_bonus_balance = $current_balance + $bonus_balance;
        
        if($current_bonus_balance < $request->amount){
            return redirect()->back()->with("error", "You do not have sufficient balance for this transaction");
        }
        
        $data =[
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,

        ];
        $withdraw = Withdraw::create($data);
       
        if($request->amount > $current_balance){
            $extra_amount = $request->amount - $current_balance;
            $current->amount -= $request->amount - $extra_amount;
            $current->save();
            
            $bonus_amount = $request->amount - $current_balance;
            $bonus->amount -= $bonus_amount;
            $bonus->save();
        
            $hit = Hit::where('user_id', Auth::user()->id)->first();
            $hit->number -= $bonus_amount/2;
            $hit->save();
        }else{
            $current->amount -= $request->amount;
            $current->save();
        }
        if($withdraw){
            return redirect()->route('dashboard')->with('success', 'Your Request has Sended Successfully!');
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}