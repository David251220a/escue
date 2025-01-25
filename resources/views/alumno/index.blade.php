@extends('layouts.admin')

@section('styles')
    <link href=" {{asset('assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
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
