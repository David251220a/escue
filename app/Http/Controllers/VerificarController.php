<?php

namespace App\Http\Controllers;

use App\Models\PadreAlumno;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificarController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        if($request->search){
            $filtro = str_replace('.', '', $request->search);         
            $search = $request->search;
            $data = PadreAlumno::whereHas('padre', function ($query) use ($filtro) {
                $query->whereHas('persona', function ($subQuery) use ($filtro) {
                    $subQuery->where('documento', 'LIKE' , '%' . $filtro . '%')
                    ->orWhere('nombre', 'LIKE' , '%' . $filtro . '%')
                    ->orWhere('apellido', 'LIKE' , '%' . $filtro . '%');
                });
            })
            ->where('estado_id', 1)
            ->where('verificado', false)
            ->paginate(50);
        }else{
            $data = PadreAlumno::where('estado_id', 1)
            ->where('verificado', false)
            ->paginate(50);
        }
        return view('verificar.index', compact('data', 'search'));
    }

    public function aprobar(PadreAlumno $padreAlumno)
    {
        $padreAlumno->verificado = true;
        $padreAlumno->usuario_aprobado = auth()->user()->id;
        $padreAlumno->fecha_aprobado = Carbon::now();
        $padreAlumno->estado_id = 1;
        $padreAlumno->update();
        return redirect()->route('verificar.index')->with('message', 'Vinculación aprobada.');
    }

    public function rechazar(PadreAlumno $padreAlumno)
    {
        $padreAlumno->verificado = false;
        $padreAlumno->usuario_aprobado = auth()->user()->id;
        $padreAlumno->fecha_aprobado = Carbon::now();
        $padreAlumno->estado_id = 2;        
        $padreAlumno->update();
        return redirect()->route('verificar.index')->with('message', 'Vinculación aprobada.');
    }

    public function verificados(Request $request)
    {
        $search = '';
        if($request->search){
            $filtro = str_replace('.', '', $request->search);         
            $search = $request->search;
            $data = PadreAlumno::whereHas('padre', function ($query) use ($filtro) {
                $query->whereHas('persona', function ($subQuery) use ($filtro) {
                    $subQuery->where('documento', 'LIKE' , '%' . $filtro . '%')
                    ->orWhere('nombre', 'LIKE' , '%' . $filtro . '%')
                    ->orWhere('apellido', 'LIKE' , '%' . $filtro . '%');
                });
            })
            ->where('estado_id', 1)
            ->where('verificado', true)
            ->paginate(50);
        }else{
            $data = PadreAlumno::where('estado_id', 1)
            ->where('verificado', true)
            ->paginate(50);
        }
        return view('verificar.verificados', compact('data', 'search'));
    }

    public function rechazados(Request $request)
    {
        $search = '';
        if($request->search){
            $filtro = str_replace('.', '', $request->search);         
            $search = $request->search;
            $data = PadreAlumno::whereHas('padre', function ($query) use ($filtro) {
                $query->whereHas('persona', function ($subQuery) use ($filtro) {
                    $subQuery->where('documento', 'LIKE' , '%' . $filtro . '%')
                    ->orWhere('nombre', 'LIKE' , '%' . $filtro . '%')
                    ->orWhere('apellido', 'LIKE' , '%' . $filtro . '%');
                });
            })
            ->where('estado_id', 2)            
            ->paginate(50);
        }else{
            $data = PadreAlumno::where('estado_id', 2)            
            ->paginate(50);
        }
        return view('verificar.rechazados', compact('data', 'search'));
    }
}
