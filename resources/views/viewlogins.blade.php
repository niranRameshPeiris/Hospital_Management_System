@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Login ID (Username)</th>
        <th scope="col">User Type</th>
        <th scope="col">User ID</th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($logs as $log)
      <tr>
        <td>{{$log->login_id}}</td>
        <td>{{$log->type}} </td>
        <td>{{$log->user_id}}</td>
        <td>
            <form action="/logins/{{$log->id}}" method="POST" onsubmit="return submitForm(this);">
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
