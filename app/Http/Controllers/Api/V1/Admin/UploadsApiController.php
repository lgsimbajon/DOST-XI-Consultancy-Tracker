<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Uploads;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadsApiController extends Controller
{
    public function index()
    {
        return new UploadsResource(Uploads::all());
    }

}
