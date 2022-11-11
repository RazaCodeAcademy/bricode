<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class GenericValidations
{
    public static function commonValidation($request,$validationAttribute)
    {
        $validator = Validator::make($request->all(), [
            $validationAttribute => 'required',
        ]);
        if ($validator->fails()) {
            return $validator;
        }
    }
    public static function RegisterUser($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email:rfc,dns|unique:users,email,',
                'password' => 'required|min:6',
            ],
            [
                'email.required' => 'Email is required!',
                'password.required' => 'Password is required!',
            ]
        );
        if ($validator->fails()) {
            return $validator;
        }
    }
    public static function Login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>'required|email:rfc,dns',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $validator;
        }
    }
    public static function storecard($request){
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'website'=> 'required',
            'position_name'=> 'required',
            'mobile_no' => 'required',
            'email' =>'required|email:rfc,dns',
            'city' =>'required',
            'province' =>'required',
            'country' =>'required',
            'postal_code' => 'required|regex:/^[0-9]{3,7}$/',
            'address' =>'required',
        ]);
        if ($validator->fails()) {
            return $validator;
        }
    }
    public static function storeproduct($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator;
        }
    }
    public static function storeteam($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator;
        }
    }

    public static function edituser($request){
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile_number' => 'required|unique:users,mobile_number,' . user()->id,
                'email' => 'required|email|unique:users,email,'. user()->id.'id',
                'password' => 'required',
                'title' => 'required_if:user_type,==,2',
                'web_url'=> 'required_if:user_type,==,2',
                'position'=> 'required_if:user_type,==,2',
                'business_type'=> 'required_if:user_type,==,2',
                'industry_id' => 'required_if:user_type,==,2',
                'emp_no_id' => 'required_if:user_type,==,2',
                'branch_id' => 'required_if:user_type,==,2',
                'headquater_id' => 'required_if:user_type,==,2',
            ],
        );
        if ($validator->fails()) {
            return $validator;
        }
    }
}
