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
    <li class="nav-item">
        <a href="{{ url('/dashboard/user_management') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-users" style="color: #fff;"></i>
            <p>
                User Management
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/dashboard/course_management') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-book-copy" style="color: #fff;"></i>
            <p>
                Course Management
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/dashboard/communication') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-envelopes" style="color: #ffffff;"></i>
            <p>
                Communication
            </p>
        </a>
    </li>
@endsection

@section('dashboard_stuff')
    @yield('func')
@endsection


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Usertype</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
