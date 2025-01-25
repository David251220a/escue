<?php

namespace App\Http\Livewire\Alumno;

use App\Models\Alumno;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAlumno extends Component
{

    public $search;
    
    use WithPagination;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        if($this->search){
            $filtro = $this->search;
            $data = Alumno::whereHas('persona', function ($query) use ($filtro) {
                $query->where('documento', 'LIKE' , '%' . $filtro . '%')
                    ->orWhere('nombre', 'LIKE' , '%' . $filtro . '%')
                    ->orWhere('apellido', 'LIKE' , '%' . $filtro . '%');
            })->paginate(50);

        }else{
            $data = Alumno::paginate(50);
        }

        $this->resetPage();
        
        return view('livewire.alumno.index-alumno', compact('data'));
    }
}
