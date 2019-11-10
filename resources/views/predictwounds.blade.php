@extends('layouts.home')
@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Patient</th>
        <th scope="col">Image</th>
        <th scope="col">Date</th>
        <th scope="col">Accuracy</th>
        <th scope="col">Result</th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($patients as $patient)
      <tr>
        <td>{{$patient->patient}}</td>
        <td>
        <img src="ipresults/{{$patient->image}}"  height="100" width="100">
        </td>
        <td>{{$patient->date}} </td>
        <td>{{$patient->accuracy}}</td>
        <td>{{$patient->result}}</td>
        <td>
            @if($patient->status == 1)
            <form action="/make-seen" method="POST" id="submitform">
                @csrf
                <input type="hidden"  id="id" name="id" >
                <button type="button" onclick="MakeSeen({{$patient->id}})" class="btn btn-primary btn-block">Seen</button>
            </form>
            @else
            Seen
            @endif
        </td>
      </tr>
    @endforeach
    {{ $patients->links() }}
    </tbody>
  </table>
    </div>
</div>
<script>
function MakeSeen(id)
{
    document.getElementById("id").value=id;
    document.getElementById("submitform").submit();
}
</script>
@endsection
