<?php

namespace App\Http\Requests;

use App\Models\Delegate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDelegateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('delegate_create');
    }

    public function rules()
    {
        return [
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
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
