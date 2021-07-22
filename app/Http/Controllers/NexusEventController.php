<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NexusEventController extends Controller
{
    public function unauthorized()
    {
        return view('errors.401');
    }

    public function serverError()
    {
        return view('errors.500');
    }
}
