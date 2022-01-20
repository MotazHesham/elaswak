<?php

namespace App\Http\Requests;

use App\Models\OfferCart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOfferCartRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('offer_cart_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:offer_carts,id',
        ];
    }
}
