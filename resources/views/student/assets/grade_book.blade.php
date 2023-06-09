@extends('student.dashboard')

@section('func')
    <!-- Content Header (Page header) -->
    <div>
        <h4 class="m-0 pt-1 pb-2 fs-4 accent-color">Grade Book</h4>
    </div>
    <div class="py-2 card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-color table-hover table-bg">
                <thead>
                    <tr>
                        <th scope="col">UNIT</th>
                        <th scope="col">CODE</th>
                        <th scope="col">RESULT</th>
                        <th scope="col">GRADE</th>
                        <th scope="col">REMARK</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        @foreach ($marks as $mark)
                            @if ($mark->code == $unit->code && $mark->ADM == Auth::user()->ADM)
                                <tr>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $mark->code }}</td>
                                    <td>{{ $mark->marks }}</td>
                                    <td>{{ $mark->grade }}</td>
                                    @if ($mark->grade == 'A' || $mark->grade == 'A-')
                                        <td>Excellent</td>
                                    @elseif ($mark->grade == 'B+' || $mark->grade == 'B' || $mark->grade == 'B-')
                                        <td>Very Good</td>
                                    @elseif ($mark->grade == 'C+' || $mark->grade == 'C' || $mark->grade == 'C-')
                                        <td>Good</td>
                                    @elseif ($mark->grade == 'D+' || $mark->grade == 'D' || $mark->grade == 'D-')
                                        <td>Pass</td>
                                    @elseif ($mark->grade == 'E' || $mark->grade == 'E-')
                                        <td>Fail</td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
