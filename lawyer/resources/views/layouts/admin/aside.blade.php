<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{route('admin.home')}}" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{__('Lawyer')}}</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{$username}}</a>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @can('get users')
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link ">
                            {{--                        fa-solid fa-user-gear--}}
                            <i class="nav-icon"></i>
                            <p>
                                {{__('User MNG')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="fa-solid fa-users nav-icon"></i>
                                    <p>{{__('Users')}}</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan
                @can('get roles')
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link ">
                            {{--                        fa-solid fa-rectangle-xmark--}}
                            <i class="nav-icon"></i>
                            <p>
                                {{__('Role MNG')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="fa-solid fa-rectangle-list nav-icon"></i>
                                    <p>{{__('Roles')}}</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan
                @can('get appointments')
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link ">
                            {{--                        fa-solid fa-rectangle-xmark--}}
                            <i class="nav-icon"></i>
                            <p>
                                {{__('Appointment MNG')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('appointments.index')}}" class="nav-link">
                                    <i class="fa-solid fa-calendar nav-icon"></i>
                                    <p>{{__('Appointments')}}</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>

    </div>

</aside>
