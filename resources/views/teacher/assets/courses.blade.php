@extends('teacher.dashboard')
@section('func')
    <!-- Content Header (Page header) -->
    <div>
        <h4 class="m-0 pt-1 pb-3 fs-4 accent-color">Courses</h4>
    </div>

    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-4">
            @foreach ($courses as $course)
                <div class="col mb-3">
                    <div class="card h-100">
                        <div class="card-body bg-light rounded-0">
                            <h5 class="card-title fw-bold fs-5 mb-3">{{ $course->name }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                        </div>
                        <div class="card-footer text-body-secondary d-grid gap-2">
                            <a href="{{ route('units.index', ['courseId' => $course->id]) }}"
                                class="btn secondary-button btn-sm">View</a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
