<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\City;
use App\Models\District;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function update_approved(Request $request){
        $user = User::find($request->id);
        $user->approved = $request->status;
        $user->save();
        return 1; 
    }
    
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['district', 'city', 'roles', 'media'])->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('cities', 'districts', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        Alert::success('تم بنجاح', 'تم إضافة المستخدم بنجاح ');
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        $user->load('district', 'city', 'roles');

        return view('admin.users.edit', compact('cities', 'districts', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
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
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('district', 'city', 'roles', 'userProductRates', 'userOfferRates', 'userOrders', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        Alert::success('تم بنجاح', 'تم  حذف المستخدم بنجاح ');
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
