<?php

namespace App\Http\Requests;

use App\UserAlert;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserAlertRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_alert_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'alert_text'     => [
                'required',
            ],
            'start_date'     => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'start_time'     => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_date'       => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_time'       => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'users.*'        => [
                'integer',
            ],
            'users'          => [
                'array',
            ],
            'activity_venue' => [
                'required',
            ],
        ];
    }
}
