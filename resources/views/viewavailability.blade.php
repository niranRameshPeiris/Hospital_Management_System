@extends('layouts.home')

@section('workload')

<div class="row justify-content-center">
    <div class="col-sm-10">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Limit</th>
        <th scope="col">Appointments</th>
        <th scope="col">Availability</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
    @if($docs != null)
    @foreach($docs as $doc)
      <tr>
        <td>{{$doc->date}}</td>
        <td>{{$doc->start}} - {{$doc->end}}</td>
        <td>{{$doc->limit}}</td>
        <td>{{$doc->status}}</td>
        <td>Available</td>
        <td>
            <form action="/availability/{{$doc->id}}" method="POST" onsubmit="return submitForm(this);">
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
<script>
function submitForm()
{
    return confirm('Do you want delete this record ??');
}
</script>
@endsection
