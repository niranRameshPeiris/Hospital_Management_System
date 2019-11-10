@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Role Name</th>
        <th scope="col">Description</th>
        <th></th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($roles as $ro)
      <tr>
        <td>{{$ro->name}}</td>
        <td>{{$ro->description}}</td>
        <td>{{$ro->status}}</td>
        <td>
            <form action="/roles/{{$ro->id}}" method="POST" onsubmit="return submitForm(this);">
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
