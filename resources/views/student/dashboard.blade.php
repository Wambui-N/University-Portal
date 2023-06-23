@extends('partial.menu')
@section('sidebar_menu')


@include('partial.custom.nav-item', ['href' => url('/dashboard'), 'activeUrl' => '/dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard'])
@include('partial.custom.nav-item', ['href' => url('/dashboard/student/enrollment'), 'activeUrl' => '/dashboard/student/enrollment' , 'icon' => 'fa-solid fa-users', 'label' => 'Course Enrollment'])
@include('partial.custom.nav-item', ['href' => url('/dashboard/grade_book'), 'activeUrl' => '/dashboard/gradebook', 'icon' => 'fa-solid fa-book', 'label' => 'Grade Book'])


@endsection

@section('dashboard_stuff')
    @yield('func')
@endsection
