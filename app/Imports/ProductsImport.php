<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\ToModel; 
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use Storage;

class ProductsImport implements ToModel
{
    use MediaUploadingTrait; 

    public function model(array $row)
    {

        $product = Product::create([
            'name' => $row[2], 
            'price' => $row[8],
            'supplier_id' => 1,
            'active' => $row[10],
            'quantity' => 100,
        ]); 
        
        if ($row[1] != null) { 
            try{
                $url = $row[1];
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put($name, $contents); 
                $product->addMedia(storage_path('app/'.$name))->toMediaCollection('photo'); 
            }catch(\Exception $e){
                
            }
        }

        if($row[6] != null){
            $category = ProductCategory::where('name',$row[6])->first();
            if($category){
                $product->categories()->sync([$category->id]); 
            }else{
                $category = ProductCategory::create(['name' => $row[6]]);
                $product->categories()->sync([$category->id]); 
            }
        }
        return $product;
    }
}
