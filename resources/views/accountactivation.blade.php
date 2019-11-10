@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Username</th>
        <th scope="col">Name</th>
        <th scope="col">Role</th>
        <th></th><th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($users as $user)
      <tr>
        <td>{{$user->identifier}}</td>
        <td>{{$user->name}} </td>
        <td>{{$user->role}}</td>
        <td>
            <form action="/change-status" method="POST" onsubmit="return submitForm(this);">
                @csrf
                <input type="hidden" value="{{$user->id}}" id="id" name="id" required>
                @if($user->status== 1)
                <input type="hidden" value="0" id="status" name="status" required>
                <button type="submit" class="btn btn-danger  btn-block">Deactivate</button>
                @else
                <input type="hidden" value="1" id="status" name="status" required>
                <button type="submit" class="btn btn-success btn-block">Activate</button>
                @endif
            </form>
        </td>
        <td>
            <form action="/view-user" method="POST" >
                @csrf
                <input type="hidden" value="{{$user->id}}" id="view_id" name="view_id" required>
                <button type="submit" class="btn btn-success btn-block">Reset Password</button>
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
    return confirm('Do you want activate/deactivate this account ??');
}
</script>
@endsection
