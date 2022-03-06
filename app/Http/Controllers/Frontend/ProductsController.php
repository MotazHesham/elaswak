<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\ProductCategory; 
use App\Models\ProductRate; 
use Auth;

class ProductsController extends Controller
{
    public function rate(Request $request){ 
        ProductRate::updateOrCreate(
            ['product_id' =>  $request->id,'user_id' => Auth::id()],
            ['rate' => $request->rate , 'review' => '.']
        );
    }
    public function rating($id){ 
        $product = Product::findOrFail($id);
        return view('frontend.products.ratings',compact('product'));
    }

    public function products(Request $request){
        
        $category_id = null;
        $sorting = null;
        $price_start = null;
        $price_end = null;
        $search = null;
        $max_price = Product::max('price');

        $products = Product::where('active',1);
        $categories = ProductCategory::orderBy('created_at','desc')->get();

        if($request->has('search')){ 
            $search = $request->search; 
            $products = $products->where('name', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%');
        }

        if($request->has('category_id')){
            global $category_id;
            $category_id = $request->category_id; 
            $products = $products->whereHas('categories',function($q){
                $q->where('id',$GLOBALS['category_id']);
            }); 
        }

        if($request->has('sorting')){
            $sorting = $request->sorting;
            if($sorting == 'latest'){ 
                $products = $products->orderBy('created_at','desc');
            }elseif($sorting == 'oldest'){
                $products = $products->orderBy('created_at','asc');
            }elseif($sorting == 'cheapest'){
                $products = $products->orderBy('price','asc');
            }elseif($sorting == 'expensive'){
                $products = $products->orderBy('price','desc');
            }else{
                $products = $products->orderBy('created_at','desc');
            }
        }

        if($request->has('price_start') && $request->has('price_end')){
            $price_start = $request->price_start;
            $price_end = $request->price_end;
            $products = $products->where('price','>=',$price_start)->where('price','<=',$price_end);
        } 

        $products = $products->paginate(12);
        $products->appends([
            'category_id' => $category_id,
            'sorting' => $sorting,
            'price_start' => $price_start,
            'price_end' => $price_end,
            'search' => $search,
        ]);

        return view('frontend.products.products',compact('categories','products','category_id','sorting','price_start','price_end','search','max_price'));
    }

    public function details($id){
        $product = Product::findOrFail($id);
        global $productCategories;
        $productCategories = $product->categories()->get()->pluck('id');
        $products = Product::where('active',1)->where('id','!=',$id)->whereHas('categories',function($q){
            $q->whereIn('id',$GLOBALS['productCategories']);
        })->orderBy('created_at','desc')->get()->take(6); 
        return view('frontend.products.details',compact('product','products'));
    }


}
