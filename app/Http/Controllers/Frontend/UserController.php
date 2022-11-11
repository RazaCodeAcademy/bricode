<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use facades
use beinmedia\payment\Parameters\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Photos\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

// use mails
use App\Mail\UserRegistration;

// use models
use App\Models\User;
use App\Models\UserSponser;
use App\Models\IndirectEarning;
use App\Models\ModelHasRole;
use App\Models\PhasePairing;
use App\Models\Role;
use Carbon\Carbon;
use App\Models\PaymentMethod;

class UserController extends Controller
{
    public function create()
    {
        $payment_methods = PaymentMethod::all();
        $username = User::find(1)->username;

        return view('frontend.pages.auth.register',compact('payment_methods', 'username'));
    }

    public function store(Request $request){
        // dd($request);

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users,email',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|unique:users,phone_number',
            'cnic' => 'required',
            'payment_process' => 'required',
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

        $userCount = User::where('email', $request->email)->count();

        if ($userCount > 0){
            // dd( $userCount);
            $notification = array(
                'error' => 'Email Already Exists!',
                );
            return redirect()->back()->with($notification);
        }
        else{
            $sponser = User::where('username' ,$request->sponser_id)->first();
            if(empty($sponser->account_bal) && $request->sponser_id != $request->username){
                $notification = array(
                'error' => "The Promo ID isn't Valid",
                );
                return redirect()->back()->with($notification);
            }

            $user = $this->register($request);

            $notification = array(
            'success' => 'User Register Successfully!',
            );
            $data1=array('role_id'=>'2',"model_type"=>'App\Models\User',"model_id"=>$user->id);
            ModelHasRole::insert($data1);

        }


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            return redirect()->route('dashboard')->with($notification);
        }

    }
public function register($request)
{
    $sponser = User::where('username', $request->sponser_id)->first();
    $data =[
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'username' => $request->username,
        'email' => $request->email,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'phone_number' => $request->phone_number,
        'cnic' => $request->cnic,
        'payment_process' => $request->payment_process,
        'sponser_id' => $request->sponser_id == $request->username ? "-" : $sponser->id,
        'password' => bcrypt($request->password),
    ];
    $user= User::create($data);
    if($user){
        if($request->sponser_id == $request->username){
            $user->sponser_id = $user->id;
            $user->update();
        }
        Mail::to($user->email)->send(new UserRegistration($user->username));
        if($request->hasfile('image')){
            $path = $request->file('image')->store('user', 'public');
            upload_image($path, $user->id, User::class);
        }
    }

    return $user;
}


    public function login()
    {

        if(Auth::check()){

            if (Auth::user()->hasRole('admin'))
            {
                return redirect()->route('admin.dashboard');
            }
            elseif (Auth::user()->hasRole('employer'))

            {
               return redirect()->route('employerDashboard');
            }
            elseif (Auth::user()->hasRole('customer'))
            {
                return redirect()->route('dashboard');
            }
        }
        return view('frontend.pages.login');
    }

    public function loginuser(Request $request){
        $rules = array(
            'email' => 'required',
            'password' => 'required'
        );

      $validator = Validator::make($request->all() , $rules);

          if ($validator->fails())
          {
              return \redirect()->route('login')->withErrors($validator)->withInput();
          }
          else
            {
                $user_with_email_data = array(
                    'email' => $request->email,
                    'password' => $request->password,
                );

                $user_with_username_data = array(
                    'username' => $request->email,
                    'password' => $request->password,
                );

            if (Auth::attempt($user_with_email_data) || Auth::attempt($user_with_username_data))
            {
                $user = Auth::getProvider()->retrieveByCredentials($user_with_email_data);
                $user = Auth::getProvider()->retrieveByCredentials($user_with_username_data);

                // Auth::login($user, $request->get('remember'));

                // return $this->authenticated($request, $user);
                    if (Auth::user()->hasRole('admin'))
                    {

                        $notification = array(
                            'success' => 'Login Successfully!',
                            );
                        return redirect()->route('admin.dashboard')->with($notification);
                    }
                    elseif (Auth::user()->hasRole('customer'))
                    {
                        $notification = array(
                            'success' => 'Login Successfully!',
                            );
                        return redirect()->route('dashboard')->with($notification);
                    }
                }
                else
                {
                    $notification = array(
                        'error' => 'These Credentailas does not match to your recodes!',
                        );
                    return \redirect()->route('login')->with($notification);
                }
        }
    }

    public function logout()
    {
        // Auth::user()->last_login = Carbon::now()->toDateTimeString();
        // Auth::user()->update();
        Auth::logout();
        $notification = array(
        'success' => 'logout Successfully!',
        );
        return redirect()->route('login');
        // return redirect()->to('https://starmultinational.com/');
    }

    public function profile($id)
    {
        $username =User::find($id)->username;
        $payment_methods = PaymentMethod::all();
       return view('frontend.pages.auth.register',compact('payment_methods', 'username'));
    }

    public function phase_pairing($sponser_id, $phase_no)
    {
        $phases = UserSponser::where('sponser_id', $sponser_id)->where('phase_no', $phase_no)->get();
        $left = $phases->where('placement', 1)->count();
        $right = $phases->where('placement', 2)->count();
        $phase_pairing = PhasePairing::where('user_id', $sponser_id)->where('phase_no', $phase_no)->first();
        $placements = 0;
        if($left > $right){
            $placements = ($left - ($left - $right));
        }elseif($left < $right){
            $placements = ($right - ($right - $left));
        }else{
            $placements = $right;
        }
        if($phase_pairing){
            if($phase_pairing->pair < $placements){
                $phase_pairing->pair += 1;
                $phase_pairing->save();
            }
        }else{
            if($placements > 0){
                PhasePairing::create([
                    'user_id' => $sponser_id,
                    'phase_no' => $phase_no,
                    'pair' => $placements,
                ]);
            }
        }
    }

    public function edit()
    {
        return view('frontend.pages.profile.index');
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
