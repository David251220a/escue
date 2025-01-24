<?php

namespace App\Http\Livewire\Alumno;

use Livewire\Component;

class IndexAlumno extends Component
{

    public $search;

    public function render()
    {
        return view('livewire.alumno.index-alumno');
    }
}
