@extends('layouts.admin')

@section('styles')
@endsection

@section('content')

<div class="layout-px-spacing mt-4">

    <div class="row layout-spacing">
        <div class="mb-4">
            <h2>Editar Alumno: {{number_format($alumno->persona->documento, 0, ".", ".")}} - {{$alumno->persona->nombre}} {{$alumno->persona->apellido}}</h2>
        </div>
        <form action="{{route('alumno.update', $alumno)}}" method="POST" onsubmit="disableButton()">
            @method('PUT')
            @csrf
            <div class="form-row">

                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Documento</label>                
                    <input type="text" name="documento" id="documento" class="form-control text-right" placeholder="Documento"
                    value="{{old('documento', number_format($alumno->persona->documento, 0, ".", "."))}}" onkeyup="punto_decimal(this)" required>
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." value="{{old('nombre', $alumno->persona->nombre)}}" onkeyup="mayuscula(this)"  required>
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido..." value="{{old('apellido', $alumno->persona->apellido)}}" onkeyup="mayuscula(this)"  required>
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Fecha Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{old('fecha_nacimiento', $alumno->persona->fecha_nacimientos)}}">
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option {{ old('sexo', $alumno->persona->sexo) == 0 ? 'selected' : '' }} value="0">SIN ESPECIFICAR</option>
                        <option {{ old('sexo', $alumno->persona->sexo) == 1 ? 'selected' : '' }} value="1">MASCULINO</option>
                        <option {{ old('sexo', $alumno->persona->sexo) == 2 ? 'selected' : '' }} value="2">FEMENINO</option>
                    </select>
                </div>
            
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Celular</label>
                    <input type="text" name="celular" id="celular" class="form-control" value="{{old('celular', $alumno->persona->celular)}}">
                </div>
            
                <div class="col-md-6 col-sm-6 mb-4">
                    <label for="">Direccion</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" onkeyup="mayuscula(this)" value="{{old('direccion', $alumno->persona->direccion)}}">
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email', $alumno->persona->email)}}">
                </div>
                
                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Turno</label>
                    <select name="turno_id" id="turno_id" class="form-control">
                        @foreach ($turnos as $item)
                            <option {{ old('turno_id', $alumno->turno_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->descripcion}}</option>
                        @endforeach                    
                    </select>
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <label for="">Grado</label>
                    <select name="curso_id" id="curso_id" class="form-control">
                        @foreach ($cursos as $item)
                            <option {{ old('curso_id', $alumno->curso_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->descripcion}}</option>
                        @endforeach                    
                    </select>
                </div>

            </div>

            <div class="form-row">
                <button type="submit" class="btn btn-success mt-3" id="submitBtn" onclick="this.disabled = true; this.form.submit();">Actualizar</button>
            </div>
        </form>

    </div>
</div>

@endsection

@section('js')
@endsection
