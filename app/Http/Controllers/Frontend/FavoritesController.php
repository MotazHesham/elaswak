<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferFavorite;
use App\Models\ProductFavorite;
use Auth;

class FavoritesController extends Controller
{
    public function ajax(Request $request){
        $user = Auth::user();
        if($request->type == 'product'){
            $fav = ProductFavorite::where('product_id',$request->id)->where('user_id',$user->id)->first();
            if($fav){
                $fav->delete();
            }else{
                ProductFavorite::create([
                    'user_id' => $user->id,
                    'product_id' => $request->id,
                ]);
            }
        }elseif($request->type == 'offer'){
            $fav = OfferFavorite::where('offer_id',$request->id)->where('user_id',$user->id)->first();
            if($fav){
                $fav->delete();
            }else{
                OfferFavorite::create([
                    'user_id' => $user->id,
                    'offer_id' => $request->id,
                ]);
            }
        }
        return 1;
    }

    public function index(Request $request){
        $user = Auth::user();
        $type = $request->type;

        if($type == 'offers'){
            $favorites = OfferFavorite::with('offer')->where('user_id',$user->id)->paginate(9);
            $favorites->appends(['type' => $type]);
            return view('frontend.profile.favorites.offers',compact('favorites'));
        }elseif($type == 'products'){
            $favorites = ProductFavorite::with('product')->where('user_id',$user->id)->paginate(9);
            $favorites->appends(['type' => $type]);
            return view('frontend.profile.favorites.products',compact('favorites'));
        }else{
            return abort(404);
        }

    }
    
}
