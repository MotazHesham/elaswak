<?php

namespace App\Http\Requests\Frontend;

use App\Models\Delegate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDelegateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6'
            ],
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/', 
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
            'discount_code' => [
                'string',
                'required',
            ],
            'facebook' => [
                'string',
                'required',
            ],
            'instagram' => [
                'string',
                'required',
            ],
            'youtube' => [
                'string',
                'required',
            ], 
            'terms_conditions' => [ 
                'required',
            ],  
        ];
    }
}