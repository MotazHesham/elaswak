<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDelegateRequest;
use App\Http\Requests\StoreDelegateRequest;
use App\Http\Requests\UpdateDelegateRequest;
use App\Models\Delegate;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DelegatesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('delegate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delegates = Delegate::with(['user'])->get();

        return view('admin.delegates.index', compact('delegates'));
    }

    public function create()
    {
        abort_if(Gate::denies('delegate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.delegates.create', compact('users'));
    }

    public function store(StoreDelegateRequest $request)
    {
        $delegate = Delegate::create($request->all());

        return redirect()->route('admin.delegates.index');
    }

    public function edit(Delegate $delegate)
    {
        abort_if(Gate::denies('delegate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $delegate->load('user');

        return view('admin.delegates.edit', compact('delegate', 'users'));
    }

    public function update(UpdateDelegateRequest $request, Delegate $delegate)
    {
        $delegate->update($request->all());

        return redirect()->route('admin.delegates.index');
    }

    public function show(Delegate $delegate)
    {
        abort_if(Gate::denies('delegate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delegate->load('user');

        return view('admin.delegates.show', compact('delegate'));
    }

    public function destroy(Delegate $delegate)
    {
        abort_if(Gate::denies('delegate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delegate->delete();

        return back();
    }

    public function massDestroy(MassDestroyDelegateRequest $request)
    {
        Delegate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
