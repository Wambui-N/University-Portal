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
        <a href="{{ url('/dashboard/course_enrollment') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-users" style="color: #fff;"></i>
            <p>
                Course Enrollment
            </p>
        </a>
    </li>
    <li class="nav-item rounded my-2 bg-primary">
        <a href="{{ url('/dashboard/grade_book') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-book" style="color: #fff;"></i>
            <p>
                Grade Book
            </p>
        </a>
    </li>

    
@endsection

@section('dashboard_stuff')
    <div>
    </div>
@endsection
