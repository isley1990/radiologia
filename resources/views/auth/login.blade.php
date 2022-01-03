<br>
@extends('layouts.auth')

<link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <div class="container">
      <div class="row">
          <div class="col-sm-6 col-md-4 col-md-offset-4">
             <div class="panel panel-default">
               <div class="card bg-muted py-5 d-md-down-none">
                    <div class="card-body text-center">
                         <img class="profile-img" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                        <div>    
                     <h1 class="text-center text-grey login-title">Bienvenidos a IMCS-PACS</h1>
                    </div>
                </div>
                    <div class="panel-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> @lang('quickadmin.qa_there_were_problems_with_input'):
                    <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="form-horizontal"
                      role="form"
                      method="POST"
                      action="{{ url('login') }}">
                    <input type="hidden"
                           name="_token"
                           value="{{ csrf_token() }}">
                    <div class="form-group">
                          <div class="form-signin">
                            <input type="email"
                                   id="inputemail"
                                   placeholder="@lang('quickadmin.qa_email')"
                                   class="form-control"
                                   name="email"
                                   value="{{ old('email') }}">
                                   </div>                   
                    
                     <div class="form-group">
                         <div class="form-signin">
                        <div class="input-group" id="show_hide_password" style="width:85%; float: left;"> 
                          <input id="password-field" class="form-control" type="password" name="password" placeholder="@lang('quickadmin.qa_password')">
                        </div>
                         <div class="input-group-addon col-md-1 col-lg-2" style="width:15%; height:45px; float:right;">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password " style="width:75%; height:50px;"></span>
                          </div>
                       </div>
                      </div>  
                    
                     <div class="form-group">
                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-danger text btn-lg"
                                    style="text-center: 15px;">
                                @lang('quickadmin.qa_login')
                            </button>
                        </div>
                     <!-- <div class="form-group">
                        <div class="text-center">
                            <label class="checkbox pull-center"> 
                                <input type="checkbox"
                                       name="remember"> @lang('quickadmin.qa_remember_me')
                          
                            </label>
                        </div>  
                    -->
                    </div>
                     <div class="text-center">
               <a href="{{ route('auth.password.reset') }}">Renovar Plan</a> 
                    </div>
                     
                  
                    </div>
                  <div class="text-center text-primary">
                    <a href="{{ route('auth.register') }}"><p class="text-primary">Registrarse</p></a> 
                    
                    </div>
                </form>
               
            </div>
        </div>
     
    </div>
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
<!-- Start of LiveChat (www.livechatinc.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 12091032;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechatinc.com/chat-with/12091032/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->

@endsection

