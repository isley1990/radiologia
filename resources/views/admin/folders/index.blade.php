@inject('request', 'Illuminate\Http\Request')

@extends('layouts.app')
<style>
	
	.estado{
		text-align: center;
		
		
	}
	
	
	.sininforme{
		
		text-align: center;
		
		
	}
	
	
	.fecha{
		
		text-align: center;

		
	}
	.tipo{
		
		text-align: center;

		
	}
	.tipoexa{
		
		text-align: center;
		Word-wrap: break-Word;
        max-width: 170px;

		
	}
	.paciente{
		
		text-align: center;

		
	}
	.acciones{
		
		text-align: center;

		
	}


</style>
@section('content')
<link rel="stylesheet" href="{{ asset('css/barra.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
   <link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

    @can('folder_create')
    
    <section class="subscribe-area pb-50 pt-70" >
    <div class="container">
        <p>
					<div class="col-md-4 col-lg-10">
						<div class="subscribe-text mb-15">

							<span>Telepacs  IMCS / {{ ($unidad[0]->name) }} / Area de 
							@if(Session::get('ordenTipo')=="RX")
							 Rayos X 
							@else
    							@if(Session::get('ordenTipo')=="ECO")
    							 Ecografía 
    							@else
    							Tomografía
    							
							 @endif
								
    						@endif
						
							<h3>{{Auth::getUser()->name}}</h3>
                           @if(Auth::getUser()->tipo_plan=='DESTACADO')
                            <h3>Total de Ordenes/Informes Disponibles: {{1000-count($folders)}}</h3>
                           @endif 
                           @if(Auth::getUser()->tipo_plan=='REGULAR')
                            <h3>Total de Ordenes/Informes Disponibles: {{500-count($folders)}}</h3>
                           @endif 
                           @if(Auth::getUser()->tipo_plan=='BASICO')
                            <h3>Total de Ordenes/Informes Disponibles: {{300-count($folders)}}</h3>
                           @endif 
                            
						</div>
					</div>
					<div class="col-md-4 col-lg-2">
						<div class="subscribe2-wrapper mb-15">
							<div class="subscribe-form">
    	<a href="{{ route('crearord',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-default btn-rounded" role="button">&nbsp;&nbsp;Crear&nbsp;&nbsp;&nbsp;</a>
    	
									<br>
									<br>
							@if(Auth::getUser()->role_id==2)
						
							<a href="{{ url('/') }}" class="btn btn-default">Retornar</a>	
								
						@else
							
									<a href="{{ route('clientes',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-default">Retornar</a>	
						@endif
								<br>
									<br>
    @if(!is_null(Auth::getUser()->role_id) && config('quickadmin.can_see_all_records_role_id') == Auth::getUser()->role_id)
                @if(Session::get('Folder.filter', 'all') == 'my')
                    <button><a href="?filter=all">Ver Todos</a></button>
                @else
                    <button><a href="?filter=my">Filtrar</a></button>
                @endif
            @endif
        </p>
      		</div>
						</div>
					</div>
				</div>
    @endcan
                               
                               
    <div class="col-md-8">
						<div class="subscribe-wrapper subscribe2-wrapper mb-15">
							<div class="subscribe-form">
						<!--		<form action="#">
									<input placeholder="enter your email address" type="email">
									
								</form> -->
							</div>
						</div>
					</div>

    <div class="panel panel-default">
               <div class="panel-body table-responsive">
            <table id="myTable" class="table table-bordered table-striped ">
                
                <thead>
                <tr class="titulosdelatabla">
                    @can('folder_delete')
                        @if ( request('show_deleted') != 1 )
                          @endif
                    @endcan

                    <th class="ident">C.I.</th>
                    <th class="paciente">Paciente</th>
                    <th class="fecha">Fecha</th>
                    <th>Exámen</th>
					<th class="tipoexa">Detalles</th>
                    <th class="estado">Estado</th>
                    <th class="acciones"colspan="4">Acciones</th>
                    
                  <!--   @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                    @else
                        
                    @endif -->
                    
                </tr>
                </thead>

                <tbody>
                @if (count($folders) > 0)
                    @foreach ($folders as $folder)
                        <tr data-entry-id="{{ $folder->id }}">
                            @can('folder_delete')
                                @if ( request('show_deleted') != 1 )
                                    @endif
                            @endcan

                            <td field-key='name'>
                             @can('folder_view')
                                    <a >{{$folder->cedula}}</a></td>
                                    
                            @endcan
                            <td field-key='namse'>
                             @can('folder_view')
                                    <a >{{$folder->name}}</a></td>
                                    
                            @endcan
                               
							<td field-key='updated_ad' class="fecha">
                             @can('folder_view')
                                    <a >{{$folder->updated_at}}</a></td>
                            @endcan
							<td field-key='updated_ad' class="fecha">
                             @can('folder_view')
                                    <a >{{$folder->detalle}}</a></td>
                                    
                            @endcan

                            <td field-key='tipo' class="tipoexa">
                             @can('folder_view')
                                    <a >{{$folder->orden}}</a></td>
                                    
                            @endcan

                            <!--<td field-key='respon'>
                             @can('folder_view')
                                    <a>{{$folder->respon}}</a></td>
                                    
                            @endcan -->
                            
                            
                           
                            <td field-key='informe' class="sininforme">
                             @can('folder_view')
                             @if($folder->informe=='')
                                    <a >Sin Informe</a></td>
                            @else        
                                     <a >Listo</a></td>
                            @endif       
                            @endcan
                            
 @if( request('show_deleted') == 1 )
                                <td>
                                    @can('folder_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'POST',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.folders.restore', $folder->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('folder_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.folders.perma_del', $folder->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
 @else
                                   @can('folder_edit')
                                   @if($folder->informe!='')
                                   <td>   <a href="{{ route('admin.folders.edit',[$folder->id]) }}" class="btn btn-xs btn-info">Informe</a> </td>
                                   @else
                                    <td> <a class="btn btn-xs btn-secondary" disabled="disabled">Informe</a> </td>
   
                                        @endif
                                   
                                   @if($folder->Informe!='')
                                    <td> <a class="btn btn-xs btn-warning" disabled="disabled">Imágenes</a> </td>
                                   @else
                                    <td> <a href="{{ route('imagenes',$folder->id) }}" class="btn btn-xs btn-warning">Imágenes</a> </td>
                                   @endif
                                @if($folder->informe!='')
                                <td>   <a href="{{ route('imprimir',[$folder->id])}}" class="btn btn-xs btn-info">Imprimir pdf</a> </td>
                                @else
                                 <td> <a class="btn btn-xs btn-secondary" disabled="disabled">Imprimir pdf</a> </td>

                                     @endif
                                   @if (Auth::getUser()->role_id == 5)
                <!--<a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-danger">Regresar</a>-->
              <td>  <a href="{{ route('clientes',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-xs btn-success">Historial</a></td>
            @else
                <td><a href="{{ route('crearord2',['idTipo' => Session::get('ordenTipo'),'searchText'=>$folder->cedula]) }}" class="btn btn-xs btn-success">Historial</a></td>
            @endif
                                   
                                    @endcan
                                    <td>
                                 @if($folder->informe=='')
                                    @can('folder_delete')
                                        {!! Form::open(array(
                                                                                'style' => 'display: inline-block;',
                                                                                'method' => 'DELETE',
                                                                                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                'route' => ['admin.folders.destroy', $folder->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                @endif
                                </td>
                            @endif
                           
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
    $(document).ready(function() {
    $('#myTable').DataTable({
        "aLengthMenu": [[5, 10, 50, -1], [5, 10, 50, "Todos"]],
       "pageLength":10,
        "iDisplayLength": 10
    });
} );
    </script>
    <script>
        @can('folder_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.folders.mass_destroy') }}'; @endif
        @endcan

    </script>
    
   @can('folder_delete')
        <div class="pull-right">
        <p>
     <!--   <ul class="list-inline">
                 <br> <a class="btn btn-primary btn-sm" href="{{ route('admin.folders.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a>
            |
            <a class="btn btn-primary btn-sm" href="{{ route('admin.folders.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a>
        </ul>-->
        </p>
    @endcan
</div>
@endsection
