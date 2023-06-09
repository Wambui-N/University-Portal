@extends('admin.dashboard')

@section('func')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 fs-4 text-secondary">Course Management</h4>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="d-flex justify-content-between mb-1">
        <p class="fs-5 fw-bold">courses</p>
        <button type="button" class="btn btn-primary btn-sm border-0 my-0" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            <i class="fa-solid fa-plus" style="color: #ffffff"></i>
        </button>
    </div>



    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Title</th>
                <th scope="col">Teacher</th>
                <th scope="col">Description</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <!-- Display course details -->
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->teacher->ADM }}</td>
                    <td>{{ $course->description }}</td>
                    
                    <td>
                        <div class="d-flex justify-content-end">
                            <!-- Edit button -->
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $course->id }}">
                                <i class="fa-solid fa-user-pen fa-sm" style="color: #0d6efd"></i>
                            </button>

                            <!-- Delete button -->
                            <form class="m-0 p-0" method="POST" action="{{ route('courses.destroy', $course->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">
                                    <i class="fa-solid fa-trash fa-sm" style="color: #dc3545;"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>

                <!-- Edit course Modal -->
                <div class="modal fade" id="editModal{{ $course->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="editModalLabel{{ $course->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel{{ $course->id }}">Edit course</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('courses.update', $course->id) }}" method="POST"
                                    class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">Title</label>
                                        <input name="name" type="text" value="{{ old('name', $course->name ?? '') }}"
                                            class="form-control" id="validationCustom01" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">Teacher</label>
                                        <input name="ADM" type="text" value="{{ old('ADM', $course->ADM ?? '') }}"
                                            class="form-control" id="validationCustom01" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">Description</label>
                                        <textarea name="description" type="text" class="form-control" id="validationCustom01" rows="5" required>{{ old('name', $course->description ?? '') }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </tbody>

    </table>



    <!--New course Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('courses.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Title</label>
                            <input name="name" type="text" class="form-control" id="validationCustom01" required>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Teacher</label>
                            <input name="ADM" type="text" class="form-control" id="validationCustom01" required>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Description</label>
                            <textarea name="description" type="text" class="form-control" id="validationCustom01" rows="5" required></textarea>
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
