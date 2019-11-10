@extends('layouts.home')

@section('workload')
<form action="/status" method="POST" onsubmit="return submitForm(this);">
@csrf
<input type="hidden"  id="type" name="type" value="daily" required>
<div class="form-group row">
    <label  class="col-sm-2 col-form-label">Patient</label>
    <div class="col-sm-4 ">

        <input list="patients" class="form-control" name="patient_li" id="patient_li" required>
        <datalist id="patients">
        @if($admits != null)
            @foreach($admits as $admit)
                <option value="{{$admit->id}}">{{$admit->name}}</option>
            @endforeach
            @endif
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
    <label  class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="status" name="status" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Recommendations/Medicine</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="recommendations" name="recommendations" rows="3" required></textarea>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
  </div>

  @if($admits != null)
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
    return confirm('Do you want to add this record ??');
}
</script>
@endsection
