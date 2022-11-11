<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use models
use App\Models\Job;
use App\Models\User;
use App\Models\EmployeeAppliedJob;
use App\Models\Country;
use App\Models\AccountType;
use App\Models\PaymentMethod;
use App\Models\EmployeeBussinessCategory;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $transactions = Transaction::where('status', 1)->sum('amount');
        $users = User::all()->count();
        $accounts = AccountType::all()->count();
        $payments = PaymentMethod::all()->count();
        return view('backend.pages.dashboard.index',
            compact('users','accounts','payments','transactions')
        );
    }

    public function filterCountry(Request $request)
    {
        if ($request->country_id == 0)
        {
            $liveJobs = DB::table('jobs')->where('status','=',1)->where('approval_status','=',1)->count();
            $liveAppliedCandidateJobs = DB::table('candidate_applied_jobs')->count();
            $candidates = DB::table('model_has_roles')->select('model_id')->where('role_id','=','3')->count();
            $employers = DB::table('model_has_roles')->select('model_id')->where('role_id','=','2')->count();

            $data = [$liveJobs,$liveAppliedCandidateJobs,$candidates,$employers];

            return response()->json(['values'=>$data]);
        }

        else
        {
            $liveJobs = DB::table('jobs')->where('status','=',1)->where('approval_status','=',1)->where('job_location', $request->country_id)->count();
            $liveAppliedCandidateJobs = DB::table('candidate_applied_jobs')
                ->join('jobs','candidate_applied_jobs.job_id','=','jobs.id')
                ->where('jobs.status','=',1)
                ->where('jobs.approval_status','=',1)
                ->where('jobs.job_location','=',$request->country_id)
                ->count();

            $candidates = DB::table('model_has_roles')
                ->join('users','model_has_roles.model_id','=','users.id')
                ->where('model_has_roles.role_id','=',3)
                ->where('users.country_name','=',$request->country_id)
                ->count();

            $employers = DB::table('model_has_roles')
                ->join('users','model_has_roles.model_id','=','users.id')
                ->where('model_has_roles.role_id','=',2)
                ->where('users.country_name','=',$request->country_id)
                ->count();

            $data = [$liveJobs,$liveAppliedCandidateJobs,$candidates,$employers];

            return response()->json(['values'=>$data]);
        }

    }

}
