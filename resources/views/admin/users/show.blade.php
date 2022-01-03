@extends('layouts.app')

@section('content')
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="{{ asset('css/marcos.css') }}" />
      <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <h3 class="page-title">Perfil De Usuario</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            
        </div>

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
 
 <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                    <br>
                        <img src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="" class="img-rounded img-responsive" /></br>
                    </div>
                    <div class="col-sm-6 col-md-8">
                    <tr>
                            <th></th>
                            <h3><U>{{ $user->name }}</U></h3>
                        </tr>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><td> {{ $user->email }}</td>
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href=></a>
                            <br />
                            <i class="glyphicon glyphicon-briefcase"></i><td>    {{ $user->role->title or '' }}</td>
                            <br />
                            <i class="glyphicon glyphicon-map-marker"></i><td>    {{ $user->direccion }}</td>
                            <br />
                           <i class="glyphicon glyphicon-phone-alt"></i><td>    {{ $user->telefono }}</td>
                            <br />
                            <i class="glyphicon glyphicon-list-alt"></i><td>    {{ $user->tipo_plan}}</td>
                            <br />
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
 <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#folders" aria-controls="folders" role="tab" data-toggle="tab">Folders</a></li>
<li role="presentation" class=""><a href="#files" aria-controls="files" role="tab" data-toggle="tab">Files</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="folders">
<table class="table table-bordered table-striped {{ count($folders) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.folders.fields.name')</th>
                        <th>@lang('quickadmin.folders.fields.created-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($folders) > 0)
            @foreach ($folders as $folder)
                <tr data-entry-id="{{ $folder->id }}">
                    <td field-key='name'>{{ $folder->name }}</td>
                                <td field-key='created_by'>{{ $folder->created_by->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['folders.restore', $folder->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['folders.perma_del', $folder->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('folders.show',[$folder->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('folders.edit',[$folder->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['folders.destroy', $folder->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
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
<div role="tabpanel" class="tab-pane " id="files">
<table class="table table-bordered table-striped {{ count($files) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.files.fields.folder')</th>
                        <th>@lang('quickadmin.files.fields.created-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($files) > 0)
            @foreach ($files as $file)
                <tr data-entry-id="{{ $file->id }}">
                    <td field-key='folder'>{{ $file->folder->name or '' }}</td>
                                <td field-key='created_by'>{{ $file->created_by->name or '' }}</td>
                                <td field-key='filename'>@if($file->filename)<a href="{{ asset(env('UPLOAD_PATH').'/' . $file->filename) }}" target="_blank">Download file</a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['files.restore', $file->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['files.perma_del', $file->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('files.show',[$file->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('files.edit',[$file->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['files.destroy', $file->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-danger">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
