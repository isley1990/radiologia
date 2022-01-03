
@inject('request', 'Illuminate\Http\Request')

@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet"> 
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
<style>
.carta{
border: 2px solid rgba(60, 141, 188, 0.781);
border-radius: 35px;
margin-left: 750px;
border-radius: 35px;

}

.card-title{
  font-size: 21px ; 
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  text-align: center;
}

</style>

<link rel="stylesheet" href="{{ asset('css/marcos.css') }}" />

<div class="carta" style="max-width: 32rem; background-color: #f4f6f7; margin: 0 auto; ">
  <div class="card-body">
    <h5 class="card-title">Telepacs IMCS - {{Auth::getUser()->name}} </h5>
  </div>
  
  
</div>

<!-- Muestra el bot贸n de forma destacada para descubrir f谩cilmente
     el bot贸n principal dentro de un grupo de botones -->

<br><br>
<div class="text-center"> 
<div class="card-group">
  <div class="card">
    <h5 class="card-title"></h5>
    <img class="profile-img"  src="{{ asset ('images/rayos.png') }}" alt="">
    <div class="card-body">
    @can('folder_access')
            <span class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
               @if(auth()->user()->role_id==2)
                <a href="{{ route('tipoOrd','RX') }}">
                <button type="button" class="btn btn-labeled btn-secondary btn-lg">
                <span class="btn-label"></span>Ordenes de Rayos X
                </button>
                </a>
               
               @else 
                @if(auth()->user()->role_id==1)
                  <a href="#">   
                  <button type="button" class="btn btn-labeled btn-secondary btn-lg disabled">
                  <span class="btn-label"></span>Ordenes de Rayos X
                  </button>
                  </a> 
                @else
                  <a href="{{ route('clientes','RX') }}">   
                  <button type="button" class="btn btn-labeled btn-secondary btn-lg">
                  <span class="btn-label"></span>Ordenes de Rayos X
                  </button>
                  </a> 
                @endif
                
               
               @endif
                
            </span>
@endcan
    </div>
  </div>
  <div class="card">
    <h5 class="card-title"></h5>
    <img class="profile-img" src="{{ asset ('images/eco.png') }}" alt="">
    <div class="card-body">
      @can('folder_access')
            <span class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
            @if(auth()->user()->role_id==2)
                <a href="{{ route('tipoOrd','ECO') }}">
                <button type="button" class="btn btn-labeled btn-success btn-lg">
                <span class="btn-label"></span>Ordenes de Ecografía
                </button>
                </a>
               
               @else 
                @if(auth()->user()->role_id==1)
                  <a href="#">
                  <button type="button" class="btn btn-labeled btn-secondary btn-lg disabled">
                  <span class="btn-label"></span>Ordenes de Ecografía
                  </button>
                  </a>    
                @else
                  <a href="{{ route('clientes','ECO') }}">   
                  <button type="button" class="btn btn-labeled btn-success btn-lg">
                  <span class="btn-label"></span>Ordenes de Ecografía
                    
                  </button>
                  </a>
                @endif
               
               @endif
            </span>
@endcan 
      
    </div>
  </div>
  <div class="card">
<h5 class="card-title"></h5>
    <img class="profile-img" src="{{ asset ('images/tomografia.png') }}" alt="">
    <div class="card-body">
      @can('folder_access')
            <span class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
            @if(auth()->user()->role_id==2)
                <a href="#">
                <button type="button" class="btn btn-labeled btn-danger btn-lg disabled">
                <span class="btn-label"></span>Ordenes de Tomografía
                </button>
                </a>
               
               @else 
                <a href="#}}">   
                <button type="button" class="btn btn-labeled btn-danger btn-lg disabled">
                <span class="btn-label"></span>Ordenes de Tomografía
                
                </button>
                </a> 
               
               @endif
            </span>
@endcan 
      </div>
    </div>
  <div class="card">
<h5 class="card-title"></h5>
    <img class="profile-img" src="{{ asset ('images/resonancia.png')}}" alt="">
    <div class="card-body">
      @can('folder_access')
            <span class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
            @if(auth()->user()->role_id==2)
                <a href="#">
                <button type="button" class="btn btn-labeled btn-warning btn-lg disabled">
                <span class="btn-label"></span>Ordenes de Resonancia
                </button>
                </a>
               
               @else 
                <a href="#">   
                <button type="button" class="btn btn-labeled btn-warning btn-lg disabled">
                <span class="btn-label"></span>Ordenes de Resonancia
                
                </button>
                </a> 
               
               @endif
            </span>
@endcan 
         </div>
      </div>
  
  </div>
<br><br><br><br>

</div>
{{--<p class="h6">IMCS TELEPACS BETA VERSION</p>--}}
</section>
<button type="button" class="btn btn-labeled btn-info btn-lg pull-right" style="margin: 15px;">
    <a href="https://www.facebook.com/imcsol/" aria-pressed="false">Contáctenos</a>
</button>
@endsection
