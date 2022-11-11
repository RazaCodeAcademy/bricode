<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use facades
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// use mails
use App\Mail\AccountUpgrade;

// use models
use App\Models\User;
use App\Models\ModelHasRole;
use App\Models\Role;
use App\Models\Hit;
use App\Models\HitBonus;
use App\Models\Point;
use App\Models\PaymentMethod;
use App\Models\AccountType;
use App\Models\UserSponser;
use App\Models\PhasePairing;
use App\Models\DirectEarning;
use App\Models\TotalEarning;
use App\Models\IndirectEarning;
use App\Models\CurrentEarning;
use App\Models\Withdraw;

class UserController extends Controller
{
    public function listAdmins()
    {
        $account_types = AccountType::orderBy('id', 'desc')->get();
        $users = User::whereHas(
            'roles', function($q){
                $q->where('role_id', '2');
            })->orderby('created_at','desc')->get();

        return view('backend.pages.user.list', compact('users','account_types'));
    }
    public function listEmployers()
    {
        $users= User::whereHas(
            'roles', function($q){
                $q->where('role_id', '2');
            })->orderby('created_at','desc')->get();

        return view('backend.pages.user.list', compact('users'));
    }

    public function createUser()
    {
        $payment_methods = PaymentMethod::all();
        return view('backend.pages.user.create', compact('payment_methods'));
    }

    public function storeUser(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'cnic' => 'required',
            'payment_process' => 'required',
            'sponser_id' => 'required',
            'password' => [
                'required',
            ],
        ];

        $messages = [
            'password.regex' => 'Password must be one capital one small, one special character and one number'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $request['password'] = bcrypt($request->password);

        $user = User::create($request->toArray());

        $data1=array('role_id'=>'2',"model_type"=>'App\Models\User',"model_id"=>$user->id);
        ModelHasRole::insert($data1);
        $sponser = User::where('username', $request->sponser_id)->first();
        $user->sponser_id = $sponser ? $sponser->id : '-';
        $user->save();

        return redirect()->route('listAdmins')->with('success', 'Record Added Successfully.');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $payment_methods = PaymentMethod::all();
        if($user == null)
        {
            return redirect()->route('listUsers')->with('error', 'No Record Found.');
        }

        return view('backend.pages.user.edit', compact('user','payment_methods'));
    }

    public function updateUser(Request $request,$id)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|max:255',
            'email' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'cnic' => 'required',
            'payment_process' => 'required',
            'sponser_id' => 'required',
        ];

        if($request->password){
            $rules['password'] = [
            'required',
        ];
        }
        $messages = [
            'password.regex' => 'Password must be one capital one small, one special character and one number'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $request['password'] = bcrypt($request->password);
        $user = User::find($id);
        $user->update($request->toArray());

        $sponser = User::where('username', $request->sponser_id)->first();
        $user = User::find($id);
        $user->sponser_id = $sponser ? $sponser->id : '-';
        $user->save();

        return redirect()->route('listAdmins')->with('success', 'Record Updated Successfully.');
    }

    public function deleteUser(Request $request){
        $user =User::where('id',$request->id)->first();

        if(empty($user)) {
            return response()->json(['status' => 0]);
        }

       User::where('id',$request->id)->delete();
       ModelHasRole::where('model_id',$request->id)->delete();

        return response()->json(['status' => 1]);
    }

    public function viewUser($id)
    {
        $user = User::where('id', $id)
        ->whereHas(
            'roles', function($q){
                $q->where('name', 'admin')->orwhere('name', 'employer')->orwhere('name','employee');
            })->orderby('created_at','desc')->first();

        if($user == null)
        {
            return redirect()->route('listUsers')->with('error', 'No Record Found.');
        }

        return view('backend.pages.user.view', compact('user'));
    }

    public function account_type(Request $request, $id)
    {

        $request['account_type'] = $request->account_type;
        $user = User::find($id);

        $sponser = User::find($user->sponser_id);
        if(empty($sponser)){
            return response()->json([
                'success' => true,
                'message' => "Your Sponser is no more longer please select new sponser for yourself!",
            ]);
        }

        $amount = 0;

        $account = AccountType::find($request->account_type);

        $isValidUpgradation = $user->account_bal ? $account->price <= $user->account_bal->price : false;
        if($isValidUpgradation){
            return response()->json([
                'success' => false,
                'message' => "Your can not upgrade this account anymore!",
            ]);
        }

        $sponser_account_price = $sponser->account_bal ? $sponser->account_bal->price : 0;
        $prev_ern = prev_earn( $user->account_bal ?  $user->account_bal->id : "");

        if($account->price <= $sponser_account_price || $sponser_account_price == 0){
            if($account->id == 1){
                $amount= 500 - $prev_ern;
            }elseif($account->id == 2){
                $amount= 750 - $prev_ern;
            }elseif($account->id == 3){
                $amount= 1200 - $prev_ern;

            }elseif($account->id == 4){
                $amount= 1500 - $prev_ern;
            }
            $this->direct_earning($user->sponser_id, $amount);
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
            $this->direct_earning($user->sponser_id, $amount);
        }
        $user->update($request->toArray());
        $user = User::find($id);
        Mail::to($user->email)->send(new AccountUpgrade($user->username, $user->account_bal->id));

        return response()->json([
            'success' => true,
            'message' => "Account updated successfuly!",
        ]);

    }

    public function direct_earning($sponser_id, $amount)
    {
        $direct_earning = DirectEarning::where('user_id', $sponser_id )->whereDate('created_at', Carbon::today())->first();
        if($direct_earning){
            $direct_earning->amount += $amount;
            $direct_earning->save();
        }else{
            $direct_earning = DirectEarning::create([
                'user_id' => $sponser_id,
                'amount' => $amount,
            ]);
        }
        $this->total_earning($sponser_id, $amount);
        $this->earn_current($sponser_id, $amount);
    }

    public function indirect_earning($sponser_id)
    {
        $earning = IndirectEarning::where('user_id', $sponser_id)->whereDate('created_at', Carbon::today())->first();
        if($earning){
            $earning->amount += 2;
            $earning->save();
        }else{
            $earning = IndirectEarning::create([
                'user_id' =>  $sponser_id,
                'amount'=> 2,
            ]);
        }

        $this->total_earning($sponser_id, 2);
    }

    public function total_earning($sponser_id, $amount)
    {
        $total_earning = TotalEarning::where('user_id', $sponser_id)->first();
        if($total_earning){
            $total_earning->amount += $amount;
            $total_earning->save();
        }else{
            $total_earning = TotalEarning::create([
                'user_id' => $sponser_id,
                'amount' => $amount,
            ]);
        }

        $withdraw_amount = Withdraw::where('user_id', $sponser_id)->sum('amount');

        $this->earn_points($sponser_id, $total_earning->amount);

        $sponser = User::find($sponser_id);
        if(empty($sponser)){
            return response()->json([
                'success' => true,
                'message' => "Your Sponser is no more longer please select new sponser for yourself!",
            ]);
        }

        if($sponser->account_bal){
            if($sponser->account_bal->id == 4){
                $this->earn_hits($sponser_id, $total_earning->amount - $withdraw_amount);
            }
        }
    }

    public function earn_points($sponser_id, $amount)
    {
        $point = Point::where('user_id', $sponser_id)->whereDate('created_at', Carbon::today())->first();
        $points = Point::where('user_id', $sponser_id)->sum('number');
        $remain_amount = $amount - (500*$points);
        $mod_amount = ($remain_amount % 500);
        $points = (($remain_amount - $mod_amount)/500);
        if($point){
            $point->number += $points;
            $point->save();
        }else{
            $point = Point::create([
                'user_id' => $sponser_id,
                'number' => $points,
            ]);
        }
    }

    public function earn_hits($sponser_id, $amount)
    {
        $hit = Hit::where('user_id', $sponser_id)->first();
        $hits = Hit::where('user_id', $sponser_id)->sum('number');
        $remain_amount = $amount - (2000*$hits);
        $mod_amount = ($remain_amount % 2000);
        $hits = (($remain_amount - $mod_amount)/2000);
        $total_earning = TotalEarning::where('user_id', $sponser_id)->first();
        $total_earning->amount += $hits*200;
        $total_earning->save();
        if($hit){
            $hit->number += $hits;
            $hit->save();
        }else{
            $hit = Hit::create([
                'user_id' => $sponser_id,
                'number' => $hits,
            ]);
        }

        $this->earn_hit_bonus($sponser_id, $hit->number);
    }

    public function earn_hit_bonus($sponser_id, $hits)
    {
        $hitbonus = HitBonus::where('user_id', $sponser_id)->first();
        if($hitbonus){
            $hitbonus->amount = $hits*200;
            $hitbonus->save();
        }else{
            HitBonus::create([
                'user_id' => $sponser_id,
                'amount' => $hits*200,
            ]);
        }
    }
    public function earn_current($sponser_id, $amount)
    {
        $current = CurrentEarning::where('user_id', $sponser_id)->first();
        if($current){
            $current->amount += $amount;
            $current->save();
        }else{
            CurrentEarning::create([
                'user_id' => $sponser_id,
                'amount' => $amount,
            ]);
        }
    }

    public function edit()
    {
        return view('backend.pages.profile.index');
    }

    public function general_information(Request $request)
    {
        $user = User::find(user()->id)->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);

        if ($request->hasfile('image')) {
            $file_type = $request->file('image')->getMimeType();
            $path = $request->file('image')->store('admins', 'public');
            upload_image($path, user()->id, User::class);
        }
        return back()->with('success', 'Profile Updated Successfuly!');
    }

    public function change_password(Request $request)
    {
        $user = User::find(user()->id)->update([
            'password'    => bcrypt($request->passwrod),
        ]);
        return back()->with('success', 'Password Updated Successfuly!');
    }
}
