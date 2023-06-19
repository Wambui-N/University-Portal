@extends('teacher.dashboard')
@section('func')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <p class="text-uppercase fs-5 fw-semibold text-secondary">{{ $course->name }}</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="d-flex justify-content-between mb-1 ms-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            <p class="fs-6 fw-normal m-0">Add Marks</p>
        </button>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
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
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" id="select-unit">
                                    <option selected>Select Unit</option>
                                    @foreach ($teachers as $teacher)
                                            @foreach ($course->units as $unit)
                                                @if ($unit->courseId == $course->courseId && $course->teacher_id == $teacher->id && $teacher->ADM == Auth::user()->ADM)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endif
                                            @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select mb-2" aria-label="Default select example" id="select-student">
                                    <option selected>Select Student</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="" class="form-control" id="floatingInput1" placeholder=" ">
                                <label for="floatingInput1">CAT 1</label>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="" class="form-control" id="floatingInput2" placeholder=" ">
                                <label for="floatingInput2">CAT 2</label>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="" class="form-control" id="floatingInput3" placeholder=" ">
                                <label for="floatingInput3">EXAM</label>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
