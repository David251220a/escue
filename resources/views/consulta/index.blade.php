@extends('layouts.admin')

@section('styles')
    <link href=" {{asset('assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="layout-px-spacing mt-4">

    <div class="row layout-spacing">
        <h2>Consulta de Curso</h2>
        @livewire('consulta.consulta-index')
    </div>
</div>

@endsection

@section('js')
@endsection
