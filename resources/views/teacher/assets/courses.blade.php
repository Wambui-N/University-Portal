@extends('teacher.dashboard')
@section('func')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 fs-4 text-secondary">Course</h4>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <div class="card-body bg-light rounded-0">
                            <h5 class="card-title fw-bold fs-5 mb-3">{{ $course->name }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <div class="d-flex justify-content-between">
                                <p> </p>
                                <a href="{{ route('units.index', $course->id) }}"
                                    class="btn btn-outline-secondary btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
