<?php

namespace App\Http\Controllers\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMoneyRequestRequest;
use App\Http\Requests\StoreMoneyRequestRequest;
use App\Http\Requests\UpdateMoneyRequestRequest;
use App\Models\Delegate;
use App\Models\MoneyRequest;
use App\Models\Target;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 
use Auth;
use Alert;

class MoneyRequestController extends Controller
{
    public function index()
    { 

        $delegate = Delegate::where('user_id',Auth::id())->first();
        
        $moneyRequests = MoneyRequest::where('delegate_id',$delegate->id)->with(['delegate', 'target'])->get();

        return view('delegate.moneyRequests.index', compact('moneyRequests'));
    } 

    public function store(StoreMoneyRequestRequest $request)
    { 
        $delegate = Delegate::findOrFail($request->delegate_id);
        $target = $delegate->delegateTargets()->wherePivot('target_id',$request->target_id)->first();
        if($target){
            if(MoneyRequest::whereIn('status',['done','pending'])->where('delegate_id',$request->delegate_id)->where('target_id',$request->target_id)->first()){
                Alert::warning('لم تتم الأضافة','تم طلب سحب لهذا الهدف من قبل');
            }else{ 
                $moneyRequest = MoneyRequest::create([
                    'amount' => $target->pivot->profit,
                    'description' => $request->description,
                    'status' => 'pending',
                    'delegate_id' => $request->delegate_id,
                    'target_id' => $request->target_id,
                ]);
                Alert::success('تم أضافة طلب السحب بنجاح');
            }
            return redirect()->route('delegate.money-requests.index',$request->delegate_id);
        }else{
            Alert::error('حدث خطأ');
            return redirect()->route('delegate.money-requests.index',$request->delegate_id);
        }  
    }  

    public function show(MoneyRequest $moneyRequest)
    { 

        $moneyRequest->load('delegate', 'target');

        return view('delegate.moneyRequests.show', compact('moneyRequest'));
    }

    public function destroy(MoneyRequest $moneyRequest)
    { 

        $moneyRequest->delete();

        if($moneyRequest->status != 'pending'){
            Alert::error('Cant Delete');
            return redirect()->route('delegate.money-requests.index');
        }
        return back();
    } 
}