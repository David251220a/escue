<div class="col-12">
    <div class="form-row">
        <div class="col-md-3 col-sm-6 mb-4">
            <label for="">Ciclo</label>
            <select wire:model="ciclo_id" class="form-control">
                @foreach ($ciclos as $item)
                    <option value="{{$item->id}}">{{$item->anio}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
            <label for="">Curso</label>
            <select wire:model="curso_id" class="form-control">
                @foreach ($cursos as $item)
                    <option value="{{$item->id}}">{{$item->descripcion}}</option>
                @endforeach
            </select>
        </div>        
        
    </div>

    <div class="row layout-top-spacing">
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">              
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <a href="{{route('documento.create')}}" class="btn btn-success btn-md mt-2 ml-2">Agregar Documento</a>
                        </div>
                    </div>
                </div>
                
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">                    
                            <thead >
                                <tr>
                                    <th>Descripcion</th>
                                    <th>Archivo</th>                                        
                                    <th></th>
                                </tr>
                            </thead>
      
                            <tbody>
                                @foreach ($todos as $item)
                                    <tr>
                                        <td>{{ $item->descripcion}}</td>
                                        <td>
                                            <a href="{{Storage::url($item->pdf)}}" target="__blank">
                                                <i class="fa-solid fa-file"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('documento.edit', $item)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                            </a>
                                        </td>
                                    </tr>    
                                @endforeach
                                @foreach ($documentoCursos as $item)
                                    <tr>
                                        <td>{{ $item->descripcion}}</td>
                                        <td>
                                            <a href="{{Storage::url($item->pdf)}}" target="__blank">
                                                <i class="fa-solid fa-file"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('documento.edit', $item)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                            </a>
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>                            
      
                            <tfoot>
                                <tr>
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
    
</div>
