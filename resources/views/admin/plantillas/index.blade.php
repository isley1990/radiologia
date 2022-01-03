@inject('request', 'Illuminate\Http\Request')

@extends('layouts.app')

@section('content')
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="{{ asset('css/marcos.css') }}" />
      <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <h5 class="page-title">Plantillas para Informes</h5>
    @can('role_create')
    <p>
        <a href="{{ route('crear') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($plantillas) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>Plantillas</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($plantillas) > 0)
                        @foreach ($plantillas as $plantilla)
                            <tr data-entry-id="{{ $plantilla->id }}">
                               <!--  @can('role_delete')
                                  
                                @endcan -->
                               
                                <td field-key='title' style="width:30%">{{ $plantilla->nombre }}</td>
                                <td style="width:70%">
                                    @can('plantilla_edit')
                                    <a href="{{ route('editar',[$plantilla->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan    
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
