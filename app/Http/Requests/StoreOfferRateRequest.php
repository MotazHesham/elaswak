<?php

namespace App\Http\Requests;

use App\Models\OfferRate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOfferRateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('offer_rate_create');
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
            'rate' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'review' => [
                'required',
            ],
        ];
    }
}
