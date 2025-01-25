<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\Persona;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{

    public function index()
    {
        return view('alumno.index');
    }

    public function create()
    {
        $turnos = Turno::where('estado_id', 1)->get();
        $cursos = Curso::where('estado_id', 1)->get();
        return view('alumno.create', compact('turnos', 'cursos'));        
    }

    public function store(Request $request)
    {
        $request->merge([
            'documento' => str_replace('.', '', $request->documento)
        ]);

        $rules = [
            'documento' => ['required', 'unique:personas,documento'],
            'nombre' =>  ['required'],
            'apellido' =>  ['required'],
            'direccion' =>  ['required'],
        ];

        $request->validate($rules);

        try {
            DB::beginTransaction();

            $persona = Persona::create([
                'documento' => str_replace('.', '', $request->documento),
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'pais_id' => 1,
                'estado_id' => 1,
                'fecha_nacimiento' => (empty($request->fecha_nacimiento) ? null : $request->fecha_nacimiento),
                'sexo' => $request->sexo,
                'email' => $request->email,
                'celular' => $request->celular,
                'direccion' => $request->direccion,
                'foto' => null,
            ]);            

            $ciclo = Ciclo::where('anio', Ciclo::max('anio'))->first();

            Alumno::create([
                'estado_id' => 1,
                'ciclo_id' => $ciclo->id,
                'curso_id' => $request->curso_id,
                'turno_id' => $request->turno_id,
                'persona_id' => $persona->id,
                'user_id' => auth()->user()->id,
            ]);            

            DB::commit();

            return redirect()->route('alumno.index')->with('message', 'Alumno creado con exito.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('Ocurrió un error: ' . $th->getMessage());
        }
        
    }

    public function edit(Alumno $alumno)
    {
        $turnos = Turno::where('estado_id', 1)->get();
        $cursos = Curso::where('estado_id', 1)->get();
        return  view('alumno.edit', compact('alumno', 'turnos', 'cursos'));
    }

    public function update(Alumno $alumno , Request $request)
    {
        $request->merge([
            'documento' => str_replace('.', '', $request->documento)
        ]);

        $rules = [
            'documento' => [
                'required',
                'unique:personas,documento,' . $alumno->persona->id,
            ],
            'nombre' =>  ['required'],
            'apellido' =>  ['required'],
            'direccion' =>  ['required'],
        ];

        $request->validate($rules);

        try {
            DB::beginTransaction();

            $alumno->persona->update([
                'documento' => str_replace('.', '', $request->documento),
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'pais_id' => 1,
                'estado_id' => 1,
                'fecha_nacimiento' => (empty($request->fecha_nacimiento) ? null : $request->fecha_nacimiento),
                'sexo' => $request->sexo,
                'email' => $request->email,
                'celular' => $request->celular,
                'direccion' => $request->direccion,
                'foto' => null,
            ]);            

            $ciclo = Ciclo::where('anio', Ciclo::max('anio'))->first();

            $alumno->update([
                'estado_id' => 1,
                'ciclo_id' => $ciclo->id,
                'curso_id' => $request->curso_id,
                'turno_id' => $request->turno_id,                
                'user_id' => auth()->user()->id,
            ]);            

            DB::commit();

            return redirect()->route('alumno.index')->with('message', 'Alumno actualizado con exito.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('Ocurrió un error: ' . $th->getMessage());
        }
    }



}
