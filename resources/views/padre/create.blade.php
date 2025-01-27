@extends('layouts.admin')

@section('styles')
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
@endsection
