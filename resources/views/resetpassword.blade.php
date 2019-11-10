@extends('layouts.home')

@section('workload')
<form action="/reset-password" method="POST" onsubmit="return submitForm(this);">
@csrf
    @foreach($user as $u)
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">User ID : </label>
    <div class="col-sm-8">
    <label  class="col-sm-2 col-form-label">{{$u->id}}</label>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">User Name : </label>
    <div class="col-sm-8">
    <label  class="col-sm-2 col-form-label">{{$u->name}}</label>
    </div>
  </div>
  <input type="hidden" value="{{$u->id}}"  id="user_id" name="user_id"  >
  @endforeach


  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="pw" name="pw"  >
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-primary btn-block">Set</button>
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
