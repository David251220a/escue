@extends('layouts.admin')

@section('styles')
@endsection

@section('content')

<div class="layout-px-spacing mt-4">

    <div class="row layout-spacing">
        <h2>Alumnos</h2>
        @livewire('alumno.index-alumno')
    </div>
</div>

@endsection

@section('js')
@endsection
