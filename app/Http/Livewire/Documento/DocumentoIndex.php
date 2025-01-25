<?php

namespace App\Http\Livewire\Documento;

use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\CursoDocumento;
use Livewire\Component;

class DocumentoIndex extends Component
{
    public $cursos, $curso_id, $ciclos, $ciclo_id;

    public function mount()
    {
        $this->cursos = Curso::where('estado_id', 1)->get();
        $this->curso_id = $this->cursos[0]->id;
        $this->ciclos = Ciclo::all();
        $idCiclo = Ciclo::where('anio', Ciclo::max('anio'))->first();
        $this->ciclo_id = $idCiclo->id;        
    }

    public function render()
    {
        $todos = CursoDocumento::where('estado_id', 1)
        ->where('ciclo_id', $this->ciclo_id)
        ->where('completo', true)
        ->get();

        $documentoCursos = CursoDocumento::where('estado_id', 1)
        ->where('ciclo_id', $this->ciclo_id)
        ->where('curso_id', $this->curso_id)
        ->where('completo', false)
        ->get();

        return view('livewire.documento.documento-index', compact('todos', 'documentoCursos'));
    }
}
