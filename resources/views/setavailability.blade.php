@extends('layouts.home')

@section('workload')
<form action="/availability" method="POST" onsubmit="return submitForm(this);">
@csrf


  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="date" name="date" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Start Time</label>
    <div class="col-sm-4">
      <input type="time" class="form-control" id="start" name="start" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">End Time</label>
    <div class="col-sm-4">
      <input type="time" class="form-control" id="end" name="end" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Limit</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="limit" name="limit" required >
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
    return confirm('Do you want to add this record ??');
}
</script>
@endsection
