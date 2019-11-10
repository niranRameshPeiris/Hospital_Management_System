@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">User ID</th>
        <th scope="col">Name</th>
        <th scope="col">Role</th>
        <th scope="col">Gender</th>
        <th scope="col">Age</th>
        <th scope="col">Mobile</th>
        <th scope="col">Landline</th>
        <th></th><th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($employees as $emp)
      <tr>
      <td>{{$emp->id}}</td>
        <td>{{$emp->name}}</td>
        <td>{{$emp->role_name}} </td>
        <td>{{$emp->gender}}</td>
        <td>{{$emp->age}}</td>
        <td>{{$emp->mobile}}</td>
        <td>{{$emp->landline}}</td>
        <td>
            <form action="view-employee" method="POST" >
                @csrf
                <input type="hidden" value="{{$emp->id}}" id="id" name="id">
                <button type="submit" class="btn btn-primary btn-block">More</button>
            </form>
        </td>
        <td>
            <form action="/employees/{{$emp->id}}" method="POST" onsubmit="return submitForm(this);">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-primary btn-block">Delete</button>
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
    return confirm('Do you want delete this record ??');
}
</script>
@endsection
