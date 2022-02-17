<?php

namespace App\Http\Controllers\Admin;

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
use Alert;

class MoneyRequestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('money_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $moneyRequests = MoneyRequest::with(['delegate', 'target'])->get();

        return view('admin.moneyRequests.index', compact('moneyRequests'));
    }

    public function create()
    {
        abort_if(Gate::denies('money_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delegates = Delegate::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $targets = Target::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        //return view('admin.moneyRequests.create', compact('delegates', 'targets'));
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
                    'status' => $request->status,
                    'delegate_id' => $request->delegate_id,
                    'target_id' => $request->target_id,
                ]);
                Alert::success('تم أضافة طلب السحب بنجاح');
            }
            return redirect()->route('admin.delegates.show',$request->delegate_id);
        }else{
            Alert::error('حدث خطأ');
            return redirect()->route('admin.delegates.show',$request->delegate_id);
        } 

        return redirect()->route('admin.money-requests.index');
    }

    public function edit(MoneyRequest $moneyRequest)
    {
        abort_if(Gate::denies('money_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delegates = Delegate::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $targets = Target::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $moneyRequest->load('delegate', 'target');

        if($moneyRequest->status != 'pending'){
            Alert::error('Cant edit');
            return redirect()->route('admin.money-requests.index');
        }
        return view('admin.moneyRequests.edit', compact('delegates', 'moneyRequest', 'targets'));
    }

    public function update(UpdateMoneyRequestRequest $request, MoneyRequest $moneyRequest)
    {
        $moneyRequest->update($request->all());

        return redirect()->route('admin.money-requests.index');
    }

    public function show(MoneyRequest $moneyRequest)
    {
        abort_if(Gate::denies('money_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $moneyRequest->load('delegate', 'target');

        return view('admin.moneyRequests.show', compact('moneyRequest'));
    }

    public function destroy(MoneyRequest $moneyRequest)
    {
        abort_if(Gate::denies('money_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($moneyRequest->status != 'pending'){
            Alert::error('Cant Delete');
            return redirect()->route('admin.money-requests.index');
        }
        $moneyRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyMoneyRequestRequest $request)
    {
        MoneyRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}