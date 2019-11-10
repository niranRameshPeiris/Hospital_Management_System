@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Patient</th>
        <th scope="col">Disease</th>
        <th scope="col">Doctor</th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($appointment as $app)
      <tr>
        <td>{{$app->date}}</td>
        <td>{{$app->patient}} </td>
        <td>{{$app->disease}}</td>
        <td>{{$app->doctor}}</td>
        <td>
            <form action="/appointment/{{$app->id}}" method="POST" onsubmit="return submitForm(this);">
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
