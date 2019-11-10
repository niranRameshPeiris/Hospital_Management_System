@extends('layouts.home')

@section('workload')
<form method="GET" action="/availability/{0}">
  <div class="form-group row justify-content-center">
    <label  class="col-sm-1 col-form-label">Doctor</label>
    <div class="col-sm-3 ">
        <input list="docs" class="form-control" name="doctor" id="doctor" required>
        <datalist id="docs">
            @foreach($doctors as $doc)
                <option value="{{$doc->id}}">{{$doc->name}}</option>
            @endforeach
        </datalist>
    </div>

    <label  class="col-sm-1 col-form-label">Date</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-block">Check</button>
    </div>
  </div>
</form>

<br>

<div class="row justify-content-center">
    <div class="col-sm-10">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Limit</th>
        <th scope="col">Appointments</th>
        <th scope="col">Availability</th>
      </tr>
    </thead>

    <tbody>
    @if(Session::get('docs') != null)
    @foreach(Session::get('docs') as $doc)
      <tr>
        <td>{{$doc->doctor}}</td>
        <td>{{$doc->date}}</td>
        <td>{{$doc->start}} - {{$doc->end}}</td>
        <td>{{$doc->limit}}</td>
        <td>{{$doc->status}}</td>
        <td>Available</td>
      </tr>
    @endforeach
    @endif
    </tbody>
  </table>
    </div>
</div>

@endsection
