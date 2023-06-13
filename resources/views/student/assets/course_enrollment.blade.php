@extends('student.dashboard')
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

    <!-- /.content-header -->
    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <p class="fs-5 fw-bold">Enrolled Courses</p>
                @foreach ($courses_students as $enrollment)
                    <div class="row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid --> --}}


    <div class="container-fluid">
        <div class="row">
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
