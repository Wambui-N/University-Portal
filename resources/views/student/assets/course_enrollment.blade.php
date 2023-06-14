@extends('student.dashboard')
@section('func')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 fs-4 text-secondary">Course Enrollment</h4>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if ($courses_students -> count() > 0)
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <p class="fs-5 fw-bold">Enrolled Courses</p>
                    <div class="row">

                        @foreach ($courses_students as $enrollment)
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($courses as $course)
                                            @if ($course->code == $enrollment->code)
                                                <p class="card-title fw-bold">{{ $course->name }}</p>
                                                <p class="card-text">{{ $course->description }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    @endif

    <div class="container-fluid">
        <div class="row">
            <p class="fs-5 fw-bold">Available Courses</p>
            @foreach ($courses as $course)
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ $course->description }}</p>

                            @foreach ($teachers as $teacher)
                                @foreach ($users as $user)
                                    @if ($teacher->id == $course->teacher_id && $user->ADM == $teacher->ADM)
                                        <p>{{ $user->name }}</p>
                                    @endif
                                @endforeach
                            @endforeach

                            <h6 class="card-subtitle mb-2 text-muted">Units:</h6>
                            @foreach ($course->units as $unit)
                                <p class="card-text">{{ $unit->name }}</p>
                            @endforeach

                            <form action="{{ route('enrollments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="ADM" value="{{ auth()->user()->ADM }}">
                                <input type="hidden" name="code" value="{{ $course->code }}">
                                <button type="submit" class="btn btn-primary">Enroll</button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
