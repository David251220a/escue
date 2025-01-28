<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\CursoDocumento;
use App\Models\Padre;
use App\Models\PadreVista;
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
        $ciclo = Ciclo::where('estado_id', 1)->first();
        $documentos_general = CursoDocumento::where('ciclo_id', $ciclo->id)
        ->where('estado_id', 1)
        ->where('completo', 1)
        ->get();
        if($padre){
            $documentos_vistos = PadreVista::where('padre_id', $padre->id)
            ->orderBy('id', 'DESC')
            ->limit(100)
            ->get(['curso_documento_id', 'alumno_id'])            
            ->toArray();
        }else{
            $documentos_vistos = PadreVista::where('padre_id', 0)
            ->orderBy('id', 'DESC')
            ->limit(100)
            ->get(['curso_documento_id', 'alumno_id'])            
            ->toArray();
        }        
        return view('home', compact('persona', 'padre', 'documentos_general', 'documentos_vistos'));
    }

    public function registrarVista(Request $request)
    {
        $persona = Persona::where('documento', auth()->user()->documento)->first();
        $padre = Padre::where('persona_id', $persona->id)->first();

        try {
            PadreVista::create([
                'estado_id' => 1,
                'padre_id' => $padre->id,
                'alumno_id' => $request->alumno_id,
                'curso_documento_id' => $request->documento_id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['message' => 'Vista registrada con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al registrar la vista'], 500);
        }
    }
}
