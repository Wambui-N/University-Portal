@extends('partial.menu')

@section('sidebar_menu')
    <li class="nav-item menu-open">
        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p class="fs-5">
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item rounded my-2  bg-primary">
        <a href="{{ url('/dashboard/user_management') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-users" style="color: #fff;"></i>
            <p>
                User Management
            </p>
        </a>
    </li>
    <li class="nav-item rounded my-2 bg-primary">
        <a href="{{ url('/dashboard/course_management') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-book" style="color: #fff;"></i>
            <p>
                Course Management
            </p>
        </a>
    </li>
    <li class="nav-item rounded my-2  bg-primary">
        <a href="{{ url('/dashboard/communication') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-envelope" style="color: #ffffff;"></i>
            <p>
                Communication
            </p>
        </a>
    </li>
@endsection

@section('dashboard_stuff')
    @yield('func')
@endsection
