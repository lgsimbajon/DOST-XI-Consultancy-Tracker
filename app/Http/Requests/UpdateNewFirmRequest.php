<?php

namespace App\Http\Requests;

use App\NewFirm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateNewFirmRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('new_firm_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    public function rules()
    {
        return [
            'province'      => [
                'required',
            ],
            'beneficiary'   => [
                'required',
            ],
            'cy_approvedsu' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
