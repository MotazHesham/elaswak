<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer; 
use App\Models\ProductCategory; 

class OffersController extends Controller
{
    
    public function offers(Request $request){
        
        $category_id = null;
        $sorting = null;
        $price_start = null;
        $price_end = null;
        $search = null;
        $max_price = Offer::max('price');

        $offers = Offer::where('active','active');
        $categories = ProductCategory::orderBy('created_at','desc')->get();

        if($request->has('search')){ 
            $search = $request->search; 
            $offers = $offers->where('name', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%');
        }

        if($request->has('category_id')){
            global $category_id;
            $category_id = $request->category_id; 
            $offers = $offers->whereHas('categories',function($q){
                $q->where('id',$GLOBALS['category_id']);
            }); 
        }

        if($request->has('sorting')){
            $sorting = $request->sorting;
            if($sorting == 'latest'){ 
                $offers = $offers->orderBy('created_at','desc');
            }elseif($sorting == 'oldest'){
                $offers = $offers->orderBy('created_at','asc');
            }elseif($sorting == 'cheapest'){
                $offers = $offers->orderBy('price','asc');
            }elseif($sorting == 'expensive'){
                $offers = $offers->orderBy('price','desc');
            }else{
                $offers = $offers->orderBy('created_at','desc');
            }
        }

        if($request->has('price_start') && $request->has('price_end')){
            $price_start = $request->price_start;
            $price_end = $request->price_end;
            $offers = $offers->where('price','>=',$price_start)->where('price','<=',$price_end);
        } 

        $offers = $offers->paginate(12);
        $offers->appends([
            'category_id' => $category_id,
            'sorting' => $sorting,
            'price_start' => $price_start,
            'price_end' => $price_end,
            'search' => $search,
        ]);

        return view('frontend.offers.offers',compact('categories','offers','category_id','sorting','price_start','price_end','search','max_price'));
    }

    public function details($id){
        $offer = Offer::findOrFail($id);
        global $productCategories;
        $productCategories = $offer->categories()->get()->pluck('id');
        $offers = Offer::where('id','!=',$id)->whereHas('categories',function($q){
            $q->whereIn('id',$GLOBALS['productCategories']);
        })->orderBy('created_at','desc')->get()->take(6); 
        return view('frontend.offers.details',compact('offer','offers'));
    }
}
