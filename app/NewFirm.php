<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewFirm extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'new_firms';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PROVINCE_SELECT = [
        'Davao de Oro' => 'Davao de Oro',
        'Davao City'        => 'Davao City',
        'Davao Del Norte'   => 'Davao del Norte',
        'Davao Del Sur'     => 'Davao del Sur',
        'Davao Oriental'    => 'Davao Oriental',
    ];

    protected $fillable = [
        'cpt',
        'mpex',
        'campi',
        'province',
        'gmp_manual',
        'created_at',
        'updated_at',
        'deleted_at',
        'beneficiary',
        'gmp_seminar',
        'energy_audit',
        'cy_approvedsu',
        'gmp_assessment',
        'packaging_labeling',
        'plant_layout_design',
    ];
}
