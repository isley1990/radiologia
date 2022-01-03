
@extends('layouts.app')
<style>
    .zoomIt{
    display:inline-block!important;
    -webkit-transition:-webkit-transform 1s ease-out;
    transition:transform 0.7s ease-out;
    margin-top:px;
}
.zoomIt:hover{
    margin-top:;
    -webkit-transform: scale(4);
    transform: scale(4);
    
}
    </style>

@section('content')
   <link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
 
    <link rel="stylesheet" href="{{ asset('css/marcos.css') }}" />
      <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
      <div class="center" style="height:40px;color:white">
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
    <h3 class="page-title" style="color:white">Paciente: {{$folder->name}}</h3>
    <p>

        @if (Auth::getUser()->role_id == 2 && $userFilesCount > 5)
         <!--   <a href="{{url('admin/files/create?folder_id=' . $folder->id)}}" class="btn btn-success">Agregar Imagenes</a>-->
           <a href="{{ route('cargaimg',['folder_id'=>$folder->id])}}" class="btn btn-success" role="button">Agregar Imágenes</a>
          @if (Auth::getUser()->role_id == 5)
                <!--<a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-danger">Regresar</a>-->
                <a href="{{ route('clientes',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-primary">Historial del Paciente</a>	
            @else
                <a href="{{ route('crearord2',['idTipo' => Session::get('ordenTipo'),'searchText'=>$folder->cedula]) }}" class="btn btn-primary">Historial del Paciente</a>
            @endif
            <!--<a href="{{ route('crearord2',['idTipo' => Session::get('ordenTipo'),'searchText'=>$folder->cedula]) }}" class="btn btn-danger">Volver Ordenes</a>-->

        @else
            <a href="{{url('admin/files/create?folder_id=' . $folder->id)}}" class="btn btn-success">Agregar Imágenes</a>
            <!--<a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-success">Volver Ordenes</a>-->
     @if (Auth::getUser()->role_id == 5)
                <!--<a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-danger">Regresar</a>-->
                <a href="{{ route('clientes',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-primary">Historial del Paciente</a>	
            @else
                <a href="{{ route('crearord2',['idTipo' => Session::get('ordenTipo'),'searchText'=>$folder->cedula]) }}" class="btn btn-danger">Historial del Paciente</a>
            @endif
        @endif
    <a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-danger">Finalizar</a>

    </p>
<div class="panel panel-default">
        <div class="panel-heading">
           Imágenes
        </div>
        {{--<div class="tab-content">--}}

        {{--<div role="tabpanel" class="tab-pane active " id="files">--}}
        <div class="center-block">
       
    <div id="carouselExampleControls" class="carousel slide col-xs-6 " data-ride="carousel"> <!-- class="carousel slide carousel-fade" data-ride="carousel"> -->
   
            <ol class="carousel-indicators">
            @foreach ($files as $file)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
            </ol>

            <div class="carousel-inner" role="listbox">
           
            @foreach ($files as $file)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
               
                @foreach($file->getMedia('filename') as $media)
                        @php
                            $extension = pathinfo($media->file_name)['extension'];
                        @endphp
                        @if($extension=="jpg" or $extension=="png" or $extension=="bmp" or $extension=="jpeg" or $extension=="dcm" )
                           
                            <a href="{{url('/admin/' . $file->uuid . '/download')}}"  target="_blank"><span class="zoomIt" aria-hidden="true"> <img class="d-block img-fluid" src="{{url('/admin/' . $file->uuid. '/download' )}}" alt="{{url('/admin/' . $file->uuid. '/download' )}}"></span> </a>
                            <div class="carousel-caption d-none d-md-block">                            
                            </div>
                        @endif
                @endforeach
                </div>
               
            @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
    </div>
    </div>
    
        <div class="row justify-content-start" > 
             <table class="table table-bordered table-striped {{ count($files) > 0 ? 'datatable' : '' }} @can('file_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
			    
                            <th > 
                            </th>
                    
                    <th>Archivo</th>
  
                   
                   
                </tr>
                </thead>

                <tbody>
                @if (count($files) > 0)
                    @foreach ($files as $file)
                    @foreach($file->getMedia('filename') as $media)
                    @php
                            $extension = pathinfo($media->file_name)['extension'];
                    @endphp
                      @if($extension=="jpg" || $extension=="zip" || $extension=="rar")
                        <tr data-entry-id="{{ $file->id }}">
                            <td> 
                                <input type="checkbox" value="{{ $file->id }}" name="files_selection[]" class="files_selection"/>
                            </td>
                            <td field-key='filename'>
                                @foreach($file->getMedia('filename') as $media)
                            
                                    <p class="form-group">
                                        <a href="{{url('/admin/' . $file->uuid . '/download')}}" target="_blank">{{ $media->name }} </a>
                                    </p>
                                @endforeach
                            </td>
                            @if( request('show_deleted') == 1 )
                            <td>
                                @can('file_delete')
                                    {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'POST',
                                    'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                    'route' => ['admin.files.restore', $file->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                @can('file_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.files.perma_del', $file->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                            @else
                            <td>
                                @can('file_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Esta seguro de elimiar")."');",
                                        'route' => ['eliminafile', $file->id, $folder->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                            @endif
                        </tr>
                        @endif
                    @endforeach
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
           
                </tbody>
            </table>
       
        </div>
        <button id="btnDescargar"
                type="submit" 
	            name="descarga"
	            onclick = "descargar()"
	            class="btn btn-success">
		      Descargar Seleccionados
		 </button>
  
    </div>
    
    {{  Form::hidden('url',URL::previous())  }}
    {{--</div>--}}
    {{--</div>--}}

    <p>&nbsp;</p>

   <!--  <a href="{{ route('admin.folders.index') }}" class="btn btn-success">Ver Ordenes</a> -->
   <script>
       
       function descargar() {
            var seleccionados = [];
            $(".files_selection:checked").each(function(){
                seleccionados.push($(this).val());            
            });     
            console.log(seleccionados);   
            if(seleccionados.length > 0){
                var url = "/downloadMasiva/"+seleccionados
                $('<form></form>').attr('action', url).appendTo('body').submit().remove();
                
                /*$('#downloadForm').submit(function(e) {
                    e.preventDefault(); 
                });     */  

                /*$.ajax({
                    type : "GET",
                    url:"/downloadMasiva/"+seleccionados, 
                    success: function(response) {
                        
                        //$('<form></form>').attr('action', response).appendTo('body').submit().remove();              
                    },
                    error: function(error){                       
                        console.log(error);  
                    }
                });*/
            }
           
        }
    </script>
    
    

@stop


    
