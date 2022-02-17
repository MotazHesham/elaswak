<?php

namespace App\Http\Controllers\Delegate;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Delegate; 
use Auth;

class HomeController
{
    public function index()
    { 
        $delegate = Delegate::with('delegateTargets')->where('user_id',Auth::id())->first(); 
        return view('delegate.home', compact('delegate')); 
    }
}
