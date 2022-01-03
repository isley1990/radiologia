@extends('layouts.app')

@section('content')
   
    {!! Form::open(['method' => 'POST', 'route' => ['admin.users.store']]) !!}
   <link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ asset('css/marcos.css') }}" />
      <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <h4>Bienvenido  {{ auth()->user()->name }} </h4>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
        
        <div class="row d-none" >
                <div class="col-xs-4 form-group">
                    {!! Form::label('id_padre', 'id del cliente', ['class' => 'control-label']) !!}
                    {!! Form::text('id_padre', auth()->user()->id, ['class' => 'form-control', '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_padre'))
                        <p class="help-block">
                            {{ $errors->first('id_padre') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('name', 'Nombres', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
           
                <div class="col-xs-4 form-group">
                    {!! Form::label('email', 'Correo Electronico', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('password', trans('quickadmin.users.fields.password').'*', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
          
                <div class="col-xs-4 form-group">
                    {!! Form::label('role_id', 'Tipo de usuario', ['class' => 'control-label']) !!}
                  @if (auth()->user()->id==1)
                    {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                  @else
                  
                  {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control select2','required' => '','disabled' => false]) !!}
                  @endif
                  
                    <p class="help-block"></p>
                    @if($errors->has('role_id'))
                        <p class="help-block">
                            {{ $errors->first('role_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
             <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('telefono', 'Teléfono', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', old('telefono'), ['class' => 'form-control', 'placeholder' => '', 'required' => '','maxlength'=>'10']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('telefono'))
                        <p class="help-block">
                            {{ $errors->first('telefono') }}
                        </p>
                    @endif
                </div>
           
                <div class="col-xs-4 form-group">
                    {!! Form::label('direccion', 'Dirección', ['class' => 'control-label']) !!}
                    {!! Form::text('direccion', old('direccion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('direccion'))
                        <p class="help-block">
                            {{ $errors->first('direccion') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row" >
                <div class="col-xs-4 form-group">
                @if(auth()->user()->role_id==4)
                {!! Form::label('tipo_planes', 'Tipo de usuario', ['class' => 'control-label']) !!}
                {!! Form::select('tipo_plan', array('BASICO' => 'BASICO', 'DESTACADO' => 'DESTACADO', 'REGULAR' => 'REGULAR'), auth()->user()->tipo_plan, ['class' => 'form-control select2','required' => '','disabled' => true]) !!}
               @else
                {!! Form::label('tipo_planes', 'Tipo de usuario', ['class' => 'control-label']) !!}
                {!! Form::select('tipo_plan', array('BASICO' => 'BASICO', 'DESTACADO' => 'DESTACADO', 'REGULAR' => 'REGULAR'), 'BASICO', ['class' => 'form-control select2','required' => '','disabled' => false]) !!}
              
              @endif 
            </div>
            </div>
  
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop

