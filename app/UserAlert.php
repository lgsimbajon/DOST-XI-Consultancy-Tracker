<?php

namespace App;

use Carbon\Carbon;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserAlert extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'user_alerts';

    protected $dates = [
        'end_date',
        'start_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'end_date',
        'end_time',
        'alert_text',
        'alert_link',
        'start_date',
        'start_time',
        'created_at',
        'updated_at',
        'activity_venue',
    ];

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
