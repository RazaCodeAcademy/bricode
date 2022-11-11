<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class IndexController extends Controller
{
    public function index(Request $request){
        $user = User::where('username', $request->search)->first();
        return view('frontend.pages.sponser', compact('user'));
    }

    
}