@extends('layouts.home')
@section('workload')
<form method="GET" action="/patients/{0}">
  <div class="form-group row justify-content-center">

            <label  class="col-sm-2 col-form-label">NIC</label>
            <div class="col-sm-4">
            <input type="text" class="form-control" id="nic" name="nic"  required>
            </div>

    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-block">Check</button>
    </div>
  </div>
</form>

<br>
<div class="row justify-content-center">

    <div class="col-sm-12  py-4">

            <div class="row justify-content-center">
                <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">NIC</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(Session::get('patients') != null)
                    @foreach(Session::get('patients') as $patient)
                    <tr>
                        <td>{{$patient->nic}}</td>
                        <td>{{$patient->name}}</td>
                        <td>{{$patient->email}}</td>
                        <td>{{$patient->contact}}</td>
                        <td>
                            <form action="/patients/{{$patient->id}}" method="POST" onsubmit="return submitForm(this);">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
                </div>
            </div>

    </div>

</div>
<script>
function submitForm()
{
    return confirm('Do you want delete this record ??');
}
</script>
@endsection
