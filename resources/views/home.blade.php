@extends('layouts.admin')

@section('styles')
@endsection

@section('content')

<div class="layout-px-spacing mt-4">

    <div class="mb-4">
        <h2>Bienvenido a la Escuela Virgen del Pilar</h2>
    </div>

    <div class="form-row">

        <div class="col-md-6 col-sm-6 mb-4">
            <div id="infobox2" class="col-xl-12 col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area text-center">
                        <div class="infobox-2">
                            <div class="info-icon">
                                <i class="fa-solid fa-children" style="font-size: 40px"></i>
                            </div>
                            <h5 class="info-heading mt-2">Aun no tienes vinculado a tu hij@?</h5>
                            <p class="info-text">Sigue los pasos para vincularlo.</p>
                            <a class="info-link" href="{{route('padre.create')}}">Registrar <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>

@endsection

@section('js')
@endsection
