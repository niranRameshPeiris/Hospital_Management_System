@extends('layouts.home')

@section('workload')
<form action="/logins" method="POST">
@csrf


  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Login ID (Username)</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="login_id" name="login_id" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">User Type</label>
    <div class="col-sm-4">
        <select class="form-control" id="type" name="type" required>
            <option value="">...</option>
            <option value="doc">Doctor</option>
            <option value="emp">Employee</option>
        </select>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">User ID</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="user_id" name="user_id" required>
    </div>
  </div>
@if($error == true)
  <div class="form-group row">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oh snap!</strong> Invalid parameters, try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
  </div>
@endif
  <div class="form-group row">
    <div class="col-sm-1"></div>
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-block">Add</button>
    </div>
    <div class="col-sm-2">
        <button type="reset" class="btn btn-primary btn-block">Reset</button>
    </div>
    <div class="col-sm-1"></div>
  </div>

</form>
@endsection
