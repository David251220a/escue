<div class="col-12">
  <div class="input-group input-group-sm mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Buscar</span>
    </div>
    <input type="text" wire:model="search" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>

  <div class="row layout-top-spacing">
    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
      <div class="statbox widget box box-shadow">       
        
        <div class="widget-header">
          <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                  <a href="{{route('alumno.create')}}" class="btn btn-success btn-md mt-2 ml-2">Agregar</a>
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
                  <th>Grado</th>
                  <th>Turno</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td class="text-right">{{number_format($item->persona->documento, 0, ".", ".")}}</td>
                    <td>{{$item->persona->nombre}}</td>
                    <td>{{$item->persona->apellido}}</td>
                    <td>{{$item->persona->celular}}</td>
                    <td>{{$item->curso->descripcion}}</td>
                    <td>{{$item->turno->descripcion}}</td>
                    <td class="text-center">
                      <a href="{{route('alumno.edit', $item)}}">
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
