<?php

namespace App\Http\Requests;

use App\Models\MoneyRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMoneyRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('money_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:money_requests,id',
        ];
    }
}