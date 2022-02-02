<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('frontend.profile.settings',compact('user'));
    }    
}
