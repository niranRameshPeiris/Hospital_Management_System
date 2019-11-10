@extends('layouts.home')
@section('workload')
<form method="GET" action="/status/{0}">
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
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Recommendations</th>
                        <th scope="col">Description</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(Session::get('reports') != null)
                    @foreach(Session::get('reports') as $report)
                    <tr>
                        <td>{{$report->date}}</td>
                        <td>{{$report->type}}</td>
                        <td>{{$report->health_status}}</td>
                        <td>{{$report->recommendations}} </td>
                        <td>{{$report->description}}</td>

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
