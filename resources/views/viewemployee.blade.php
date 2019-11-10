@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <tbody>
    @foreach($employees as $emp)
      <tr>
        <td>Name</td>
        <td>{{$emp->name}} </td>
      </tr>
      <tr>
        <td>NIC</td>
        <td>{{$emp->nic}} </td>
      </tr>
      <tr>
        <td>Role</td>
        <td>{{$emp->role_name}} </td>
      </tr>
      <tr>
        <td>Age</td>
        <td>{{$emp->age}} </td>
      </tr>
      <tr>
        <td>Email</td>
        <td>
            <form action="update-employee" method="POST" onsubmit="return submitForm(this);">
                @csrf
                <div class="form-group row">
                    <input  type="hidden" value="{{$emp->id}}" id="id" name="id" required>
                    <input  type="hidden" value="email" id="name" name="name" required>
                    <input class="col-sm-6 form-control" type="email" value="{{$emp->email}}" id="change" name="change" required>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary btn-block">Change</button>
                </div>
                </div>
            </form>
        </td>
      </tr>
      <tr>
        <td>Mobile</td>
        <td>
        <form action="update-employee" method="POST" onsubmit="return submitForm(this);">
                @csrf
                <div class="form-group row">
                    <input  type="hidden" value="{{$emp->id}}" id="id" name="id" required>
                    <input  type="hidden" value="mobile" id="name" name="name" required>
                    <input pattern="[0-9]{10}"  class="col-sm-6 form-control" type="text" value="{{$emp->mobile}}" id="change" name="change" required>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary btn-block">Change</button>
                </div>
                </div>
            </form>
        </td>
      </tr>
      <tr>
        <td>Landline</td>
        <td>
        <form action="update-employee" method="POST" onsubmit="return submitForm(this);">
                @csrf
                <div class="form-group row">
                    <input  type="hidden" value="{{$emp->id}}" id="id" name="id" required>
                    <input  type="hidden" value="landline" id="name" name="name" required>
                    <input pattern="[0-9]{10}"  class="col-sm-6 form-control" type="text" value="{{$emp->landline}}" id="change" name="change" required>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary btn-block">Change</button>
                </div>
                </div>
            </form>
        </td>
      </tr>
      <tr>
        <td>Address</td>
        <td>
        <form action="update-employee" method="POST" onsubmit="return submitForm(this);">
                @csrf
                <div class="form-group row">
                    <input  type="hidden" value="{{$emp->id}}" id="id" name="id" required>
                    <input  type="hidden" value="address" id="name" name="name" required>
                    <textarea class="form-control" id="change" name="change" rows="3" required>{{$emp->address}}</textarea>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary btn-block">Change</button>
                </div>
                </div>
            </form>
        </td>
      </tr>
      <tr>
        <td>Description</td>
        <td>
        <form action="update-employee" method="POST" onsubmit="return submitForm(this);">
                @csrf
                <div class="form-group row">
                    <input  type="hidden" value="{{$emp->id}}" id="id" name="id" required>
                    <input  type="hidden" value="description" id="name" name="name" required>
                    <textarea class="form-control" id="change" name="change" rows="3" required>{{$emp->description}}</textarea>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary btn-block">Change</button>
                </div>
                </div>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
    </div>
</div>
<script>
function submitForm()
{
    return confirm('Do you want update this record ??');
}
</script>
</script>
@endsection
