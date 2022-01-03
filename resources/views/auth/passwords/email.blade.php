@extends('layouts.auth')

<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="{{ asset('css/planes.css') }}" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container mb-5 mt-5">
    <div class="pricing card-deck flex-column flex-md-row mb-3">
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Basico</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="15">$<span class="price">500</span><span class="h6 text-muted ml-2">/ por mes</span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4 text-muted">
                   <h3>Instalacion de Software</h3>
                   <h3>Acceso Ilimitado</h3>
                   <h3>Soporte Dicom</h3>
                   <h3>Soporte Jpeg</h3>
                   <h3>Examenes Por Dia(8)</h3>
                   <h3>Tiempo de Entrega(48 Horas)</h3>
                   <h3>Horario de Atencion (8am/2pm)</h3>
                   <h3>Usuario Multiple(1)</h3>
                   <h3>Visor Dicom y Jpeg</h3>
                   </ul>
                <button type="button" class="btn btn-outline-secondary mb-3">Order now</button>
            </div>
        </div>
        <div class="card card-pricing popular shadow text-center px-3 mb-4">
            <h5>Recomendado</h5>
            <span class="h6 w-80 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Regular</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30">$<span class="price">650</span><span class="h6 text-muted ml-2">/ por mes</span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4 text-muted ">
                   <h3>Instalacion de Software</h3>
                   <h3>Acceso Ilimitado</h3>
                   <h3>Soporte Dicom</h3>
                   <h3>Soporte Jpeg</h3>
                   <h3>Examenes Por Dia(8)</h3>
                   <h3>Tiempo de Entrega(48 Horas)</h3>
                   <h3>Horario de Atencion (8am/2pm)</h3>
                   <h3>Usuario Multiple(1)</h3>
                   <h3>Visor Dicom y Jpeg</h3>
                </ul>
                <a href="https://www.totoprayogo.com" target="_blank" class="btn btn-primary mb-3">Order Now</a>
            </div>
        </div>
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Destacado</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="45">$<span class="price">1400</span><span class="h6 text-muted ml-2">/ por mes</span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4 text-muted">
                    <h3>Instalacion de Software</h3>
                   <h3>Acceso Ilimitado</h3>
                   <h3>Soporte Dicom</h3>
                   <h3>Soporte Jpeg</h3>
                   <h3>Examenes Por Dia(8)</h3>
                   <h3>Tiempo de Entrega(48 Horas)</h3>
                   <h3>Horario de Atencion (8am/2pm)</h3>
                   <h3>Usuario Multiple(1)</h3>
                   <h3>Visor Dicom y Jpeg</h3>
                </ul>
                <button type="button" class="btn btn-outline-secondary mb-3">Order now</button>
            </div>
        </div>
        
    </div>
</div>
<div class="text-muted mt-5 mb-5 text-center small">by : <a class="text-muted" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>
