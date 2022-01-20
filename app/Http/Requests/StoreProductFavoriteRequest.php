<?php

namespace App\Http\Requests;

use App\Models\ProductFavorite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductFavoriteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_favorite_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
