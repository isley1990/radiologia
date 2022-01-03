@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <br>
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset ('imagen/user.png') }}" class="img-circle" alt="User Image" />
                <a href="#">
                    <span class="title">{{ Auth::getUser()->name}}</span>
                    <i class="fa fa-circle text-success"></i>
                    </br>
                    {{--                <span class="title">Online</span>--}}
                </a>
            </div>

        </div>
           <ul class="sidebar-menu">
            <li>

            </li>
           <!-- <li >
                <a href="#">
                    <i class="fa fa-address-card-o"></i>
                    <span class="title">{{ Auth::getUser()->name}}
                </a>
            </li>
        -->
            
            
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-desktop"></i>
                    <span class="title">Inicio</span>
                </a>
            </li>

            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">Panel de Control</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                            Personas
                            </span>
                        </a>
                    </li>
                @endcan

                @can('plantilla_access')
                <li class="{{ $request->segment(2) == 'plantillas' ? 'active active-sub' : '' }}">
                        <a href="{{ route('plantillasMenu') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                            Plantillas
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('folder_access')
            <li style="display:none" class="{{ $request->segment(2) == 'folders' ? 'active' : '' }}">
                <a href="{{ route('tiposmenu') }}">
                    <i class="fa fa-dedent"></i>
                    <span class="title">@lang('quickadmin.folders.title')</span>
                </a>
            </li>
            @endcan
            
           <!--  @can('file_access')
            <li class="{{ $request->segment(2) == 'files' ? 'active' : '' }}">
                <a href="{{ route('admin.files.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.files.title')</span>
                </a>
            </li>
            @endcan -->

           <!--  @can('plan_access')
            <li class="{{ $request->segment(2) == 'subscriptions' ? 'active' : '' }}">
                <a href="{{ route('admin.subscriptions.index') }}">
                    <i class="fa fa-credit-card"></i>
                    <span class="title">My Plan</span>
                </a>
            </li>
            @endcan -->


            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

