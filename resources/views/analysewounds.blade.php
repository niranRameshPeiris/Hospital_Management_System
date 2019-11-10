@extends('layouts.home')

@section('workload')
<form action="/predict-image" method="POST" enctype="multipart/form-data" onsubmit="return submitForm(this);">
@csrf
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Patient Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="date" name="date" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-4">
      <input type="file" class="form-control-file" accept="image/x-png,image/jpeg" id="image" name="image" required>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-primary btn-block">Predict </button>
    </div>
    <div class="col-sm-3">
        <button type="reset" class="btn btn-primary btn-block">Reset</button>
    </div>
    <div class="col-sm-3"></div>

  </div>
</form>
<script>
function submitForm()
{
    return confirm('Do you want to predict this image ??');
}
</script>
@endsection
