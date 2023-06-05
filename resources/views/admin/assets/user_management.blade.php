<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 fs-4 text-secondary">User Management</h4>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="d-flex justify-content-between mb-1">
    <p class="fs-5 fw-bold">Teachers</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        New Teacher
    </button>
</div>


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">ADM</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($teachers))
            @foreach ($teachers as $teacher)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->email }}</td>
                    <!-- Display more columns if required -->
                    <td>
                        <!-- Edit button -->
                        <a href="{{ route('teachers.edit', $teacher->id) }}">Edit</a>

                        <!-- Delete button -->
                        <form method="POST" action="{{ route('teachers.destroy', $teacher->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>

</table>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teachers.store') }}" class="row g-3 needs-validation" novalidate>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="validationCustom01" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" id="validationCustom02" value=" "
                            required>
                    </div>
                    <input type="hidden" name="usertype" value="1">
                    <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="validationCustomUsername"
                            aria-describedby="inputGroupPrepend" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submmit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>