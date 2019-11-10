@extends('layouts.home')

@section('workload')
<form action="/employees" method="POST" onsubmit="return submitForm(this);">
@csrf
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Employed Date</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="emp_date" name="emp_date"  required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">NIC</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="nic" name="nic"  required>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Role</label>
    <div class="col-sm-4">
        <select class="form-control" id="role" name="role" required>
            <option value="">...</option>
            @foreach($roles as $ro)
                <option value="{{$ro->id}}">{{$ro->name}}</option>
            @endforeach
        </select>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Age</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="age" name="age"  required>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Gender</label>
    <div class="col-sm-4">
        <select class="form-control" id="gender" name="gender" required>
            <option value="">...</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control" id="email" name="email"  required>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Mobile</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}" required>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Landline</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="landline" name="landline" pattern="[0-9]{10}" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
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
        <button type="submit" class="btn btn-primary btn-block">Add</button>
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
