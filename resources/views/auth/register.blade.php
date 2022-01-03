<br><br>
<div class="col-md-4 col-lg-2">
<img class="rounded-pill"><a href=https://imcspacs.resonanciamagneticaguayaquil.com class="btn btn-danger text btn-lg"> <i class="fas fa-arrow-left"></i>Atras</a>
</div>
@extends('layouts.auth')
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<h3 class="text-center text-white mb-3" >.</h3> 
<h3 class="text-center text-white mb-3" >IMCS TELEPACS es una marca registrada de <a href="http://www.imcsol.com/">IMCS</a></h> 
<h3 class="text-center text-white mb-3">"Creemos en la Transformacion de la Salud"</h3>
<hr></div>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="{{ asset('css/registro.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <div class="container">
 <article class="card-body mx-auto" style="max-width: 400px;">
	 <div class="card bg-light " style="max-width: 400px;">
	<h4 class="card-title mt-10 text-center text-grey">Crear una Nueva Cuenta</h4>
	<p  class=" text-center text-grey" class="container">Unete a la Familia IMCS</p>
     <div class="card bg-light">
        <div class="card center bg-light">
            <div class="col-md-20 col-md-offset-20">
                <div class="form-group input-group">
                    <div class="panel-body">
                        <form class="form-group" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group input-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    <input id="name" type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="@lang('quickadmin.qa_email')" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
             
                            <div class="form-group input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-group-prepend" id="show_hide_password">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                     <input id="password-field" type="password" placeholder="@lang('quickadmin.qa_password')" class="form-control" name="password" required>
                             <div class="input-group-addon col-md-2 col-lg-2">
                            <span  toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" aria-hidden="true"></span>
                          </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group input-group">
                                
                                 
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    <input id="password-confirm" type="password" placeholder="@lang('quickadmin.qa_confirm_password')"class="form-control" name="password_confirmation" required>
                                </div>
                           </div>
                    
                           <div class="form-group input-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="glyphicon glyphicon-earphone"></i> </span>
                                    <input id="telephone" type="text" class="form-control" placeholder="Telefono" name="telefono" value="{{ old('telefono') }}" required autofocus>

                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group input-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="glyphicon glyphicon-home"></i> </span>
                                    <input id="telephone" type="text" class="form-control" placeholder="Dirección" name="direccion" value="{{ old('direccion') }}" required autofocus>

                                    @if ($errors->has('direccion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                           
                           
                           
                           
                           
     <!--                      <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
		 
		<select class="form-control">
			<option selected="">Profesión</option>
			<option>Obstetra</option>
			<option>Imagenólogo</option>
			<option>Medico General</option>
		</select>
	</div> 
               
                           
                          </div>-->

                   <p class="text-center" >Al Aceptar, usted esta de acuerdo a Nuestros Terminos Y <a href="https://drive.google.com/file/d/1XBho4tYZbMKnUF23mQPdjI4qyliw5BPy/view">Condiciones</a></p>   
                   
                <div class="form-group">
                                <div class="Text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Aceptar
                                    </button>
                                </div>
                </div>
            </div>
        </div>
    </div>
<p>
	<p class="divider-text">
        
    </p>
		
	</p>
	<article class="bg-secondary mx-auto">  
<div class="card-body text-center">
    <h3 class="text-white mt-2">Internacional Medical Center Solutions </h3>
<p class="h5 text-white"><span class="glyphicon">&#xe062;</span>  Matriz: Sauces 9 Mz: 533 Solar:13 <br><span class="glyphicon">&#xe182;</span> 04-4613752 / +593 96276 7278 <br><span class="glyphicon">&#x2709;</span>  infoimcsol@gmail.com </p> <br>
<p><a class="btn btn-info" target="_blank" href="https://www.facebook.com/imcsol/?__tn__=%2Cd%2CP-R&eid=ARD06kIl16qncaFwB47EKLeleiOC0M9hwwdscDyyXcTZNlCzDmNrYqw-R34g1rN0QwdJTAnWIis3kBhM"> Facebook 
 <i class="fa fa-window-restore "></i></a></p>
 
 @section('javascript')
    <script>
       $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

    </script>

@endsection
 
