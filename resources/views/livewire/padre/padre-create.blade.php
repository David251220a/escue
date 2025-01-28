<div>
    <div class="statbox widget box box-shadow" style="display: {{$datos_buscar}}">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="mt-2 ml-2">Buscar Alumno</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="form-row mb-4">
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="documento">Documento</label>
                    <input type="text" wire:model.defer="documento" class="form-control text-right" placeholder="Documento" onkeyup="punto_decimal(this)">
                </div>
            </div>
            <a href="{{route('home')}}" class="btn btn-danger"><i class="flaticon-cancel-12"></i>Retroceder</a>
            <button type="button" wire:click="encontrar_alumno()" class="btn btn-primary">Siguiente</button>
        </div>
    </div>

    <div class="statbox widget box box-shadow" style="display: {{$alumno_ver}}">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="mt-2 ml-2">Alumno: {{$documento}} - {{$nombre}} {{$apellido}}</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <h5>Completar datos del alumno</h5>
            <hr>
            <div class="form-row mb-4">
                <div class="col-md-3 col-sm-12 mb-4">
                    <label for="documento">Foto de cedula de frente </label>
                    <input type="file" wire:model.defer="foto_frente" class="form-control" accept=".jpg, .jpeg, .png">
                </div>
                <div class="col-md-3 col-sm-12 mb-4">
                    <label for="documento">Foto de cedula de reverso </label>
                    <input type="file" wire:model.defer="foto_reverso" class="form-control" accept=".jpg, .jpeg, .png">
                </div>
            </div>
            <button wire:click="retroceder_datos_buscar()" class="btn btn-warning"><i class="flaticon-cancel-12"></i>Retroceder</button>
            <button type="button" wire:click="actualzar_datos_padre()" wire:loading.attr="disabled" class="btn btn-primary">Siguiente</button>
        </div>
    </div>

    <div class="statbox widget box box-shadow" style="display: {{$datos_padres}}">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="mt-2 ml-2">Actualizar Datos</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <h5>Actualize sus datos</h5>
            <hr>
            <div class="form-row mb-4">
                <div class="col-md-4 col-sm-12 mb-4">
                    <label for="documento">Padre/Madre o Encargado</label>
                    <select class="form-control" wire:model.defer="tipoPadreId">
                        @foreach ($tipoPadre as $item)
                            <option value="{{$item->id}}">{{$item->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-7 col-sm-12 mb-4">
                    <label for="documento">Direccion</label>
                    <input type="text" wire:model.defer="direccion" class="form-control"  placeholder="Direccion">
                </div>
                <div class="col-md-4 col-sm-12 mb-4">
                    <label for="documento">Celular</label>
                    <input type="text" wire:model.defer="celular" class="form-control"  placeholder="Celular">
                </div>                                
                <div class="col-md-3 col-sm-12 mb-4">
                    <label for="documento">Fecha Nacimiento</label>
                    <input type="date" wire:model.defer="fecha_nac" class="form-control">
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Sexo</label>
                    <select wire:model.defer="sexo" class="form-control">
                        <option value="0">SIN ESPECIFICAR</option>
                        <option value="1">MASCULINO</option>
                        <option value="2">FEMENINO</option>
                    </select>
                </div>
            </div>
            <button wire:click="retroceder_datos_alumno()" class="btn btn-warning"><i class="flaticon-cancel-12"></i>Retroceder</button>
            <button type="button" wire:click="save()" class="btn btn-success" wire:loading.attr="disabled">Grabar</button>
        </div>
    </div>
</div>
