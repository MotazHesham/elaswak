<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTargetRequest;
use App\Http\Requests\StoreTargetRequest;
use App\Http\Requests\UpdateTargetRequest;
use App\Models\Delegate;
use App\Models\Target; 
use App\Models\MoneyRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TargetsController extends Controller
{ 

    public function index()
    {
        abort_if(Gate::denies('target_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $targets = Target::with(['delegates'])->get();

        return view('admin.targets.index', compact('targets'));
    }

    public function create()
    {
        abort_if(Gate::denies('target_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delegates = Delegate::with('user')->get()->pluck('user.name', 'id');

        return view('admin.targets.create', compact('delegates'));
    }

    public function store(StoreTargetRequest $request)
    {
        $target = Target::create($request->all());
        $target->delegates()->sync($request->input('delegates', []));

        return redirect()->route('admin.targets.index');
    }

    public function edit(Target $target)
    {
        abort_if(Gate::denies('target_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delegates = Delegate::with('user')->get()->pluck('user.name', 'id');

        $target->load('delegates');

        return view('admin.targets.edit', compact('delegates', 'target'));
    }

    public function update(UpdateTargetRequest $request, Target $target)
    {
        $target->update($request->all());
        $target->delegates()->sync($request->input('delegates', []));

        return redirect()->route('admin.targets.index');
    }

    public function show(Target $target)
    {
        abort_if(Gate::denies('target_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $target->load('delegates');

        return view('admin.targets.show', compact('target'));
    }

    public function destroy(Target $target)
    {
        abort_if(Gate::denies('target_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $target->delete();

        return back();
    }

    public function massDestroy(MassDestroyTargetRequest $request)
    {
        Target::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}