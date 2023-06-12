@extends('teacher.dashboard')

@section('func')
    <div class="py-3">
        <div class="d-flex justify-content-between mb-1">
            <p class="mb-0 fs-5 fw-bold">{{ $course->name }}</p>
            <button type="button" class="btn btn-primary btn-sm border-0 my-0" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                <i class="fa-solid fa-plus" style="color: #ffffff"></i>
            </button>
        </div>
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Description</th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->units as $unit)
                    <tr>
                        <!-- Display unit details -->
                        <td>{{ $unit->code }}</td>
                        <td>{{ $unit->name }}</td>
                        <td>{{ $unit->description }}</td>

                        <td>
                            <div class="d-flex justify-content-end">
                                <!-- Edit button -->
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $unit->id }}">
                                    <i class="fa-solid fa-user-pen fa-sm" style="color: #0d6efd"></i>
                                </button>

                                <!-- Delete button -->
                                <form class="m-0 p-0" method="POST" action="{{ route('units.destroy', $unit->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">
                                        <i class="fa-solid fa-trash fa-sm" style="color: #dc3545;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <!-- Edit unit Modal -->
                    <div class="modal fade" id="editModal{{ $unit->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel{{ $unit->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel{{ $unit->id }}">Edit unit</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('units.update', $unit->id) }}" method="POST"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">Unit</label>
                                            <input name="name" type="text"
                                                value="{{ old('name', $unit->name ?? '') }}" class="form-control"
                                                id="validationCustom01" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">Description</label>
                                            <textarea name="description" type="text" class="form-control" id="validationCustom01" rows="5" required>{{ old('name', $unit->description ?? '') }}</textarea>
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
                    @endforeach

            </tbody>
        </table>
    </div>
    <!--New unit Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('units.store') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Unit</label>
                            <input name="name" type="text" class="form-control" id="validationCustom01" required>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Description</label>
                            <textarea name="description" type="text" class="form-control" id="validationCustom01" rows="5" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
