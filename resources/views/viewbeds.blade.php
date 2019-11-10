@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Bed No</th>
        <th scope="col">Bed Name</th>
        <th scope="col">Ward</th>
        <th scope="col">Description</th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($beds as $bed)
      <tr>
        <td>{{$bed->no}}</td>
        <td>{{$bed->name}} </td>
        <td>{{$bed->ward_name}}</td>
        <td>{{$bed->description}}</td>
        <td>
            <form action="/beds/{{$bed->id}}" method="POST" onsubmit="return submitForm(this);">
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
