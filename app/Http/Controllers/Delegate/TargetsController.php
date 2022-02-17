<?php

namespace App\Http\Controllers\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTargetRequest;
use App\Http\Requests\StoreTargetRequest;
use App\Http\Requests\UpdateTargetRequest;
use App\Models\Delegate;
use App\Models\Target;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class TargetsController extends Controller
{
    public function index(){
        
        $delegate = Delegate::with('delegateTargets')->where('user_id',Auth::id())->first(); 
        return view('delegate.targets.index', compact('delegate'));
    } 

    public function show(Target $target)
    { 

        $target->load('delegates');

        return view('delegate.targets.show', compact('target'));
    } 
}