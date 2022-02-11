<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\District;
use App\Models\City;
use Alert; 
use Hash;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();
        $districts = District::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        return view('frontend.profile.settings',compact('user','districts','cities'));
    }    

    public function profile_update(Request $request){
        $user = Auth::user();
        $user->update($request->all());
        Alert::success('تم التعديل بنجاح');
        return redirect()->route('frontend.profile');
    }    

    public function update_password(Request $request){
        
        $this->validate($request,[
            'password'=>'required|min:6|confirmed',
        ]); 

        $user = Auth::user();  
        $hashedPassword = $user->password;
        if(!\Hash::check($request->old_password, $hashedPassword) && $user->password != null){
            Alert::error('كلمة السر الحالة غير صحيحة');
            return redirect()->route('frontend.profile');
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
            Alert::success('تم التعديل بنجاح');
            return redirect()->route('frontend.profile');
        } 
    }
}
