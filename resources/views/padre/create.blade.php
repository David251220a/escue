@extends('layouts.admin')

@section('styles')
    <link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="layout-px-spacing mt-4">

    <div class="mb-4">
        <h2>Padre: {{Auth::user()->documento}} - {{Auth::user()->name}} {{Auth::user()->lastname}}</h2>
    </div>

    @livewire('padre.padre-create')

</div>

@endsection

@section('js')
    <script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/padre.js')}}"></script>
@endsection
