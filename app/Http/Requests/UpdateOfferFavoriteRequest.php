<?php

namespace App\Http\Requests;

use App\Models\OfferFavorite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOfferFavoriteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('offer_favorite_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'offer_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
