<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\User;
use App\Models\City;
use App\Models\District;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 
use App\Http\Controllers\Traits\MediaUploadingTrait;  
use Alert;

class ClientsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::with(['user'])->get();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $name = 'name_' . app()->getLocale();
        $districts = District::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), ''); 

        return view('admin.clients.create', compact('districts'));
    }

    public function store(StoreClientRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'client', 
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

        $client = Client::create([
            'user_id' => $user->id,
        ]);

        Alert::success('تم بنجاح', 'تم إضافة المستخدم بنجاح ');
        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $name = 'name_' . app()->getLocale();
        
        $districts = District::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), '');

        $client->load('user');

        return view('admin.clients.edit', compact('client', 'districts','cities'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    { 
        
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
        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('user');

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        Alert::success('تم بنجاح', 'تم  حذف المستخدم بنجاح ');
        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
