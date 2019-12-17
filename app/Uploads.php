<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    public $table = 'uploads';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'new_firms_id',
        'file_name',
        'path',
    ];
}
