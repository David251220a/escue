@extends('layouts.admin')

@section('styles')
@endsection

@section('content')

<div class="layout-px-spacing mt-4">

    <div class="row layout-spacing">
        <div class="mb-4">
            <h2>Agregar Alumno</h2>
        </div>
        <form action="{{route('alumno.store')}}" method="POST" onsubmit="disableButton()">
            @csrf
            <div class="form-row">

                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Documento</label>                
                    <input type="text" name="documento" id="documento" class="form-control text-right" placeholder="Documento"
                    value="{{old('documento')}}" onkeyup="punto_decimal(this)" required>
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{old('nombre')}}" onkeyup="mayuscula(this)"  required>
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido..." value="{{old('apellido')}}" onkeyup="mayuscula(this)"  required>
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Fecha Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{old('fecha_nacimiento')}}">
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option {{ old('sexo' == 0 ? 'selected' : '') }} value="0">SIN ESPECIFICAR</option>
                        <option {{ old('sexo' == 1 ? 'selected' : '') }} value="1">MASCULINO</option>
                        <option {{ old('sexo' == 2 ? 'selected' : '') }} value="2">FEMENINO</option>
                    </select>
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Celular</label>
                    <input type="text" name="celular" id="celular" class="form-control">
                </div>
            
                <div class="col-md-6 col-sm-6 mb-4">
                    <label for="">Direccion</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" onkeyup="mayuscula(this)">
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Turno</label>
                    <select name="turno_id" id="turno_id" class="form-control">
                        @foreach ($turnos as $item)
                            <option {{ old('turno_id') == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->descripcion}}</option>
                        @endforeach                    
                    </select>
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Grado</label>
                    <select name="curso_id" id="curso_id" class="form-control">
                        @foreach ($cursos as $item)
                            <option {{ old('curso_id') == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->descripcion}}</option>
                        @endforeach                    
                    </select>
                </div>

            </div>

            <div class="form-row">
                <button type="submit" class="btn btn-success mt-3" id="submitBtn" onclick="this.disabled = true; this.form.submit();">Crear</button>
            </div>
        </form>

    </div>
</div>

@endsection

@section('js')
@endsection
