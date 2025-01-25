@extends('layouts.admin')

@section('styles')
@endsection

@section('content')

<div class="layout-px-spacing mt-4">
    
    <div class="mb-4">
        <h2>Agregar Documentos Cursos</h2>
    </div>        
    <form action="{{route('documento.store')}}" method="POST" enctype="multipart/form-data" onsubmit="disableButton()">
        @csrf
        <div class="form-row">                
            
            <div class="col-md-2 col-sm-6 mb-4">
                <label for="ciclo_id">Ciclo</label>
                <select name="ciclo_id" id="ciclo_id" class="form-control">
                    @foreach ($ciclos as $item)
                        <option {{ old('ciclo_id') == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->anio}}</option>
                    @endforeach                    
                </select>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <label for="curso_id">Grado</label>
                <select name="curso_id" id="curso_id" class="form-control">
                    @foreach ($cursos as $item)
                        <option {{ old('curso_id') == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->descripcion}}</option>
                    @endforeach                    
                </select>
            </div>

            <div class="col-md-7 col-sm-6 mb-4">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion..." value="{{old('descripcion')}}" onkeyup="mayuscula(this)">
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <label for="pdf">PDF</label>
                <input type="file" name="pdf" id="pdf" accept=".pdf" class="form-control" required>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <label for="curso_id">Para todos los Grados?</label>
                <select name="completo" id="completo" class="form-control">                    
                    <option {{ old('completo') == 0 ? 'selected' : '' }} value="0">NO</option>
                    <option {{ old('completo') == 1 ? 'selected' : '' }} value="1">SI</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <button type="submit" class="btn btn-success mt-3" id="submitBtn" onclick="this.disabled = true; this.form.submit();">Crear</button>
        </div>
    </form>
    
</div>

@endsection

@section('js')
@endsection
