<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PadreController extends Controller
{
    public function create()
    {
        return view('padre.create');
    }
}
