<?php

namespace App\Http\Requests;

use App\Models\MoneyRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMoneyRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('money_request_edit');
    }

    public function rules()
    {
        return [ 
            'status' => [
                'required',
            ], 
        ];
    }
}