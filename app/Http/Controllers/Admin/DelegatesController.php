<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDelegateRequest;
use App\Http\Requests\StoreDelegateRequest;
use App\Http\Requests\UpdateDelegateRequest;
use App\Models\Delegate;
use App\Models\City;
use App\Models\District;
use App\Models\User; 
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use Spatie\MediaLibrary\Models\Media;
use Alert;

class DelegatesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('delegate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delegates = Delegate::with(['user'])->get();

        return view('admin.delegates.index', compact('delegates'));
    }

    public function create()
    {
        abort_if(Gate::denies('delegate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $name = 'name_' . app()->getLocale();
        $districts = District::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), ''); 

        return view('admin.delegates.create', compact('districts'));
    }

    public function store(StoreDelegateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'delegate', 
            'phone' => $request->phone,  
            'district_id' => $request->district_id,  
            'city_id' => $request->city_id,  
            'zip_code' => $request->zip_code,  
            'address' => $request->address,  
        ]);  
        
        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $delegate = Delegate::create([
            'user_id' => $user->id,
            'discount_code' => $request->discount_code,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ]); 

        Alert::success('تم بنجاح', 'تم إضافة المستخدم بنجاح ');
        return redirect()->route('admin.delegates.index');
    }

    public function edit(Delegate $delegate)
    {
        abort_if(Gate::denies('delegate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $name = 'name_' . app()->getLocale();

        $districts = District::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), '');

        $delegate->load('user');

        return view('admin.delegates.edit', compact('delegate', 'districts', 'cities'));
    }

    public function update(UpdateDelegateRequest $request, Delegate $delegate)
    {
        $delegate->update([
            'discount_code' => $request->discount_code,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ]);

        $user = User::find($request->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone,   
            'last_name' => $request->last_name,  
            'district_id' => $request->district_id,  
            'city_id' => $request->city_id,  
            'zip_code' => $request->zip_code,  
            'address' => $request->address,  
        ]);

        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }
        
        Alert::success('تم بنجاح', 'تم تعديل بيانات المستخدم بنجاح ');
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

        Alert::success('تم بنجاح', 'تم  حذف المستخدم بنجاح ');
        return back();
    }

    public function massDestroy(MassDestroyDelegateRequest $request)
    {
        Delegate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
