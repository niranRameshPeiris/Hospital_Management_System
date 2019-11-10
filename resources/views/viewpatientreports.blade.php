@extends('layouts.home')
@section('workload')
<form method="GET" action="/report/{0}">
  <div class="form-group row justify-content-center">

    <label  class="col-sm-1 col-form-label">Patient</label>
    <div class="col-sm-3 ">
        <input list="patients" class="form-control" name="search_patient" id="search_patient" required>
        <datalist id="patients">
            @foreach($patients as $patient)
                <option value="{{$patient->id}}">{{$patient->name}}</option>
            @endforeach
        </datalist>
    </div>
    <label  class="col-sm-1 col-form-label">Date</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="date" name="date" >
    </div>

    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-block">Check</button>
    </div>
  </div>
</form>

<br>
<div class="row justify-content-center">

    <div class="col-sm-12  py-4">

            <div class="row justify-content-center">
                <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Title</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Threshold</th>
                        <th scope="col">Results</th>
                        <th scope="col">Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(Session::get('reports') != null)
                    @foreach(Session::get('reports') as $report)
                    <tr>
                        <td>{{$report->date}}</td>
                        <td>{{$report->title}}</td>
                        <td>{{$report->reason}}</td>
                        <td>{{$report->normal_health_status}} {{$report->health_status_type}}</td>
                        <td>{{$report->health_status}} {{$report->health_status_type}}</td>
                        <td>
                        @if($report->report_status == 'positive')
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                        @elseif($report->report_status == 'negative')
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                        @else
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                        @endif
                        </td>

                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
                </div>
            </div>

    </div>

</div>
@endsection
