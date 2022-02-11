<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'discount_code' => [
                'string',
                'nullable',
            ],
            'district_id' => [
                'required',
                'integer',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'zip_code' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'array',
            ],
            'offers.*' => [
                'integer',
            ],
            'offers' => [
                'array',
            ],
            'payment_type' => [
                'required',
            ],
            'payment_status' => [
                'required',
            ],
            'delivery_status' => [
                'required',
            ],
            'cancel_reason' => [
                'string',
                'nullable',
            ],
        ];
    }
}
