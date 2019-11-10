@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Ward No</th>
        <th scope="col">Ward Name</th>
        <th scope="col">Doctor</th>
        <th scope="col">Extension</th>
        <th scope="col">Description</th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($wards as $ward)
      <tr>
        <td>{{$ward->no}}</td>
        <td>{{$ward->name}} </td>
        <td>{{$ward->doc_name}}</td>
        <td>{{$ward->extension}}</td>
        <td>{{$ward->description}}</td>
        <td>
            <form action="/wards/{{$ward->id}}" method="POST" onsubmit="return submitForm(this);">
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
