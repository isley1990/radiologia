
@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/create.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet"> 
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

@section('content')
    <h3 class="page-title">@lang('quickadmin.files.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.files.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
            
        </div>

     
            </div>
           <h5>Solo Imagenes de 640x480*</h5>
        </div>
    </div>
<div class="row">
    <div class="col-md-4 col-lg-2">
        @if ($auxFrm == 1)
               
                <a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-danger">Volver Ordenes</a>
            @else
          
                <a href="{{ route('crearord',['idTipo' => Session::get('ordenTipo')])  }}" class="btn btn-danger">Volver Ordenes</a>
            @endif
    
    <!--<a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-danger">Volver Ordenes</a>-->
    </div>
  </div>
 {!! Form::text('folder_id', $folders[0]->id,['class' => 'invisible'  ]) !!}
  {!! Form::text('created_by_id', $folders[0]->created_by_id,['class' => 'invisible'  ]) !!}
    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary', 'id' => 'submitBtn']) !!}
    {!! Form::close() !!}
@stop