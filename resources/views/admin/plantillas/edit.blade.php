@extends('layouts.app')

@section('content')
     
    {!! Form::model($plantilla, ['method' => 'PUT', 'route' => ['actualizar', $plantilla->id]]) !!}
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="{{ asset('css/marcos.css') }}" />
      <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', 'Nombre de Plantilla ', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 form-group">
                        {!! Form::label('detalle', 'Detalle'.'*', ['class' => 'control-label']) !!}
                        {!! Form::textarea('detalle', old('detalle'), ['id'=>'editor','class' => 'form-control', 'rows'=>10, 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('informe'))
                            <p class="help-block">
                                {{ $errors->first('informe') }}
                            </p>
                        @endif             
                </div> 
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
     <a href="{{ url()->previous() }}" class="btn btn-success">Retornar</a>
    {!! Form::close() !!}
  
    @section('javascript')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
    @endsection
@stop

