@extends('layouts.home')
@section('workload')
<form method="GET" action="/search-reports">
  <div class="form-group row justify-content-center">

            <label  class="col-sm-2 col-form-label">Patient</label>
            <div class="col-sm-4 ">
        <input list="patients" class="form-control" name="id" id="id" required>
        <datalist id="patients">
            @foreach($patients as $patient)
                <option value="{{$patient->id}}">{{$patient->name}}</option>
            @endforeach
        </datalist>
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
                        <th scope="col">Patient</th>
                        <th scope="col">Report Title</th>
                        <th scope="col">Report Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(Session::get('patients') != null)
                    @foreach(Session::get('patients') as $patient)
                    <tr>
                        <td>{{$patient->patient}}</td>
                        <td>{{$patient->title}}</td>
                        <td>{{$patient->report_status}}</td>
                        <td>
                            <form action="/report/{{$patient->id}}" method="POST" onsubmit="return submitForm(this);">
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
