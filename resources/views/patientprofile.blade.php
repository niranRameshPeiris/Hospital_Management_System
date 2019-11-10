@extends('layouts.home')
@section('workload')
@foreach($patient as $patient)
<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="card">
            <h5 class="card-header text-center">Personal Information</h5>
            <div class="card-body">
            <div class="row py-2">
                <div class="col-sm-5">
                        <b>Patient Name</b>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <i>{{$patient->name}}</i>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-sm-5">
                        <b>NIC</b>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <i>{{$patient->nic}}</i>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-sm-5">
                        <b>Age</b>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <i>{{$patient->birthday}}</i>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-sm-5">
                        <b>Gender</b>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <i>{{$patient->gender}}</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <h5 class="card-header text-center">Contact Information</h5>
            <div class="card-body">
            <div class="row py-2">
                <div class="col-sm-5">
                        <b>Contact No</b>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <i>{{$patient->contact}}</i>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-sm-5">
                        <b>Email Address</b>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <i>{{$patient->email}}</i>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-sm-5">
                        <b>Address</b>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <i>{{$patient->address}}</i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12  py-4">
        <div class="card">
            <h5 class="card-header text-center">Report Summery</h5>
            <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Title</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Threshold</th>
                        <th scope="col">Results</th>
                        <th scope="col">Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                    <tr>
                        <td>{{$report->date}}</td>
                        <td>{{$report->title}}</td>
                        <td>{{$report->reason}}</td>
                        <td>{{$report->normal_health_status}} {{$report->health_status_type}}</td>
                        <td>{{$report->health_status}} {{$report->health_status_type}}</td>
                        <td>
                        @if($report->report_status == 'positive')
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                        @elseif($report->report_status == 'negative')
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                        @else
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                        @endif
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>


            </div>
        </div>
    </div>

    <div class="col-sm-12  py-4">
        <div class="card">
            <h5 class="card-header text-center">Visit Summery</h5>
            <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Disease</th>
                        <th scope="col">Doctors</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($admits as $admit)
                    <tr>
                        <td>{{$admit->start_date}}</td>
                        <td>{{$admit->end_date}}</td>
                        <td>{{$admit->disease}}</td>
                        <td>{{$admit->name}} </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                </div>
            </div>


            </div>
        </div>
    </div>

</div>
@endforeach
@endsection
