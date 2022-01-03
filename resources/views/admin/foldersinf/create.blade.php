@extends('layouts.app')

@section('content')
   <!--  <h3 class="page-title">@lang('quickadmin.folders.title')</h3> -->
    {!! Form::open(['method' => 'POST', 'route' => ['admin.folders.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3  form-group">
                    {!! Form::label('name', 'Cédula'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('cedula', old('cedula'), ['class' => 'form-control', 'placeholder' => 'Cedula Paciente', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cedula'))
                        <p class="help-block">
                            {{ $errors->first('cedula') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Nombre'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Nombre Paciente', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Informe Solicitado'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('orden', old('orden'), ['class' => 'form-control', 'placeholder' => 'Orden Paciente', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('orden'))
                        <p class="help-block">
                            {{ $errors->first('orden') }}
                        </p>
                    @endif
                </div>
                <!-- <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Informe Realizado'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('informe', old('informe'), ['class' => 'form-control', 'placeholder' => 'Informe Paciente', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('informe'))
                        <p class="help-block">
                            {{ $errors->first('informe') }}
                        </p>
                    @endif
                </div> -->
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

