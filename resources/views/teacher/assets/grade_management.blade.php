@extends('teacher.dashboard')
@section('func')
    <!-- Content Header (Page header) -->
    <div>
        <h4 class="m-0 pt-1 pb-3 fs-4 accent-color">Grade Management</h4>
    </div>
    <p class="fs-5 fw-bold">{{ $course->name }}</p>


    <!-- Main content -->
    <div class="d-flex justify-content-between mb-1">
        <button type="button" class="btn primary-button" data-toggle="modal" data-target="#modal-lg">
            <p class="fs-6 fw-normal m-0">Add Marks</p>
        </button>
        <form action="{{ route('grades.notify') }}" method="GET" class="">
            <div class="d-grid gap-2 d-md-block">
                <button class="btn secondary-button" type="submit">Notify Students</button>
            </div>
        </form>
    </div>
    <div class="py-2 card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-color table-hover table-bg">
                <thead>
                    <tr>
                        <th scope="col">STUDENT</th>
                        <th scope="col">ADM</th>
                        <th scope="col">UNIT</th>
                        <th scope="col">CAT 1</th>
                        <th scope="col">CAT 2</th>
                        <th scope="col">EXAM</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col">GRADE</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course->units as $unit)
                        @foreach ($marks as $mark)
                            @if ($mark->code == $unit->code && $unit->courseId == $course->courseId)
                                <tr>

                                    @foreach ($users as $user)
                                        @if ($mark->ADM == $user->ADM)
                                            <td>{{ $user->name }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $mark->ADM }}</td>
                                    <td>{{ $mark->code }}</td>
                                    <td>{{ $mark->cat1 }}</td>
                                    <td>{{ $mark->cat2 }}</td>
                                    <td>{{ $mark->exam }}</td>
                                    <td>{{ $mark->marks }}</td>
                                    <td>{{ $mark->grade }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <!-- Edit button -->
                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $mark->id }}">
                                                <i class="fa-solid fa-user-pen fa-sm" style="color: #0d6efd"></i>
                                            </button>

                                            <!-- Delete button -->
                                            <form class="m-0 p-0" method="POST"
                                                action="{{ route('grades.destroy', $mark->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" type="submit">
                                                    <i class="fa-solid fa-trash fa-sm" style="color: #dc3545;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                    <!-- Edit mark Modal -->
                    <div class="modal fade" id="editModal{{ $mark->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel{{ $mark->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel{{ $mark->id }}">
                                        Edit
                                        mark</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('grades.update', $mark->id) }}" method="POST"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">CAT
                                                1</label>
                                            <input name="cat1" type="text"
                                                value="{{ old('name', $mark->cat1 ?? '') }}" class="form-control"
                                                id="validationCustom01" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">CAT
                                                2</label>
                                            <input name="cat2" type="text"
                                                value="{{ old('name', $mark->cat2 ?? '') }}" class="form-control"
                                                id="validationCustom01" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">EXAM</label>
                                            <input name="exam" type="text"
                                                value="{{ old('name', $mark->exam ?? '') }}" class="form-control"
                                                id="validationCustom01" required>
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
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
    </div>


    <!-- Add Marks Modal -->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" id="select-unit"
                                    name="code">
                                    <option selected>Select Unit</option>
                                    @foreach ($course->units as $unit)
                                        <option value="{{ $unit->code }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select mb-2" aria-label="Default select example" id="select-student"
                                    name="ADM">
                                    <option selected>Select Student</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="text" name="cat1" class="form-control" id="floatingInput1"
                                    placeholder=" ">
                                <label for="floatingInput1">CAT 1</label>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="text" name="cat2" class="form-control" id="floatingInput2"
                                    placeholder=" ">
                                <label for="floatingInput2">CAT 2</label>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="text" name="exam" class="form-control" id="floatingInput3"
                                    placeholder=" ">
                                <label for="floatingInput3">EXAM</label>
                            </div>
                            <div class="modal-footer col-12 justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Mark</button>
                            </div>
                        </div>
                    </form>

                </div>


            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
