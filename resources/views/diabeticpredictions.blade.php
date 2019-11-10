@extends('layouts.home')
@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <form action="/predict" method="POST">
@csrf
<input  name="type" id="type" value="00" type="hidden">
<div class="form-group row">
    <label  class="col-sm-2 col-form-label">Patient</label>
    <div class="col-sm-4 ">
        <input list="patients" class="form-control" name="search_patient" id="search_patient" required>
        <datalist id="patients">
            @foreach($patients as $patient)
                <option value="{{$patient->id}}">{{$patient->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>


  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">value 01</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="val01" name="val01" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Value 02</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="val02" name="val02" required>
    </div>
  </div>



  <div class="form-group row">
    <div class="col-sm-1"></div>
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-block">Predict</button>
    </div>
    <div class="col-sm-2">
        <button type="reset" class="btn btn-primary btn-block">Reset</button>
    </div>
    <div class="col-sm-1"></div>
  </div>
</form>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-sm-12">
    @if($results != null)
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">NIC</th>
        <th scope="col">Gender</th>
        <th scope="col">Contact</th>
        <th scope="col">Prediction</th>
      </tr>
    </thead>

    <tbody>
    @foreach($results as $result)
      <tr>
        <td>{{$result->name}}</td>
        <td>{{$result->nic}} </td>
        <td>{{$result->gender}}</td>
        <td>{{$result->contact}}</td>
        <td>{{$prediction}}</td>
        <!-- <td>
            @if($prediction == 'positive')
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            @elseif($prediction == 'negative')
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            @endif
        </td> -->
      </tr>
    @endforeach
    </tbody>
  </table>
  @endif
    </div>
</div>
@endsection
