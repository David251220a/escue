@extends('layouts.admin')

@section('styles')
    <link href=" {{asset('assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="layout-px-spacing mt-4">

    <div class="row layout-spacing">
        <h2>Solicitudes de vinculación de alumnos -  VERIFICADOS</h2>
        <div class="col-12">
            <form action="{{route('verificar.verificados')}}" method="get">
                <div class="input-group input-group-sm mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Buscar</span>
                    </div>
                    <input type="text" name="search" value="{{$search}}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
            </form>
          
            <div class="row layout-top-spacing">
                <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">                         
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-2 col-md-3 col-sm-12 col-12">
                                    <a href="{{route('verificar.index')}}" class="btn btn-primary btn-md mt-2 ml-2">Pendientes</a>
                                </div>
                                <div class="col-xl-2 col-md-3 col-sm-12 col-12">
                                    <a href="{{route('verificar.rechazados')}}" class="btn btn-danger btn-md mt-2 ml-2">Rechazados</a>
                                </div>
                            </div>
                        </div>
                  
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-4">                      
                                    <thead >
                                        <tr>
                                            <th>Documento</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>                  
                                            <th>Celular</th>
                                            <th>Hijo</th>
                                            <th>Hijo Doc.</th>
                                        </tr>
                                    </thead>
          
                                    <tbody>
                                        @foreach ($data as $item) 
                                            <tr>
                                                <td class="text-right">{{number_format($item->padre->persona->documento, 0, ".", ".")}}</td>
                                                <td>{{$item->padre->persona->nombre}}</td>
                                                <td>{{$item->padre->persona->apellido}}</td>
                                                <td>{{$item->padre->persona->celular}}</td>                                                
                                                <td>
                                                    {{number_format($item->alumno->persona->documento, 0, ".", ".")}}
                                                    - {{$item->alumno->persona->nombre}} {{$item->alumno->persona->apellido}}
                                                    / {{$item->alumno->curso->descripcion}} - Turno {{$item->alumno->turno->descripcion}}
                                                </td>
                                                <td>
                                                    <a href="{{Storage::url($item->documento_frente)}}" target="__blank" class="mr-2"><i class="fa-solid fa-id-card-clip"></i></a>
                                                    <a href="{{Storage::url($item->documento_reverso)}}" target="__blank" class="mr-2"><i class="fa-solid fa-id-card"></i></a>
                                                </td>                                                
                                            </tr>    
                                        @endforeach                
                                    </tbody>
            
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
          
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="row">
                <div class="col-md-12 col-sm-12 mx-2 mt-4">
                    {{$data->links()}}  
                </div>
            </div>
          
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection
