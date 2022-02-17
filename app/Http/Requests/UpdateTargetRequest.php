<?php

namespace App\Http\Requests;

use App\Models\Target;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTargetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('target_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'num_of_orders' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'delegates.*' => [
                'integer',
            ],
            'delegates' => [
                'required',
                'array',
            ],
            'profit' => [
                'required',
            ],
            'profit_type' => [
                'required',
            ],
        ];
    }
}