@inject('request', 'Illuminate\Http\Request')

@extends('layouts.app')

@section('content')

<style>

	.tabla{
		text-align: center;
		
		
	}
	
	.table-warning{
		
		
		text-align: center;
		font-size: 16px
	}
	.table-primary{
		
		text-align: center;
		font-size: 16px
		
		
	}
	.table-success{
		
		text-align: center;
		font-size: 16px
		
	}
</style>



<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/barra.css') }}" />
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

@can('user_create')


<section class="subscribe-area pb-50 pt-70">
<div class="container">

					<div class="col-md-4 col-lg-10">
						<div class="subscribe-text mb-15">
							<span>Telepacs IMCS</span>
							
							<h2>{{Auth::getUser()->name}}</h2>
						</div>
					</div>
					<div class="col-md-4 col-lg-2">
						<div class="subscribe2-wrapper mb-15">
							<div class="subscribe-form">
								
								<form action="#">
									
								@if(Auth::getUser()->role_id==2)
									<button><a href="{{ route('admin.users.create') }}" class="">@lang('quickadmin.qa_add_new')</a></button>
								@endif
									<br>
									
								    <a href="{{ url('/') }}">Retornar</a>
								@endcan
								
								</form>
							
							</div>
						</div>
					</div>
				</div>
<div class="col-md-8">
						<div class="subscribe-wrapper subscribe2-wrapper mb-15">
							<div class="subscribe-form">
							<!--	<form action="#">
									<input placeholder="enter your email address" type="email">
									
								</form> -->
							</div>
						</div>
					</div>
</section>
         <div class="panel-heading">
        </div>

        <div class="panel-body table-responsive">
      
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} @can('user_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('user_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th class="tabla">Unidad</th>
                        <th class="tabla">Cliente</th>
                        <th class="tabla">Informados</th>
                        <th class="tabla">NO Informados</th>
                        <th class="tabla">Informadas</th>
                        <th class="tabla">No Informadas</th>
                                                

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                @can('user_delete')
                                    <td></td>
                                @endcan

                                <td field-key='name' class="table-primary" >{{ $user->unidad }}</td>
                                <td field-key='name' class="table-primary" >{{ $user->name }}</td>
                                <td field-key='email'class="table-warning">{{ $user->totInf }}</td>
                                <td field-key='email'class="table-warning">{{ $user->totNoI }}</td>
                                <td field-key='role'class="table-success" ><a href="{{ route('verinforme',array(Session::get('ordenTipo'),1,$user->name,$user->unidad)) }}">{{ 'Ver' }}</a></td>
                                <td field-key='role'class="table-danger" ><a href="{{ route('verinforme',array(Session::get('ordenTipo'),2,$user->name,$user->unidad)) }}">{{ 'Ver' }}</a></td>
                                                               

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('user_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
        @endcan

    </script>
@endsection