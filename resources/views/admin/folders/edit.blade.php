@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/marcos.css') }}" />
      <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet"> 
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
<style>

	.panel-heading{
		
		
		font-size: 25px;
	}


</style>
@section('content')
    
    {!! Form::model($folder, ['method' => 'PUT', 'route' => ['admin.folders.update', $folder->id]]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
          Informes IMCS
        </div>

        <div class="panel-body">

<div class="col-xs-7 ">


<div id="carouselExampleControls" class="carousel slide" data-interval="5000" data-ride="carousel"> <!-- class="carousel slide carousel-fade" data-ride="carousel"> -->
   <ol class="carousel-indicators">
   @foreach ($files as $file)
       <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
   @endforeach
   </ol>

   <div class="carousel-inner" role="listbox">
        @php 
      $i=0;
      @endphp
   @foreach ($files as $file)
       <div class="item {{ $loop->first ? 'active' : '' }}">
      
       @foreach($file->getMedia('filename') as $media)
               @php
                   $extension = pathinfo($media->file_name)['extension'];
                    $i=$i+1;
                   
               @endphp
               @if($extension=="jpg" or $extension=="png" or $extension=="bmp" or $extension=="jpeg" or $extension=="dcm" )
                  
                <div class="img-zoom-container">
                   <img id="myimage" name="myimage" class="d-block img-fluid" src="{{url('/admin/' . $file->uuid. '/download' )}}"
                   alt="{{url('/admin/' . $file->uuid. '/download' )}}">
                  
                
                   <div class="carousel-caption d-none d-md-block">
                   <h3>{{ $i }}</h3>
                   </div>
                 <!--   <div id="myresult" class="img-zoom-result"></div>-->
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
<br>
@if(Auth::getUser()->role_id==5 or $folder->informe=='')
                    {!! Form::submit('Grabar', ['class' => 'btn btn-danger']) !!}
                    @endif
                     @if(Auth::getUser()->role_id==5 )
                    <a href="{{  route('clientes',Session::get('ordenTipo')) }}" class="btn btn-success">Listado de Unidades </a>
                    @else
                    <a href="{{  route('tipoOrd',Session::get('ordenTipo')) }}" class="btn btn-success">Listado de Pacientes</a>
                    @endif
                    <a href="{{ route('imprimir',[$folder->id])}}" class="btn btn-info">Imprimir pdf</a>
                    <input class="btn btn-success" type="button" value="Regresar " onClick="history.go(-2);">
	
	<div><br>
  <!--<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Historial de examenes
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#"> Examen 0</a>
    <a class="dropdown-item" href="#">Examen 1</a>
    <a class="dropdown-item" href="#">Examen 2</a>
    <a class="dropdown-item" href="#">examen 3</a>
  </div>-->
</div>
</div>



<div class="col-sm-5 ">
                <div class="col-xs-12 form-group">
                 @if(Auth::getUser()->role_id==5)

              <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', 'Plantilla para Informe', ['class' => 'control-label']) !!}
                    {!! Form::select('plantilla_id', $plantillasLista, old('plantilla_id'), ['id'=>'idplantilla','class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('plantilla_id'))
                        <p class="help-block">
                            {{ $errors->first('plantilla_id') }}
                        </p>
                    @endif
                </div>
                
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Informe'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('informe', old('informe'), ['id'=>'editor','class' => 'form-control','rows'=>10, 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('informe'))
                        <p class="help-block">
                            {{ $errors->first('informe') }}
                        </p>
                    @endif
               
                </div> 
                @else
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Informe'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('informe', old('informe'), ['id'=>'editor','class' => 'form-control', 'rows'=>10, 'placeholder' => '','readonly' => 'readonly']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('informe'))
                        <p class="help-block">
                            {{ $errors->first('informe') }}
                        </p>
                    @endif             
                </div> 
                @endif    
                
                </div>
                 <div class="col-xs-2 form-group">
                    {!! Form::label('name', 'Unidad', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::text('unidad', old('unidad'), ['class' => 'form-control', 'placeholder' => '', 'readonly' => 'readonly']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('unidad'))
                        <p class="help-block">
                            {{ $errors->first('unidad') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('name', 'Cédula', ['class' => 'control-label']) !!}
                </div>
                 <div class="col-xs-4 form-group"> 
                @if(Auth::getUser()->role_id==5 or $folder->informe!='')
                  
                 {!! Form::text('cedula', old('cedula'), ['class' => 'form-control', 'placeholder' => '', 'readonly' => 'readonly']) !!}
                @else
               
                {!! Form::text('cedula', old('cedula'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                @endif 
                    <p class="help-block"></p>
                    @if($errors->has('cedula'))
                        <p class="help-block">
                            {{ $errors->first('cedula') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('name', 'Nombres  ', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-10 form-group">
                @if(Auth::getUser()->role_id==5 or $folder->informe!='')
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'readonly' => 'readonly']) !!}
                @else
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                @endif
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Detalles'.'*', ['class' => 'control-label']) !!}
                    @if(Auth::getUser()->role_id==5 or $folder->informe!='') 
                    {!! Form::textarea('orden', old('orden'), ['class' => 'form-control', 'rows'=>2, 'placeholder' => '', 'readonly' => 'readonly']) !!}
                    @else
                    {!! Form::textarea('orden', old('orden'), ['class' => 'form-control', 'rows'=>2, 'placeholder' => '', 'required' => '']) !!}
                    @endif
                    <p class="help-block"></p>
                    @if($errors->has('orden'))
                        <p class="help-block">
                            {{ $errors->first('orden') }}
                        </p>
                    @endif
                </div>
              

             
            </div>
           
        </div>
    </div>
    
    
    @section('javascript')
        <script>
        // Initiate zoom effect:
        imageZoom("myimage", "myresult");
        </script>

   <script>
    // Initiate zoom effect:
    
    </script>
    <script type="text/javascript">
    // Call carousel manually
    $('#carouselExampleControls').carousel();
    
    </script>

        <script type="text/javascript">
            $('.carousel').carousel({
                 interval: 16000,
                 pause:true,
                 wrap:false
            });
        </script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>

    <script>
        $(document).ready(function(){
            $('#idplantilla').change(function(){
              
                var itemdetalle = $('#idplantilla option:selected').val();
                
                 const detalles = @json($plantillaTolal);
                
                 for (i=0; i< detalles.length; i++){
                     if (itemdetalle==detalles[i].id){
                        var text = CKEDITOR.instances["editor"].getData();
                        const newText= detalles[i].detalle;
                      //  console.log(newText) );
                        CKEDITOR.instances["editor"].setData(newText); 
                     }
                 }

            });
        });		

    </script>
    
    

    @endsection
    {!! Form::close() !!}

@stop

