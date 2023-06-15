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
    <div class="table-responsive">
        <table id="example">
            <tr>    
                <th>STUDENT</th>
                <th>CAT 1</th>
                <th>CAT 2</th>
                <th>EXAM</th>
                <th>AVERAGE</th>
                <th>GRADE</th>
            </tr>
            @foreach ($marks as $mark)
            <td> </td>
                
            @endforeach
        </table>
    </div>

    <script>
        const container = document.querySelector('#example');

        const hot = new Handsontable(container, {
            ajax(){
                
            }
            data: [
                ['', 'Tesla', 'Volvo', 'Toyota', 'Ford'],
                ['2019', 10, 11, 12, 13],
                ['2020', 20, 11, 14, 13],
                ['2021', 30, 15, 12, 13]
            ],
            rowHeaders: true,
            colHeaders: true,
            height: 'auto',
            licenseKey: 'non-commercial-and-evaluation' // for non-commercial use only
        });
    </script>
@endsection
