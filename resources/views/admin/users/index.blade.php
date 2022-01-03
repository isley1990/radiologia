@inject('request', 'Illuminate\Http\Request')

@extends('layouts.app')

@section('content')
   <link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

   <link rel="stylesheet" href="{{ asset('css/marcos.css') }}" />
      <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <h3 class="page-title">Personas - Clientes IMCS</h3>
    @can('user_create')
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Agregar Nuevo</a>
        
    </p>
    @endcan
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered {{ count($users) > 0 ? 'datatable' : '' }} @can('user_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('user_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>Nombre</th>
                       
                        <th>Teléfono</th>
                        <th>Tipo de Cuenta</th>
                        <th>Tipo de Plan</th> 
                        <th>Opciones</th>
                                               

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                @can('user_delete')
                                    <td></td>
                                @endcan
                                <td field-key='name' class="table-primary" >{{ $user->name }}</td>
                              
                                <td field-key='telefono' class="table-success"> {{ $user->telefono }}</td>
                                <td field-key='role' class="table-danger" >{{ $user->role->title or '' }}</td>
                                <td field-key='tipo_plan' class="table-secondary" >{{ $user->tipo_plan}}</td>

                                                                
                                                                <td class="table-info">
                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('user_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

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
   
@endsection