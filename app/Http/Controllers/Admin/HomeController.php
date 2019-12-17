<?php

namespace App\Http\Controllers\Admin;

use App\NewFirm;
use App\Interventions;

class HomeController
{
    public function index()
    {
        $services = NewFirm::all()->count();
        $implemented = Interventions::all()->where('status', '=', 'Implemented')->count();
        $unimplemented = Interventions::all()->where('status', '=', 'Not Implemented')->count();

        return view('home', compact('services', 'implemented', 'unimplemented'));
    }
}
