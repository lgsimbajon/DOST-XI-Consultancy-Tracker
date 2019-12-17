<?php

namespace App\Http\Requests;

use App\Uploads;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyUploadsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:uploads,id',
        ];
    }
}
