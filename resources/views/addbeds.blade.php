@extends('layouts.home')

@section('workload')
<form action="/beds" method="POST" onsubmit="return submitForm(this);">
@csrf
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Bed Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="name" name="name" >
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Bed No</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="no" name="no" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Ward</label>
    <div class="col-sm-4 ">
        <input list="ward" class="form-control" name="search_name" id="search_name" required>
        <datalist id="ward">
            @foreach($wards as $wards)
                <option value="{{$wards->id}}">{{$wards->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-primary btn-block">Add  ward</button>
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
    return confirm('Do you want to add this record ??');
}
</script>
@endsection
