<?php

namespace App\Http\Livewire\Consulta;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\Turno;
use Livewire\Component;

class ConsultaIndex extends Component
{

    public $cursos, $cursoId, $turnos, $turnoId, $ciclo;

    public function mount()
    {
        $this->cursos = Curso::where('estado_id', 1)->get();
        $this->cursoId = $this->cursos[0]->id;
        $this->turnos = Turno::all();
        $this->turnoId = $this->turnos[0]->id;
        $this->ciclo = Ciclo::where('estado_id', 1)->first();
    }

    public function render()
    {
        $data = Alumno::where('estado_id', 1)
        ->where('ciclo_id', $this->ciclo->id)
        ->where('turno_id', $this->turnoId)
        ->where('curso_id', $this->cursoId)
        ->paginate(50);

        return view('livewire.consulta.consulta-index', compact('data'));
    }
}
