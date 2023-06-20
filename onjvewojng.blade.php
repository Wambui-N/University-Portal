<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">STUDENT</th>
            <th scope="col">ADM</th>
            <th scope="col">CAT 1</th>
            <th scope="col">CAT 2</th>
            <th scope="col">EXAM</th>
            <th scope="col">TOTAL</th>
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
                                        <i class="fa-solid fa-user-pen fa-sm" style="color: #0d6efd"></i>
                                    </button>
                                </div>

                        </td>
                    </tr>

                    <!-- Edit mark Modal -->
                    <div class="modal fade" id="editModal{{ $mark->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel{{ $mark->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel{{ $mark->id }}">Edit mark</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('grades.update', $mark->id) }}" method="POST"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">CAT 1</label>
                                            <input name="cat1" type="text"
                                                value="{{ old('name', $mark->cat1 ?? '') }}" class="form-control"
                                                id="validationCustom01" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">CAT 2</label>
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


<div class="col-md-6">
    <select class="form-select" aria-label="Default select example" id="select-unit">
        <option selected>Select Unit</option>
        @foreach ($teachers as $teacher)
            @foreach ($courses as $course)
                @foreach ($units as $unit)
                    @if ($unit->courseId == $course->courseId && $course->teacher_id == $teacher->id && $teacher->ADM == Auth::user()->ADM)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endif
                @endforeach
            @endforeach
        @endforeach
    </select>
</div>
<div class="col-md-6">
    <select class="form-select mb-2" aria-label="Default select example" id="select-student">
        <option selected>Select Student</option>
        @foreach ($enrollments as $enrollment)
            @foreach ($students as $student)
                @if ($enrollment->code == $course->code)
                    <option value="{{ $student->id }}">{{ $student->ADM }}</option>
                @endif
            @endforeach
        @endforeach
    </select>
</div>




<script>
    $(document).ready(function() {
        // Add a change event listener to the make select element
        $('#vehicle-make').change(function() {
            // Get the selected make value
            const selectedMake = $(this).val();


            // Send an AJAX request to fetch the makeId options for the selected make
            $.ajax({
                url: "{{ route('get_models', '') }}/" + selectedMake,
                type: 'GET',
                success: function(data) {
                    // Remove existing options from the makeId select element
                    // $('#model').empty();
                    $('#vehicle-model option:not(:first)').remove();


                    // Create a new option for each makeId and append it to the makeId select element
                    $.each(data, function(index, value) {
                        $('#vehicle-model').append('<option value="' + value.model + '">' + value.model + '</option>');
                    });

                    const selectedMakeName = $('#vehicle-make option:selected').text();

                    // Set the value of the organization input field to the selected make name
                    $('#make_name').val(selectedMakeName);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching makeId options: ' + error);
                }
            });
        });
    });
</script>
