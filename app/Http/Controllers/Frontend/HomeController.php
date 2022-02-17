<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Service;
use App\Models\District;
use App\Models\City;
use App\Models\Client;
use App\Models\Delegate;
use App\Models\Supplier;
use App\Models\User;
use App\Http\Requests\Frontend\StoreClientRequest;
use App\Http\Requests\Frontend\StoreDelegateRequest;
use Alert;

class HomeController extends Controller
{
    public function index(){
        $now_date = date('Y-m-d',strtotime('now')); 
        
        $categories = ProductCategory::orderBy('created_at','desc')->get()->take(12); 
        $slider = Slider::where('type','upper')->where('active','active')->first();

        $products = Product::where('active',1)->orderBy('created_at','desc')->get()->take(9);
        $offers = Offer::where('active',1)->where('start_date','<=',$now_date)->where('end_date','>=',$now_date)->orderBy('created_at','desc')->get()->take(9);

        $services = Service::orderBy('created_at','desc')->get()->take(3);
        return view('frontend.home',compact('categories','slider','products','offers','services'));
    }



    public function form_supplier(){
        $name = 'name_' . app()->getLocale();
        $districts = District::pluck($name, 'id')->prepend('المنطقة', ''); 
        $cities = City::pluck($name, 'id')->prepend('المدينة', ''); 
        return view('frontend.register.supplier',compact('districts','cities'));
    }

    public function register_supplier(Request $request){
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
        Alert::success('تم بنجاح', 'تم أرسال طلبك بنجاح ');

        return redirect()->route('frontend.register.supplier'); 

    }



    public function form_delegate(){
        $name = 'name_' . app()->getLocale();
        $districts = District::pluck($name, 'id')->prepend('المنطقة', ''); 
        $cities = City::pluck($name, 'id')->prepend('المدينة', ''); 
        return view('frontend.register.delegate',compact('districts','cities'));
    }

    public function register_delegate(StoreDelegateRequest $request){
        
        
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
        
        $delegate = Delegate::create([
            'user_id' => $user->id,
            'discount_code' => $request->discount_code,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ]); 

        Alert::success('تم بنجاح', 'تم أرسال طلبك بنجاح ');

        return redirect()->route('frontend.register.delegate'); 
    }



    public function form_client(){
        $name = 'name_' . app()->getLocale();
        $districts = District::pluck($name, 'id')->prepend('المنطقة', ''); 
        $cities = City::pluck($name, 'id')->prepend('المدينة', ''); 
        return view('frontend.register.client',compact('districts','cities'));
    }

    public function register_client(StoreClientRequest $request){
        
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
            'approved' => 1,
        ]);   

        $client = Client::create([
            'user_id' => $user->id,
        ]);
        
        auth()->login($user, true);

        Alert::success('تم بنجاح', 'تم التسجيل بنجاح ');

        return redirect()->route('frontend.profile'); 
    }
}
