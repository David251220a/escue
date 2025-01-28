<?php

namespace App\Http\Livewire\Padre;

use App\Models\Alumno;
use App\Models\Padre;
use App\Models\PadreAlumno;
use App\Models\PadreTipo;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithFileUploads;

class PadreCreate extends Component
{

    use WithFileUploads;

    public $alumno_ver, $datos_buscar, $datos_padres;
    public $documento, $nombre, $apellido, $persona, $alumno;
    public $foto_frente, $foto_reverso;
    public $tipoPadre, $tipoPadreId;
    public $direccion, $sexo, $fecha_nac, $celular;

    public function mount()
    {
        $this->alumno_ver = 'none';
        $this->datos_buscar = 'display';
        $this->datos_padres = 'none';
        $this->persona = [];
        $this->alumno = [];
        $this->tipoPadre = PadreTipo::all();
        $this->tipoPadreId = $this->tipoPadre[0]->id;
    }

    public function render()
    {
        return view('livewire.padre.padre-create');
    }

    public function encontrar_alumno()
    {
        
        if($this->documento){
            $documento = str_replace('.', '', $this->documento);
            if($documento == 0){
                $this->emit('mensaje_error', 'El numero de documento no puede ser cero.');
                return false;
            }
            
            $alumno = Alumno::whereHas('persona', function ($query) use ($documento) {
                $query->where('documento', $documento);
            })
            ->where('estado_id', 1)
            ->first();

            if(empty($alumno)){
                $this->reset('persona');
                $this->reset('nombre');
                $this->reset('apellido');
                $this->documento = 0;
                $this->emit('mensaje_error', 'No existe alumno con este numero de cedula.');
                return false;
            }else{
                $this->datos_buscar = 'none';
                $this->datos_padres = 'none';
                $this->alumno_ver = 'display';
                $this->persona = $alumno->persona;
                $this->nombre = $alumno->persona->nombre;
                $this->apellido = $alumno->persona->apellido;
                $this->alumno = $alumno;
            }
        }else{
            $this->emit('mensaje_error', 'El numero de documento no puede ser vacio.');
            return false;            
        }
    }

    public function actualzar_datos_padre()
    {
        if(empty($this->foto_frente)){
            $this->emit('mensaje_error', 'La foto de frente no puede ser vacio');
            return false;
        }

        if(empty($this->foto_reverso)){
            $this->emit('mensaje_error', 'La foto de reverso no puede ser vacio');
            return false;
        }

        $persona_padre = Persona::where('documento', auth()->user()->documento)->first();
        $this->celular = $persona_padre->celular;
        $this->direccion = $persona_padre->direccion;
        $this->sexo = $persona_padre->sexo;
        $this->fecha_nac = $persona_padre->fecha_nacimiento;
        
        $existe = $persona_padre->padre;
        if (empty($existe)){
            $this->tipoPadreId = 1;
        }else{
            $this->tipoPadreId = $persona_padre->padre->padre_tipo_id;
        }

        $this->datos_buscar = 'none';
        $this->datos_padres = 'display';
        $this->alumno_ver = 'none';
    }

    public function save()
    {
        if (empty($this->direccion)){
            $this->emit('mensaje_error', 'La direccion no puede estar vacio.');
            return false;
        }

        if (empty($this->fecha_nac)){
            $this->emit('mensaje_error', 'La fecha de nacimiento no puede estar vacio.');
            return false;
        }

        $persona_padre = Persona::where('documento', auth()->user()->documento)->first();
        $existe = $persona_padre->padre;
        if (empty($existe)){
            $padre = Padre::create([
                'estado_id' => 1,
                'persona_id' => $persona_padre->id,
                'padre_tipo_id' => $this->tipoPadreId,
            ]);            
        }else{
            $padre = $existe;
        }        
        $persona_padre->direccion = $this->direccion;
        $persona_padre->celular = $this->celular;
        $persona_padre->fecha_nacimiento = $this->fecha_nac;
        $persona_padre->sexo = $this->sexo;
        $persona_padre->update();

        $foto_frente = '';
        if($this->foto_frente){
            $foto_frente = $this->foto_frente->store('public/cedula');
        }

        $foto_reverso = '';
        if($this->foto_reverso){
            $foto_reverso = $this->foto_reverso->store('public/cedula');
        }

        PadreAlumno::create([
            'padre_id' => $padre->id,
            'alumno_id' => $this->alumno->id,
            'estado_id' => 1,
            'verificado' => false,
            'documento_frente' => $foto_frente,
            'documento_reverso' => $foto_reverso,
            'usuario_aprobado' => null,
            'fecha_aprobado' => null,
        ]);

        return redirect()->route('home')->with('message', 'Hij@ vinculado con exito.');
        
    }

    public function retroceder_datos_alumno()
    {
        $this->datos_buscar = 'none';
        $this->datos_padres = 'none';
        $this->alumno_ver = 'display';
    }

    public function retroceder_datos_buscar()
    {
        $this->datos_buscar = 'display';
        $this->datos_padres = 'none';
        $this->alumno_ver = 'none';
    }
}
