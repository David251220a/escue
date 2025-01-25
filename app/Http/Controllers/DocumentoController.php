<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\CursoDocumento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index()
    {
        return view('documento.index');
    }

    public function create()
    {
        $cursos = Curso::where('estado_id', 1)->get();
        $ciclos = Ciclo::orderBy('anio', 'DESC')->get();
        return view('documento.create',  compact('cursos', 'ciclos'));
    }

    public function store(Request $request)
    {        

        $rules = [
            'pdf' => 'required|mimes:pdf',
            'descripcion' => 'required'
        ];        

        $request->validate($rules);

        $existe = CursoDocumento::where('estado_id', 1)
        ->where('curso_id', $request->curso_id)
        ->where('ciclo_id', $request->ciclo_id)
        ->where('descripcion', $request->descripcion)
        ->first();

        if($existe){
            return redirect()->route('documento.create')->withErrors('Ya existe una carga de documento con la mismo descripcion.');
        }
        
        $filePath = '';
        if($request->pdf){
            $filePath = $request->pdf->store('public/documento_curso');
        }
        CursoDocumento::create([
            'estado_id' => 1,
            'curso_id' => $request->curso_id,
            'ciclo_id' => $request->ciclo_id,
            'user_id' => auth()->user()->id,
            'descripcion' => $request->descripcion,
            'completo' => ($request->completo == 1 ? true : false),
            'pdf' => $filePath,            
        ]);

        return  redirect()->route('documento.index')->with('message', 'Documento curso creado con exito.');
    }

    public function edit(CursoDocumento $documentos_curso)
    {        
        $cursos = Curso::where('estado_id', 1)->get();
        $ciclos = Ciclo::orderBy('anio', 'DESC')->get();        
        return view('documento.edit',  compact('cursos', 'ciclos', 'documentos_curso'));
    }

    public function update(CursoDocumento $documentos_curso, Request $request)
    {
        $rules = [
            'pdf' => 'required|mimes:pdf',
            'descripcion' => 'required'
        ];        

        $request->validate($rules);

        $existe = CursoDocumento::where('estado_id', 1)
        ->where('curso_id', $request->curso_id)
        ->where('ciclo_id', $request->ciclo_id)
        ->where('descripcion', $request->descripcion)
        ->where('id', '<>', $documentos_curso->id)
        ->first();

        if($existe){
            return redirect()->route('documento.edit', $documentos_curso)->withErrors('Ya existe una carga de documento con la mismo descripcion.');
        }

        if($existe){
            return redirect()->route('documento.create')->withErrors('Ya existe una carga de documento con la mismo descripcion.');
        }
        
        $filePath = '';
        if($request->pdf){
            $filePath = $request->pdf->store('public/documento_curso');
        }
        
        $documentos_curso->update([
            'estado_id' => $request->estado_id,
            'curso_id' => $request->curso_id,
            'ciclo_id' => $request->ciclo_id,
            'user_id' => auth()->user()->id,
            'descripcion' => $request->descripcion,
            'completo' => ($request->completo == 1 ? true : false),
            'pdf' => $filePath,            
        ]);

        return  redirect()->route('documento.index')->with('message', 'Documento curso actualizado con exito.');
    }
}
