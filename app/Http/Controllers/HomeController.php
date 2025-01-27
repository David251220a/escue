<?php

namespace App\Http\Controllers;

use App\Models\Padre;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $persona = Persona::where('documento', auth()->user()->documento)->first();
        $padre = Padre::where('persona_id', $persona->id)->first();
        return view('home', compact('persona', 'padre'));
    }
}
