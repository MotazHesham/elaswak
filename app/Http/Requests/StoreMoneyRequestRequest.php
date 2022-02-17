<?php

namespace App\Http\Requests;

use App\Models\MoneyRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMoneyRequestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [ 
            'delegate_id' => [
                'required',
                'integer',
            ],
            'description' => [
                'required',
            ],
            'status' => [
                'required',
            ],
            'target_id' => [
                'required',
                'integer',
            ],
        ];
    }
}