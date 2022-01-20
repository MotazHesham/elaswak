<?php

namespace App\Http\Requests;

use App\Models\ProductCart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductCartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_cart_create');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
