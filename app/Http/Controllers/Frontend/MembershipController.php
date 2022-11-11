<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Http\Request;
// use facades
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

// use mails
use App\Mail\AccountUpgrade;

// use models
use App\Models\Membership;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Withdraw;
use App\Models\AccountType;
use App\Models\DirectEarning;
use App\Models\TotalEarning;


class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $membership = Membership::where('user_id', Auth::user()->id)->first();

         return view('frontend.pages.membership.index',compact('membership'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = AccountType::all();
        return view('frontend.pages.membership.upgrade',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =[
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'status' => 1,

        ];
        $membership = Membership::create($data);
        $notification = array(
            'success' => ' Request Send Successfully!',
            );
        return redirect()->back()->with($notification);
    }

    public function account_type(Request $request)
    {
        $userController = new UserController();
        $request['account_type'] = $request->account_type;
        $user = Auth::user();
        $sponser = User::find($user->sponser_id);
        $account = AccountType::find($request->account_type);

        $isValidUpgradation = $user->account_bal ? $account->price <= $user->account_bal->price : true;
        if($isValidUpgradation){
            return response()->json([
                'success' => false,
                'message' => "Your can not upgrade this account anymore!",
            ]);
        }

        $withdraw_amount = Withdraw::where('user_id', Auth::user()->id)->sum('amount');
        $total_earning = TotalEarning::where('user_id', Auth::user()->id)->first();

        $current_balance = $total_earning ? ($total_earning ? $total_earning->amount : 0) - ($withdraw_amount ? $withdraw_amount : 0) : 0;
        $extra_amount = $user->account_bal ? $account->price - $user->account_bal->price : 0;
        if($current_balance >= $extra_amount){
            $transaction = new Transaction();
            $transaction->amount = $extra_amount;
            $transaction->sender_id = $user->id ? $user->id : 1;
            $transaction->save();

            $data =[
                'payment_method' => $request->account_type,
                'amount' => $extra_amount,
                'user_id' => Auth::user()->id,

            ];
            $withdraw = Withdraw::create($data);
            $prev_ern = prev_earn($user->account_bal->id);
            if($account->price <= $sponser->account_bal->price){
                if($account->id == 1){
                    $amount= 500 - $prev_ern;
                }elseif($account->id == 2){
                    $amount= 750 - $prev_ern;
                }elseif($account->id == 3){
                    $amount= 1200 - $prev_ern;

                }elseif($account->id == 4){
                    $amount= 1500 - $prev_ern;
                }
                $userController->direct_earning($user->sponser_id, $amount);
            }else{
                if($sponser->account_bal->id == 1){
                    $amount= $prev_ern <= 500 ? 500 - $prev_ern : 0;
                }elseif($sponser->account_bal->id == 2){
                    $amount= $prev_ern <= 750 ? 750 - $prev_ern : 0;
                }elseif($sponser->account_bal->id == 3){
                    $amount= $prev_ern <= 1200 ? 1200 - $prev_ern : 0;
                }elseif($sponser->account_bal->id == 4){
                    $amount= $prev_ern <= 1500 ? 1500 - $prev_ern : 0;
                }
                $userController->direct_earning($user->sponser_id, $amount);
            }

            $user->update($request->toArray());

            if(!empty($transaction)){
                Mail::to($user->email)->send(new AccountUpgrade($user->username, $user->account_bal->name));
                return response()->json([
                    'success' => true,
                    'message' => "Account Upgraded Successfully",
                ]);
            }
        }


        return response()->json([
            'success' => false,
            'message' => "Account Not Upgraded Due To Insuficient Balance",
        ]);


    }
}
