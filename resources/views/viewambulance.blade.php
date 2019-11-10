@extends('layouts.home')

@section('workload')
<div class="row justify-content-center">
    <div class="col-sm-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">License Plate No</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    @foreach($ambulances as $ambulance)
      <tr>
        <td>{{$ambulance->license_plate_no}}</td>
        <td>{{$ambulance->name}} </td>
        <td>{{$ambulance->description}}</td>
        <td><button type="submit" class="btn btn-primary btn-block">Delete</button></td>
      </tr>
    @endforeach

    </tbody>
  </table>
    </div>
</div>
@endsection
