@extends('layouts.home')

@section('workload')
<form action="/admit/{0}" method="POST" onsubmit="return submitForm(this);">
@method('PUT')
@csrf
<div class="form-group row">
    <label  class="col-sm-2 col-form-label">Patient</label>
    <div class="col-sm-4 ">
        <input list="patients" class="form-control" name="patient" id="patient" required>
        <datalist id="patients">
            @foreach($admits as $admit)
                <option value="{{$admit->id}}">{{$admit->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>


  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Ward</label>
    <div class="col-sm-4 ">
        <input list="wards" class="form-control" name="ward" id="ward" required>
        <datalist id="wards">
            @foreach($wards as $ward )
                <option value="{{$ward->id}}">{{$ward->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Bed</label>
    <div class="col-sm-4 ">
        <input list="beds" class="form-control" name="bed" id="bed" required>
        <datalist id="beds">
            @foreach($beds as $bed)
                <option value="{{$bed->id}}">{{$bed->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>

  @if($log != null)
  <div class="form-group row">
    <div class="col-sm-1"></div>
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-block">Set</button>
    </div>
    <div class="col-sm-2">
        <button type="reset" class="btn btn-primary btn-block">Reset</button>
    </div>
    <div class="col-sm-1"></div>
  </div>
  @endif
</form>
<script>
function submitForm()
{
    return confirm('Do you want delete this record ??');
}
</script>
@endsection
