<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupplierRequest;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Models\User;
use App\Models\City;
use App\Models\District;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use Alert;

class SuppliersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('supplier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Supplier::with(['user'])->get();

        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $name = 'name_' . app()->getLocale();
        $districts = District::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), ''); 

        return view('admin.suppliers.create', compact('districts'));
    }

    public function store(StoreSupplierRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'supplier', 
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

        $supplier = Supplier::create([ 
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'commerical_num' => $request->commerical_num,
            'commerical_expiry' => $request->commerical_expiry,
            'licence_num' => $request->licence_num,
            'licence_expiry' => $request->licence_expiry,
        ]);

        Alert::success('تم بنجاح', 'تم إضافة المستخدم بنجاح ');
        return redirect()->route('admin.suppliers.index');
    }

    public function edit(Supplier $supplier)
    {
        abort_if(Gate::denies('supplier_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $name = 'name_' . app()->getLocale();
        
        $districts = District::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), '');

        $supplier->load('user');

        return view('admin.suppliers.edit', compact('supplier', 'districts','cities'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update([ 
            'company_name' => $request->company_name,
            'commerical_num' => $request->commerical_num,
            'commerical_expiry' => $request->commerical_expiry,
            'licence_num' => $request->licence_num,
            'licence_expiry' => $request->licence_expiry,
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
        return redirect()->route('admin.suppliers.index');
    }

    public function show(Supplier $supplier)
    {
        abort_if(Gate::denies('supplier_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplier->load('user', 'supplierProducts', 'supplierOffers');

        return view('admin.suppliers.show', compact('supplier'));
    }

    public function destroy(Supplier $supplier)
    {
        abort_if(Gate::denies('supplier_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplier->delete();

        Alert::success('تم بنجاح', 'تم  حذف المستخدم بنجاح ');
        return back();
    }

    public function massDestroy(MassDestroySupplierRequest $request)
    {
        Supplier::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
