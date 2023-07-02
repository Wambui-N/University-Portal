@extends('student.dashboard')
@section('func')
    <!-- Content Header (Page header) -->
    <div>
        <h4 class="m-0 pt-1 pb-3 fs-4 accent-color">Course Enrollment</h4>
    </div>

    <!--enrolled courses-->
    <p class="fs-5 fw-normal">Enrolled</p>
    @if ($courses_students->count() > 0)
        <div class="container-fluid pb-3">
            <div class="row">
                @foreach ($courses_students as $enrollment)
                    @if ($enrollment->ADM == auth()->user()->ADM)
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    @foreach ($courses as $course)
                                        @if ($course->code == $enrollment->code)
                                            <p class="card-title fw-semibold">{{ $course->name }}</p>
                                            <p class="card-text">{{ $course->description }}</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    @endif


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="fs-5 fw-normal mb-4">Available Courses</h2>
            </div>
            @foreach ($courses as $course)
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $course->name }}</h5>
                            <p class="card-text">{{ $course->description }}</p>

                            <div class="mb-3">
                                {{-- <h6 class="card-subtitle mb-2 text-muted">Teacher:</h6> --}}
                                @foreach ($teachers as $teacher)
                                    @foreach ($users as $user)
                                        @if ($teacher->id == $course->teacher_id && $user->ADM == $teacher->ADM)
                                            <p class="mb-0">Taught by: {{ $user->name }}</p>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <h6 class="card-subtitle mb-2 text-muted">Units:</h6>
                                @foreach ($course->units as $unit)
                                    <p class="card-text">{{ $unit->name }}</p>
                                @endforeach
                            </div>

                        </div>
                        <div class="card-footer text-body-secondary d-grid gap-2">
                            <form action="{{ route('enrollments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="ADM" value="{{ auth()->user()->ADM }}">
                                <input type="hidden" name="code" value="{{ $course->code }}">
                                <button type="submit" class="btn primary-button">Enroll</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
