@extends('layouts.home')

@section('workload')
<form action="/appointment" method="POST" onsubmit="return submitForm(this);">
@csrf
<input  type="hidden" name="add_meth" id="add_meth" value="1">
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
    <label  class="col-sm-2 col-form-label">Doctor</label>
    <div class="col-sm-4 ">
        <input list="doctors" class="form-control" name="search_doc" id="search_doc" required>
        <datalist id="doctors">
            @foreach($doctors as $doc)
                <option value="{{$doc->id}}">{{$doc->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="date" name="date" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Disease</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="disease" name="disease" required>
    </div>
  </div>
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
</form>
<script>
function submitForm()
{
    return confirm('Do you want to add this record ??');
}
</script>
@endsection
