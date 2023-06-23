@extends('partial.menu')

@section('sidebar_menu')

{{-- @include('partial.custom.nav-item', ['href' => url('/dashboard'), 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard']) --}}
@include('partial.custom.nav-item', ['href' => url('/dashboard'), 'activeUrl' => '/dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'linkId' => 'dashboard-link'])

@include('partial.custom.nav-item', ['href' => url('/dashboard/teacher/courses'), 'activeUrl' => '/dashboard/teacher/courses', 'icon' => 'fa-solid fa-book', 'label' => 'Courses'])
<li class="nav-item rounded bg-none">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-solid fa-users" style="color: #38445a;"></i>
        <p class="fs-6 nav-link-color text-uppercase fw-normal">
            Grade Management
        </p>
    </a>

    @foreach ($teachers as $teacher)
        @foreach ($teacher->courses as $course)
            @if ($course->teacher_id == $teacher->id && $teacher->ADM == Auth::user()->ADM)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('grades.index', ['courseId' => $course->courseId]) }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: #38445a;"></i>
                            <p class="text-uppercase text-xs nav-link-color">{{ $course->name }}</p>
                        </a>
                    </li>
                </ul>
            @endif
        @endforeach
    @endforeach
</li>
{{-- @include('partial.custom.nav-item', ['href' => url('/dashboard/teacher/grades'), 'icon' => 'fa-solid fa-users', 'label' => 'Grade Management'])
@include('partial.custom.nav-item', ['href' => url('#'), 'icon' => 'fa-solid fa-users', 'label' => 'Student Perfomance'])
@include('partial.custom.nav-item', ['href' => url('#'), 'icon' => 'fa-envelope', 'label' => 'Communication']) --}}





@endsection

@section('dashboard_stuff')
    @yield('func')
@endsection
