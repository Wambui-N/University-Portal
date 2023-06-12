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
    <li class="nav-item rounded my-2 bg-primary">
        <a href="{{ url('/dashboard/teacher/courses') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-book" style="color: #fff;"></i>
            <p>
                Courses
            </p>
        </a>
    </li>
    <li class="nav-item rounded my-2  bg-primary">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-solid fa-users" style="color: #fff;"></i>
            <p>
                Grade Management
            </p>
        </a>
    </li>
    <li class="nav-item rounded my-2  bg-primary">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-solid fa-users" style="color: #fff;"></i>
            <p>
                Student Perfomance
            </p>
        </a>
    </li>
    <li class="nav-item rounded my-2  bg-primary">
        <a href="{{ url('/dashboard/teacher/communication') }}" class="nav-link">
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


