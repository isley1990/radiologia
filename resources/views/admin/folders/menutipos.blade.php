@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="{{ asset('../css/marcos.css') }}" />
 <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
<div class="card border-primary " style="max-width: 25rem; float: right;border-radius: 31px 31px 31px 31px;
-moz-border-radius: 31px 31px 31px 31px;
-webkit-border-radius: 31px 31px 31px 31px;
border: 4px solid #1a308a;">
  <div class="card-body">
    <h4 class="text-center text-body">Telepacs IMCS </h4>
    </div>
</div>

<br><br><br><br>
<br>
<br><br>
<div class="text-center"> 
<div class="card-group">
  <div class="card">
    <h5 class="card-title"></h5>
    <img class="profile-img"  src="https://scontent.fgye1-1.fna.fbcdn.net/v/t1.15752-9/80403533_794873834287165_7834793038290354176_n.png?_nc_cat=104&_nc_oc=AQkrh-KGtmTFpbVbkeShTS84l0KGZaL97rByNzYnDIL3SqDK8wqhmHkIZ9Eu8tkCa5YVpCqjcpZTy7LnhpmQPXV6&_nc_ht=scontent.fgye1-1.fna&oh=c8811ed26f74b808f7b5baf521775331&oe=5E6995ED" alt="">
    <div class="card-body">
       
    @can('folder_access')
            <span class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
               @if(auth()->user()->role_id==2)
                <a href="{{ route('tipoOrd','RX') }}">
                <button type="button" class="btn btn-labeled btn-primary btn-lg">
                <span class="btn-label"><i class="glyphicon glyphicon-option-vertical"></i></span>Ordenes de Rayos X
                </button>
                </a>
               
               @else 
                <a href="{{ route('clientes','RX') }}">   
                <button type="button" class="btn btn-labeled btn-primary btn-lg">
                <span class="btn-label"><i class="glyphicon glyphicon-option-vertical"></i></span>Ordenes de Rayos X
                   <span class="badge badge-light">1</span>
  <span class="sr-only">unread messages</span>
                </button>
                </a> 
               
               @endif
                
            </span>
@endcan
<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <h5 class="card-title"></h5>
    <img class="profile-img" src="https://scontent.fgye1-1.fna.fbcdn.net/v/t1.15752-9/79644934_519716281951651_1351963384458772480_n.png?_nc_cat=107&_nc_oc=AQlDcg6UpsTZK1FYI-wryxSrwHKowUvGA6DhttkYNzOQU6LWrdJBIyXLFbFah_m4orgOjIW49tcuVqgledyYHqDr&_nc_ht=scontent.fgye1-1.fna&oh=6aa69130e0e34b60e88da43a33fefed0&oe=5EAF86B9" alt="">
    <div class="card-body">
      @can('folder_access')
            <span class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
            @if(auth()->user()->role_id==2)
                <a href="{{ route('tipoOrd','ECO') }}">
                <button type="button" class="btn btn-labeled btn-success btn-lg">
                <span class="btn-label"><i class="glyphicon glyphicon-option-vertical"></i></span>Ordenes de Ecografia
                </button>
                </a>
               
               @else 
                <a href="{{ route('clientes','ECO') }}">   
                <button type="button" class="btn btn-labeled btn-success btn-lg">
                <span class="btn-label"><i class="glyphicon glyphicon-option-vertical"></i></span>Ordenes de Ecografia
                   <span class="badge badge-light">2</span>
  <span class="sr-only">unread messages</span>
                </button>
                </a> 
               
               @endif
            </span>
@endcan 
      
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
<h5 class="card-title"></h5>
    <img class="profile-img" src="https://scontent.fgye1-1.fna.fbcdn.net/v/t1.15752-9/80024769_1860817540728891_3778726387527974912_n.png?_nc_cat=105&_nc_oc=AQkYzkAydrCLv9fcPmRA-QigBwV4RBp7FcS-QilLkrCNQR14bvTqUqZcWS-gsxT2RK9xmmFqRTffNEhentMWvjZq&_nc_ht=scontent.fgye1-1.fna&oh=c4b9d0855bd968750b545a1774875069&oe=5EAAE554" alt="">
    <div class="card-body">
      @can('folder_access')
            <span class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
            @if(auth()->user()->role_id==2)
                <a href="{{ route('tipoOrd','TM') }}">
                <button type="button" class="btn btn-labeled btn-danger btn-lg">
                <span class="btn-label"><i class="glyphicon glyphicon-option-vertical"></i></span>Ordenes de Tomografia
                </button>
                </a>
               
               @else 
                <a href="{{ route('clientes','TM') }}">   
                <button type="button" class="btn btn-labeled btn-danger btn-lg">
                <span class="btn-label"><i class="glyphicon glyphicon-option-vertical"></i></span>Ordenes de Tomografia
                <span class="badge badge-light">23</span>
  <span class="sr-only">unread messages</span>
                </button>
                </a> 
               
               @endif
            </span>
@endcan 
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  <div class="card">
<h5 class="card-title"></h5>
    <img class="profile-img" src="https://scontent.fgye1-1.fna.fbcdn.net/v/t1.15752-9/79408226_2181561195471168_3226895855327903744_n.png?_nc_cat=101&_nc_oc=AQl-qpeZ1GC_dNTXi0RFAtX96oDsMvIM5_vWKnjF9r0IIq0GxKS8sS1uRL2rEzH-SKz0LwoGxQZ4idP4ypErDsIK&_nc_ht=scontent.fgye1-1.fna&oh=892b4c20531eb837b04a5440b2d4c062&oe=5E6D235E" alt="">
    <div class="card-body">
      @can('folder_access')
            <span class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
            @if(auth()->user()->role_id==2)
                <a href="{{ route('tipoOrd','TM') }}">
                <button type="button" class="btn btn-labeled btn-warning btn-lg">
                <span class="btn-label"><i class="glyphicon glyphicon-option-vertical"></i></span>Ordenes de Resonancia
                </button>
                </a>
               
               @else 
                <a href="{{ route('clientes','TM') }}">   
                <button type="button" class="btn btn-labeled btn-warning btn-lg">
                <span class="btn-label"><i class="glyphicon glyphicon-option-vertical"></i></span>Ordenes de Resonancia
                <span class="badge badge-light">5</span>
  <span class="sr-only">unread messages</span>
                </button>
                </a> 
               
               @endif
            </span>
@endcan 
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
</div>
<div class="card">
<div style="margin: 1rem;
  padding: 1rem;
  border: 2px solid #ccc;
  text-align: center;" >
    <a href="http://www.facebook.com" target="_blank" class="btn btn-default">Contacto</a>
</div>
</div>
@endsection