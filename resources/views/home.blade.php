@extends('layouts.admin')

@section('styles')
    <link href="{{asset('assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="layout-px-spacing mt-4">

        <div class="mb-4">
            <h2>Bienvenido a la Escuela Virgen del Pilar</h2>
        </div>

        @if (empty($padre))
            <div class="form-row">
                <div class="col-md-6 col-sm-6 mb-4">
                    <div id="infobox2" class="col-xl-12 col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area text-center">
                                <div class="infobox-2">
                                    <div class="info-icon">
                                        <i class="fa-solid fa-children" style="font-size: 40px"></i>
                                    </div>
                                    <h5 class="info-heading mt-2">Aun no tienes vinculado a tu hij@?</h5>
                                    <p class="info-text">Sigue los pasos para vincularlo.</p>
                                    <a class="info-link" href="{{route('padre.create')}}">Registrar <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (!empty($padre))
            <div class="statbox widget box box-shadow">                    
                <div class="widget-content widget-content-area">
                    <h3 class="mb-2 text-white font-bold">
                        Hijos <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                            </path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>                        
                    </h3>
                    <a class="info-link" href="{{route('padre.create')}}" class="text-lg mb-4">Registrar otro hijo
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                        <line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <br><br>

                    <div id="iconsAccordion" class="accordion-icons">
                        <div class="card">
                            @foreach ($padre->hijos as $item)
                                <div class="card-header" id="headingTwo{{$item->id}}">
                                    <section class="mb-0 mt-0">
                                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#iconAccordionTwo{{$item->id}}" aria-expanded="false" aria-controls="iconAccordionTwo{{$item->id}}">
                                            <div class="accordion-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                            {{number_format($item->alumno->persona->documento, 0, ".", ".")}} - {{$item->alumno->persona->nombre}} {{$item->alumno->persona->apellido}}
                                            <div class="icons">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div id="iconAccordionTwo{{$item->id}}" class="collapse" aria-labelledby="headingTwo3" data-parent="#iconsAccordion" style="">
                                    <div class="card-body">
                                        @if ($item->verificado == false)
                                            <h4 class="font-bold" style="color: red">Estamos verificando los datos cargados.</h4>
                                        @else
                                            <p>
                                                Curso: {{$item->alumno->curso->descripcion}}
                                                <br> Turno: {{$item->alumno->turno->descripcion}}
                                                <br> Ciclo: {{$item->alumno->ciclo->anio}}
                                            </p>                                            
                                            <ul class="list-unstyled">
                                                @foreach ($documentos_general as $doc)
                                                    @php
                                                        // Verifica si el documento está marcado como visto para un alumno específico
                                                        $alumno_id = $item->alumno_id;
                                                        $es_visto = collect($documentos_vistos)->contains(function ($visto) use ($doc, $alumno_id) {
                                                            return $visto['curso_documento_id'] == $doc->id && $visto['alumno_id'] == $alumno_id;
                                                        });
                                                        // Determina el color según si es visto o no
                                                        $color = $es_visto ? 'green' : 'red';
                                                        $icono = $es_visto ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
                                                    @endphp
                                                    <li>
                                                        <a href="{{Storage::url($doc->pdf)}}" 
                                                        class="document-link"
                                                        data-documento-id="{{ $doc->id }}" 
                                                        data-alumno-id="{{ $item->alumno_id }}" 
                                                        style="color: {{$color}}">
                                                            <i class="{{$icono}}"></i> {{$doc->descripcion}}
                                                        </a>
                                                    </li>
                                                @endforeach

                                                @php
                                                    // Filtrar documentos específicos del curso y ciclo
                                                    $documentos_cursos = \App\Models\CursoDocumento::where('curso_id', $item->alumno->curso_id)
                                                    ->where('ciclo_id', $item->alumno->ciclo_id)
                                                    ->where('completo', 0)
                                                    ->where('estado_id', 1)
                                                    ->get();
                                                @endphp
                                                
                                                @foreach ($documentos_cursos as $doc)
                                                    @php
                                                        $es_visto = collect($documentos_vistos)->contains(function ($visto) use ($doc, $alumno_id) {
                                                            return $visto['curso_documento_id'] == $doc->id && $visto['alumno_id'] == $alumno_id;
                                                        });
                                                        $color = $es_visto ? 'green' : 'red';
                                                        $icono = $es_visto ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
                                                    @endphp
                                                    <li>
                                                        <a href="{{ Storage::url($doc->pdf) }}" 
                                                        class="document-link"
                                                        data-documento-id="{{ $doc->id }}" 
                                                        data-alumno-id="{{ $item->alumno_id }}"
                                                        style="color: {{ $color }}">
                                                            <i class="{{ $icono }}"></i> {{ $doc->descripcion }}
                                                        </a>
                                                    </li>
                                            @endforeach
                                            </ul>
                                        @endif
                                        
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>                    
                    </div>
                                
                </div>
            </div>    
        @endif
        
    </div>

@endsection

@section('js')
<script src="{{asset('assets/js/components/ui-accordions.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('.document-link');
        
        links.forEach(link => {
            link.addEventListener('click', async (event) => {
                event.preventDefault();

                const documentoId = link.getAttribute('data-documento-id');
                const alumnoId = link.getAttribute('data-alumno-id');
                const pdfUrl = link.getAttribute('href');                

                try {
                    // Enviar la solicitud AJAX para registrar la vista
                    const response = await fetch('{{ route("documentos.registrarVista") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            documento_id: documentoId,
                            alumno_id: alumnoId
                        })
                    });

                    if (response.ok) {
                        // Abrir el PDF en una nueva pestaña
                        window.open(pdfUrl, '_blank');
                        
                        // Recargar la página después de registrar la vista
                        location.reload();
                    } else {
                        console.error('Error al registrar la vista');
                    }
                } catch (error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });
    });
</script>


@endsection
