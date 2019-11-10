@extends('layouts.home')

@section('workload')
<form action="/wards" method="POST" onsubmit="return submitForm(this);">
@csrf
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Ward Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Doctor</label>
    <div class="col-sm-4 ">
        <input list="doctors" class="form-control" name="search_name" id="search_name" required>
        <datalist id="doctors">
            @foreach($doctors as $doc)
                <option value="{{$doc->id}}">{{$doc->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Ward No</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="no" name="no" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Extension</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="ext" name="ext" required>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="description" name="description" rows="3" ></textarea>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-primary btn-block">Add </button>
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
