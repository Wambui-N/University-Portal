@extends('admin.dashboard')

@section('func')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 fs-4 text-secondary">User Management</h4>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="d-flex justify-content-between mb-1">
        <p class="fs-5 fw-bold">users</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            New user
        </button>
    </div>


    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">ADM</th>
                <th scope="col"> </th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->ADM }}</td>
                    <!-- Display more columns if required -->
                    <td>
                        <div class="d-flex">
                            <!-- Edit button -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa-solid fa-user-pen fa-sm" style="color: #0d6efd"></i>
                            </button>
                            
                            <!-- Delete button -->
                            <form class="m-0 p-0" method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">
                                    <i class="fa-solid fa-trash fa-sm" style="color: #dc3545;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>

    </table>



    <!--New User Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-7">
                            <label for="validationCustom01" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="validationCustom01" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label"></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="studentRole"
                                    value="student" required>
                                <label class="form-check-label" for="studentRole">
                                    Student
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="teacherRole"
                                    value="teacher">
                                <label class="form-check-label" for="teacherRole">
                                    Teacher
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="adminRole" value="admin">
                                <label class="form-check-label" for="adminRole">
                                    Admin
                                </label>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label for="validationCustom02" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="validationCustom02" value=""
                                required>
                        </div>
                        <div class="col-md-7">
                            <label for="validationCustomUsername" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="validationCustomUsername"
                                aria-describedby="inputGroupPrepend" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Edit User Modal -->
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="myModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="col-md-7">
                            <label for="validationCustom01" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="validationCustom01" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label"></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="studentRole"
                                    value="student" required>
                                <label class="form-check-label" for="studentRole">
                                    Student
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="teacherRole"
                                    value="teacher">
                                <label class="form-check-label" for="teacherRole">
                                    Teacher
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="adminRole" value="admin">
                                <label class="form-check-label" for="adminRole">
                                    Admin
                                </label>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label for="validationCustom02" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="validationCustom02" value=""
                                required>
                        </div>
                        <div class="col-md-7">
                            <label for="validationCustomUsername" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="validationCustomUsername"
                                aria-describedby="inputGroupPrepend" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
