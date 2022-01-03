@extends('layouts.app')

@section('content')
   <link rel="stylesheet" href="{{ asset('css/crear.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
   <link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
   <!--  <h3 class="page-title">@lang('quickadmin.folders.title')</h3> -->   
   <div class="center" style="height:40px;margin-left:10px;color:white">
    <div class="col-md-6 col-lg-14">
        <div class="subscribe-text mb-20">
            
            <span>Telepacs  IMS / Área de 
            @if(Session::get('ordenTipo')=="RX")
             Rayos X 
            @else
                @if(Session::get('ordenTipo')=="ECO")
                 Ecografía 
                @else
                Tomografía
                
             @endif
                
            @endif
            /{{Auth::getUser()->name}}/
            
    <!--<input type="button" value="Página anterior" onClick="history.go(-1);">-->
            
        </div>
    </div>  
    
</div>
    <div class="panel panel-default">        
        <div class="panel-heading center" style="height:60px;">
            <h3 class="center">Crear Nueva Petición</h3>                    
            <!--<input type="button" value="Página anterior" onClick="history.go(-1);">-->
                    
            
        </div>
     
        <div class="panel-body">
        @include('admin.folders.search',array('idTipo' => $idTipoOrd))
          {!! Form::open(['method' => 'POST', 'route' => ['admin.folders.store']]) !!}
         <!--  @if(session('msj'))
            <div class="alert alert-success " id="success-alert" role="alert" > 
                {{session('msj')}}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>  
        @endif
        @if(session('errormsj'))
            <div class="alert alert-error " id="success-alert" role="alert" > 
            {{session('errormsj')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif-->
        @if(session('errormsjE'))
            <div class="alert alert-error " id="success-alert" role="alert" > 
            {{session('errormsjE')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        <div class="row " > 
                
                <div class="col-xs-2 form-group">
                    {!! Form::label('tipo_ord', 'Tipo de Orden', ['class' => 'control-label']) !!}
                    {!! Form::text('tipo_ord',$idTipoOrd, ['class' => 'form-control', '', 'readonly' => 'readonly']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('tipo_ord'))
                        <p class="help-block">
                            {{ $errors->first('tipo_ord') }}
                        </p>
                    @endif
                    
                </div>
            
            <div class="col-xs-3  form-group">
              
                {!! Form::label('name', 'Unidad'.'*', ['class' => 'control-label']) !!}
                 @if($unidad[0]->name=='Admin')
                    {!! Form::text('unidad', 'Imcs', ['class' => 'form-control', 'placeholder' => 'Cedula Paciente', 'readonly' => 'readonly']) !!}
                @else
                  {!! Form::text('unidad', $unidad[0]->name, ['class' => 'form-control', 'placeholder' => 'Cedula Paciente', 'readonly' => 'readonly']) !!}
                @endif
                    <p class="help-block"></p>
                    @if($errors->has('cedula'))
                        <p class="help-block">
                            {{ $errors->first('cedula') }}
                        </p>
                    @endif
                </div>
         
                <div class="col-xs-2  form-group">
                    {!! Form::label('name', 'Cédula'.'*', ['class' => 'control-label']) !!}
                    @if(count($folders))                     
                    @if($folders[0]->cedula !=null)
                        {!! Form::text('cedula',$folders[0]->cedula, ['class' => 'form-control', 'placeholder' => 'Cedula Paciente',
                        'readonly' => 'readonly','maxlength'=>10,]) !!}
                    @else                          
                        {!! Form::text('cedula',$auxCedula, ['class' => 'form-control', 'placeholder' => 'Cedula Paciente', 
                        'readonly' => 'readonly','maxlength'=>10,]) !!}
                    @endif
                @else
                    {!! Form::text('cedula',old('cedula'), ['class' => 'form-control', 'placeholder' => 'Cedula Paciente',
                    'readonly' => 'readonly','maxlength'=>10,]) !!}
                @endif
                    <p class="help-block"></p>
                    @if($errors->has('cedula'))
                        <p class="help-block">
                            {{ $errors->first('cedula') }}
                        </p>
                    @endif
                </div> 
                <div class="col-xs-5 form-group">
                    {!! Form::label('name', 'Nombre'.'*', ['class' => 'control-label']) !!}
                     @if(count($folders)>0)                     
                        @if($folders[0]->name !=null)
                            {!! Form::text('name', $folders[0]->name, ['class' => 'form-control', 
                            'placeholder' => 'Nombre Paciente', 'readonly' => 'readonly']) !!}
                        @else
                            {!! Form::text('name', old('name'), ['class' => 'form-control','placeholder' => 'Nombre Paciente',
                            'required' => '']) !!}
                        @endif
                    @else
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Nombre Paciente',
                                'readonly' => 'readonly']) !!}
                    @endif
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                  
                </div>
                </div>        
    <div class="row " >   
        <div class="col-xs-4 form-group">
        {!! Form::label('examenes', 'Examenes'.'*', ['class' => 'control-label']) !!}
          {!! Form::select('detalle', $examenes, old('detalle'), ['class' => 'form-control select2','required' => '','disabled' => false]) !!} 
       </div>
        <div class="col-xs-4 form-group">
                    {!! Form::label('name', 'Informe Solicitado'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('orden', old('orden'), ['class' => 'form-control ', 'rows' => 2,  'placeholder' => 'Orden Paciente', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('orden'))
                        <p class="help-block">
                            {{ $errors->first('orden') }}
                        </p>
                    @endif
        </div>
        <div class="col-xs-4 form-group">
        <br><br>
            {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-success']) !!}
            <a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-danger">Regresar</a>
              {!! Form::close() !!}             
        </div>  
    </div>
    <div class="center">
    <div class="panel panel-default">
           <div class="panel-body table-responsive">
        <table id="myTable" class="table table-bordered table-striped ">
            <thead>
            <tr>
                @can('folder_delete')
                    @if ( request('show_deleted') != 1 )
                      @endif
                @endcan
                <th>Id</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Tipo de Exámen</th>
                <th>Informe</th>
                <th colspan="3">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($folders as $cuo)
			<tr>
                <td>{{ $cuo->id}}</td>
			    <td>{{ $cuo->name}}</td>
				<td>{{ $cuo->updated_at}}</td>
				<td>{{ $cuo->orden}}</td>
				<td field-key='informe'>
                             @can('folder_view')
                             @if($cuo->informe=='')
                                    <a >Sin Informe</a></td>
                            @else        
                                     <a >Listo</a></td>
                            @endif
                            @endcan
			
                @can('folder_edit')
                                   @if($cuo->informe!='')
                                    <td> <a class="btn btn-xs btn-warning" disabled="disabled">Imágenes</a> </td>
                                   @else
                                    <td> <a href="{{ route('admin.folders.show',[$cuo->id]) }}" class="btn btn-xs btn-warning">Imágenes</a> </td>
                                   @endif
                                   
                                   @if($cuo->informe!='')
                                    <td >   <a href="{{ route('admin.folders.edit',[$cuo->id]) }}" class="btn btn-xs btn-info">Informe</a>  </td>
                                    @else
                                  <td> <a class="btn btn-xs btn-info" disabled="disabled">Informe</a> </td>
                                    @endif
                                    @endcan
                                   @can('folder_delete')
                @if($cuo->informe=='')
                <td>                    
                                        {!! Form::open(array(
                                                            'style' => 'display: inline-block;',
                                                            'method' => 'DELETE',
                                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                            'route' => ['elimOrden', $cuo->id,$cuo->cedula])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        </td>                    
                    @else 
                    <td> <a class="btn btn-xs btn-danger" disabled="disabled">Eliminar</a> </td>      
                                @endif
                @endcan
			</tr>
		@endforeach
            </tbody>
        </table>
    </div>
</div>
    </div>
<br><br><br>
@stop
<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);


</script>

