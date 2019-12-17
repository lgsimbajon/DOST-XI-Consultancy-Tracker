<?php

namespace App\Http\Requests;

use App\Interventions;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyInterventionsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:interventions,id',
        ];
    }
}
