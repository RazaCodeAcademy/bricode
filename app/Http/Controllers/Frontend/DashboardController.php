<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use facades
use Hash;
use Session;
use Carbon\Carbon;
use Storage;
// use Illuminate\Support\Facades\File;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Photos\Facades\Image;


use Illuminate\Support\Facades\Validator;

// use models
use App\Models\User;
use App\Models\Hit;
use App\Models\HitBonus;
use App\Models\Job;
use App\Models\Point;
use App\Models\Transaction;
use App\Models\IndirectEarning;
use App\Models\DirectEarning;
use App\Models\TotalEarning;
use App\Models\UserSponser;
use App\Models\CurrentEarning;
use App\Models\Withdraw;

class DashboardController extends Controller
{
    public function index(request $request)
    {
        $transaction = Transaction::where('sender_id', Auth::user()->id)->first();
        $withdraw_amount = Withdraw::where('user_id', Auth::user()->id)->sum('amount');
        $total_earning = TotalEarning::where('user_id', Auth::user()->id)->first();
        $current_earning = CurrentEarning::where('user_id', Auth::user()->id)->sum('amount');
        $earn_points = Point::where('user_id', Auth::user()->id)->sum('number');
        $list_points = Point::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->take(5)->get();
        $today_earn_points = Point::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->first();
        $hits = Hit::where('user_id', Auth::user()->id)->sum('number');
        $hit_bonus = HitBonus::where('user_id', Auth::user()->id)->sum('amount');

        $data1 = DirectEarning::selectRaw("COUNT(*) as earnings, DATE_FORMAT(created_at, '%Y-%m-%d') date, SUM(amount) as amount" )
        ->orderBy('date', 'desc')
        ->groupBy('date')
        ->where('user_id', Auth::Id())
        ->take(7)->get();

        $refferals = User::selectRaw("COUNT(*) as refferals, DATE_FORMAT(created_at, '%Y-%m-%d') date")
        ->orderBy('date', 'desc')
        ->groupBy('date')
        ->where('sponser_id', Auth::Id())
        ->take(7)->get();

        if($total_earning){
            $total_earning = $total_earning ? $total_earning->amount : 0;
        }

        $seven_day_earn = $data1 ? $data1->sum('amount') : 0;

        $total_earning_analytics = [];
        foreach ($data1 as $key => $value1) {
            $total_earning_analytics[] = array(
                'x'=>$value1->date, 'y'=>[$value1->amount,rand(0,1000),rand(0,500),$value1->amount+rand(0,500)]
            );
        }

        $refferal_analytics = [];
        foreach ($refferals as $key => $value) {
            $refferal_analytics[] = array(
                'x'=>$value->date, 'y'=>[$value->refferals, 0, 5, 9]
            );
        }

        return view('frontend.pages.dashboard.index', compact(
            'transaction',
            'withdraw_amount',
            'earn_points',
            'total_earning',
            'list_points',
            'hits',
            'hit_bonus',
            'today_earn_points',
            'refferal_analytics',
            'total_earning_analytics',
            'current_earning',
            'seven_day_earn'
        ));
    }

    // Employee Details
    public function updateEmployeeDetailsPage(request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();

            $profileFolder = 'profile';
            if (!Storage::exists($profileFolder)) {
                Storage::makeDirectory($profileFolder);
            }

            // upload file
            if ($request->hasFile('profile_image')) {
                $image = Storage::putFile($profileFolder, new File($request->file('profile_image')));
                $data['profile_image'] = $image;
            }

            // add user data into array
            $user_data = [
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'phone_number'         => $data['phone_number'],
                'email'      => $data['email'],
            ];

             $user = User::find(user()->id)->update($user_data);
             if($user){
                Image::upload($request->image, 'user',user()->id, User::class);
                 return redirect()->route('dashboard')->with('success', 'Profile Updated Successfully!');
             }

        }

        return view('frontend.pages.userprofile.profile');
    }

    public function settings()
    {
        return view('frontend.pages.userprofile.settings');
    }

    // Employee Check Password is Correct or Not
    public function chkCurrentpassword(request $request){
        $data=$request->all();
        if(Hash::check($data['current_pwd'],Auth::user()->password)){
            return "true";
        }
        else{
            return "false";
        }
    }

    // Employee Update Password
    public function updatepassword(request $request)
    {
        $data=$request->all();
        // check if the the current password is correct
        if(Hash::check($data['current_pwd'],Auth::user()->password)){
            // Check if new password is matching
        if($data ['new_pwd'] == $data['confirm_pwd']){
            User::where('id',Auth::user()->id)->update(
                ['password'=>bcrypt($data['new_pwd'])
            ]);
            session::flash('success_message', 'your password has been updated Successfully');
        }else{
            session::flash('error_message', 'New password and Confirm passwrd is not match');
        }
        }else{
        session::flash('error_message', 'your current passwod is uncorrect');
        }
        return redirect()->back();
    }

    //  Employee Notification
    public function notifications()
    {
        $notifications = unserialized_notification(user()->get_notification);
        return view('frontend.pages.userprofile.notifications', compact('notifications'));
    }
}
