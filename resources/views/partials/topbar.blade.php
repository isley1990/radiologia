<header class="main-header" >
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo" style="font-size: 14px; height:65px;  padding:0;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini" >
          Imcs</span>
          
        <!-- logo for regular state and mobile devices -->
        <span  class="logo-lg" style="background-image: {{ asset ('imagen/logo.png') }});
     padding-top : 30px;
    height: 60px;
    width: 230px;
    background-size: 100%;
    background-repeat:no-repeat;
   ">
           </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar " style="height:65px;">
       <div class="navbar-collapse collapse" >
           <ul class="nav navbar-nav navbar-right" style=" margin-bottom: 40px;">
            <font color="white"><h3>Plan: {{Auth::getUser()->tipo_plan}}</h3></font>
        </ul>
        
        
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle"  data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        
    </div>
  
    </nav>

</header>



