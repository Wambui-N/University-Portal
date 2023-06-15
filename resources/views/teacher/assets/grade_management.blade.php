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
    @foreach ($units as $unit)
        @foreach ($courses as $course)
            @foreach ($teachers as $teacher)
                @if ($course->teacher_id == $teacher->id && $unit->courseId == $course->courseId && $teacher->ADM == Auth::user()->ADM)
                        <p class="fw-normal fs-4">{{ $unit->name }}</p>
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
                                                    @if ($enrollments->count() > 0)
                                                        <td></td>
                                                    @else
                                                        <td>{{ $enrollment->cat1 }}</td>
                                                    @endif
                                                    @if ($enrollments->count() > 0)
                                                        <td></td>
                                                    @else
                                                        <td>{{ $enrollment->cat2 }}</td>
                                                    @endif
                                                    @if ($enrollments->count() > 0)
                                                        <td></td>
                                                    @else
                                                        <td>{{ $enrollment->exam }}</td>
                                                    @endif
                                                    @if ($enrollments->count() > 0)
                                                        <td></td>
                                                    @else
                                                        <td>{{ $enrollment->average }}</td>
                                                    @endif
                                                    @if ($enrollments->count() > 0)
                                                        <td></td>
                                                    @else
                                                        <td>{{ $enrollment->grade }}</td>
                                                    @endif
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            <!-- Edit button -->
                                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                                data-bs-target="#editModal">
                                                                <i class="fa-solid fa-user-pen fa-sm"
                                                                    style="color: #0d6efd"></i>
                                                            </button>

                                                            <!-- Delete button -->
                                                            <form class="m-0 p-0" method="POST" action="">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn" type="submit">
                                                                    <i class="fa-solid fa-trash fa-sm"
                                                                        style="color: #dc3545;"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                @endif
            @endforeach
        @endforeach
    @endforeach
@endsection
