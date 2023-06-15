@extends('teacher.dashboard')
@section('func')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 fs-4 text-secondary">Grade Management</h4>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div id="example"></div>
    <!-- Grade Management Table -->
    @foreach ($courses as $course)
        @foreach ($teachers as $teacher)
            @if ($course->teacher_id == $teacher->id && $teacher->ADM == Auth::user()->ADM)
                <p class="fw-light fs-6 text-uppercase">{{ $course->name }}</p>
                @foreach ($course->units as $unit)
                    @if ($unit->courseId == $course->courseId && $teacher->ADM == Auth::user()->ADM)
                        <p class="fw-normal fs-6">{{ $unit->name }}</p>
                        <div class="table-responsive">
                            <table class="table table-borderless bg-light">
                                <thead>
                                    <tr>
                                        <th scope="col">STUDENT</th>
                                        <th scope="col">ADM</th>
                                        <th scope="col">CAT 1</th>
                                        <th scope="col">CAT 2</th>
                                        <th scope="col">EXAM</th>
                                        <th scope="col">AVERAGE</th>
                                        <th scope="col">GRADE</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enrollments as $enrollment)
                                        @foreach ($users as $user)
                                            @if ($enrollment->ADM == $user->ADM && $course->code == $enrollment->code)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->ADM }}</td>
                                                    @php
                                                        $foundMark = $marks->where('code', $enrollment->code)->first();
                                                    @endphp
                                                    <td>{{ $foundMark ? $foundMark->cat1 : '' }}</td>
                                                    <td>{{ $foundMark ? $foundMark->cat2 : '' }}</td>
                                                    <td>{{ $foundMark ? $foundMark->exam : '' }}</td>
                                                    <td>{{ $foundMark ? $foundMark->average : '' }}</td>
                                                    <td>{{ $foundMark ? $foundMark->grade : '' }}</td>
                                                    <td>
                                                        @foreach ($marks as $mark)
                                                        <div class="d-flex justify-content-end">
                                                            <!-- Edit button -->
                                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $mark->id }}">
                                                                <i class="fa-solid fa-user-pen fa-sm"
                                                                    style="color: #0d6efd"></i>
                                                            </button>
                                                        </div>
                                                        
                                                    </td>
                                                </tr>

                                                <!-- Edit mark Modal -->
                                                <div class="modal fade" id="editModal{{ $mark->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $mark->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="editModalLabel{{ $mark->id }}">Edit mark</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('grades.update', $mark->id) }}"
                                                                    method="POST" class="row g-3 needs-validation"
                                                                    novalidate>
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="col-md-12">
                                                                        <label for="validationCustom01"
                                                                            class="form-label">CAT 1</label>
                                                                        <input name="cat1" type="text"
                                                                            value="{{ old('name', $mark->cat1 ?? '') }}"
                                                                            class="form-control" id="validationCustom01"
                                                                            required>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="validationCustom01"
                                                                            class="form-label">CAT 2</label>
                                                                        <input name="cat2" type="text"
                                                                            value="{{ old('name', $mark->cat2 ?? '') }}"
                                                                            class="form-control" id="validationCustom01"
                                                                            required>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="validationCustom01"
                                                                            class="form-label">EXAM</label>
                                                                        <input name="exam" type="text"
                                                                            value="{{ old('name', $mark->exam ?? '') }}"
                                                                            class="form-control" id="validationCustom01"
                                                                            required>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach

                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endforeach
@endsection
