@extends('partial.menu')

@section('sidebar_menu')
@include('partial.custom.nav-item', ['href' => url('/dashboard'), 'activeUrl' => '/dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard'])
@include('partial.custom.nav-item', ['href' => url('/dashboard/user_management'), 'activeUrl' => 'user_management', 'icon' => 'fa-users', 'label' => 'User Management'])
@include('partial.custom.nav-item', ['href' => url('/dashboard/course_management'), 'activeUrl' => 'course_management', 'icon' => 'fa-book', 'label' => 'Course Management'])
{{-- @include('partial.custom.nav-item', ['href' => url('/dashboard/communication'), 'activeUrl' => '/dashboard/communication' , 'icon' => 'fa-envelope', 'label' => 'Communication']) --}}
@endsection

@section('dashboard_stuff')
    @yield('func')
@endsection