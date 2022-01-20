<?php

namespace App\Http\Requests;

use App\Models\OfferCart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOfferCartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('offer_cart_create');
    }

    public function rules()
    {
        return [
            'offer_id' => [
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
