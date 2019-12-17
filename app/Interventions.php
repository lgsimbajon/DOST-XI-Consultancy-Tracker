<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interventions extends Model
{

    public $table = 'interventions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'new_firms_id',
        'category',
        'areas_for_improvement',
        'recommendations_short_term',
        'recommendations_long_term',
        'p',
        'remarks',
        'status',
        'results',
        'cost_of_implementations',
        'comments_problems',
        'plan_of_action',
    ];

}
