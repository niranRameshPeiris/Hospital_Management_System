@extends('layouts.home')
@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">NIC</th>
        <th scope="col">Gender</th>
        <th scope="col">Contact</th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($patients as $patient)
      <tr>
        <td>{{$patient->name}}</td>
        <td>{{$patient->nic}} </td>
        <td>{{$patient->gender}}</td>
        <td>{{$patient->contact}}</td>
        <td>
            <form action="/patient-profile" method="POST" id="submitform">
                @csrf
                <input type="hidden"  id="id" name="id" >
                <button type="button" onclick="ViewProfile({{$patient->id}})" class="btn btn-primary btn-block">View Profile</button>
            </form>
        </td>
      </tr>
    @endforeach
    {{ $patients->links() }}
    </tbody>
  </table>
    </div>
</div>
<script>
function ViewProfile(id)
{
    document.getElementById("id").value=id;
    document.getElementById("submitform").submit();
}
</script>
@endsection
