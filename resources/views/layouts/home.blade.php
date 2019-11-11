@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class="row"></div>
    <div class="row">


        <div class="col-sm-2 py-4" >
            @if($role == 1)
            <div class="nav flex-column nav-pills"   aria-orientation="vertical">
                @if($task == 'Patients Registration')
                <a class="nav-link active" href="reception-registration" >Registration</a>
                @else
                <a class="nav-link" href="reception-registration" >Registration</a>
                @endif
                @if($task == 'Doctors Availability')
                <a class="nav-link active" href="doctors-availability" >Check Availability</a>
                @else
                <a class="nav-link" href="doctors-availability" >Check Availability</a>
                @endif
                @if($task == 'Appointment')
                <a class="nav-link active" href="add-appointment" >Manual Appointment</a>
                @else
                <a class="nav-link" href="add-appointment" >Manual Appointment</a>
                @endif
                @if($task == 'Auto Appointment')
                <a class="nav-link active" href="add-auto-appointment" >Auto Appointment</a>
                @else
                <a class="nav-link" href="add-auto-appointment" >Auto Appointment</a>
                @endif
                @if($task == 'View Appointment')
                <a class="nav-link active" href="view-appointment" >View Appointment</a>
                @else
                <a class="nav-link" href="view-appointment" >View Appointment</a>
                @endif
            </div>
            @endif
            @if($role == 2)
            <div class="nav flex-column nav-pills"   aria-orientation="vertical">
                @if($task == 'Assign Patients')
                <a class="nav-link active" href="assign-patients" >Assign Patients</a>
                @else
                <a class="nav-link" href="assign-patients" >Assign Patients</a>
                @endif
                @if($task == 'Change Patients')
                <a class="nav-link active" href="change-patients" >Change Patients</a>
                @else
                <a class="nav-link" href="change-patients" >Change Patients</a>
                @endif
                @if($task == 'Add Patient Reports')
                <a class="nav-link active" href="add-patient-reports" >Add Patient Reports</a>
                @else
                <a class="nav-link" href="add-patient-reports" >Add Patient Reports</a>
                @endif
                @if($task == 'Remove Patient Reports')
                <a class="nav-link active" href="remove-patient-reports" >Remove Patient Reports</a>
                @else
                <a class="nav-link" href="remove-patient-reports" >Remove Patient Reports</a>
                @endif
            </div>
            @endif
            @if($role == 0)
            <div class="nav flex-column nav-pills"   aria-orientation="vertical">
                @if($task == 'Account Activation')
                <a class="nav-link active" href="account-activation" >Account Activation</a>
                @else
                <a class="nav-link" href="account-activation" >Account Activation</a>
                @endif
                @if($task == 'View Patients')
                <a class="nav-link active" href="view-patients" >View Patients</a>
                @else
                <a class="nav-link" href="view-patients" >View Patients</a>
                @endif
                @if($task == 'Add Doctors')
                <a class="nav-link active" href="add-doctors" >Add Doctors</a>
                @else
                <a class="nav-link" href="add-doctors" >Add Doctors</a>
                @endif
                @if($task == 'View Doctors')
                <a class="nav-link active" href="view-doctors" >View Doctors</a>
                @else
                <a class="nav-link" href="view-doctors" >View Doctors</a>
                @endif
                @if($task == 'Add Employees')
                <a class="nav-link active" href="add-employees" >Add Employees</a>
                @else
                <a class="nav-link" href="add-employees" >Add Employees</a>
                @endif
                @if($task == 'View Employees')
                <a class="nav-link active" href="view-employees" >View Employees</a>
                @else
                <a class="nav-link" href="view-employees" >View Employees</a>
                @endif
                @if($task == 'Add Wards')
                <a class="nav-link active" href="add-wards" >Add Wards</a>
                @else
                <a class="nav-link" href="add-wards" >Add Wards</a>
                @endif
                @if($task == 'View Wards')
                <a class="nav-link active" href="view-wards" >View Wards</a>
                @else
                <a class="nav-link" href="view-wards" >View Wards</a>
                @endif
                @if($task == 'Add Beds')
                <a class="nav-link active" href="add-beds" >Add Beds</a>
                @else
                <a class="nav-link" href="add-beds" >Add Beds</a>
                @endif
                @if($task == 'View Beds')
                <a class="nav-link active" href="view-beds" >View Beds</a>
                @else
                <a class="nav-link" href="view-beds" >View Beds</a>
                @endif
                @if($task == 'Add Roles')
                <a class="nav-link active" href="add-roles" >Add Roles</a>
                @else
                <a class="nav-link" href="add-roles" >Add Roles</a>
                @endif
                @if($task == 'View Roles')
                <a class="nav-link active" href="view-roles" >View Roles</a>
                @else
                <a class="nav-link" href="view-roles" >View Roles</a>
                @endif
                @if($task == 'Add Logins')
                <a class="nav-link active" href="add-logins" >Add Logins</a>
                @else
                <a class="nav-link" href="add-logins" >Add Logins</a>
                @endif
                @if($task == 'View Logins')
                <a class="nav-link active" href="view-logins" >View Logins</a>
                @else
                <a class="nav-link" href="view-logins" >View Logins</a>
                @endif
            </div>
            @endif
            @if($role == 4)
            <div class="nav flex-column nav-pills"   aria-orientation="vertical">
                @if($task == 'Set Availability')
                <a class="nav-link active" href="set-availability" >Set Availability</a>
                @else
                <a class="nav-link" href="set-availability" >Set Availability</a>
                @endif
                @if($task == 'View Availability')
                <a class="nav-link active" href="view-availability" >View Availability</a>
                @else
                <a class="nav-link" href="view-availability" >View Availability</a>
                @endif
                @if($task == 'Admit Patient')
                <a class="nav-link active" href="admit-patient" >Admit Patient</a>
                @else
                <a class="nav-link" href="admit-patient" >Admit Patient</a>
                @endif
                @if($task == 'Add Daily Status')
                <a class="nav-link active" href="add-daily-status" >Add Daily Status</a>
                @else
                <a class="nav-link" href="add-daily-status" >Add Daily Status</a>
                @endif
                @if($task == 'Add Final Status')
                <a class="nav-link active" href="add-final-status" >Add Final Status</a>
                @else
                <a class="nav-link" href="add-final-status" >Add Final Status</a>
                @endif
                @if($task == 'View Patient Status')
                <a class="nav-link active" href="view-patient-status" >View Patient Status</a>
                @else
                <a class="nav-link" href="view-patient-status" >View Patient Status</a>
                @endif
                @if($task == 'View Patient Reports')
                <a class="nav-link active" href="view-patient-reports" >View Patient Reports</a>
                @else
                <a class="nav-link" href="view-patient-reports" >View Patient Reports</a>
                @endif
                @if($task == 'Analyse Wounds')
                <a class="nav-link active" href="analyse-wounds" >Analyse Woundss</a>
                @else
                <a class="nav-link" href="analyse-wounds" >Analyse Wounds</a>
                @endif

            </div>
            @endif
            @if($role == 5)
            <div class="nav flex-column nav-pills"   aria-orientation="vertical">
                @if($task == 'Patient Profiles')
                <a class="nav-link active" href="patient-profiles" >Patient Profiles</a>
                @else
                <a class="nav-link" href="patient-profiles" >Patient Profiles</a>
                @endif
                @if($task == 'Incoming Patients')
                <a class="nav-link active" href="predict-wounds" >Incoming Patients
                <span class="badge badge-danger" id="notify"></span>
                </a>
                @else
                <a class="nav-link" href="predict-wounds" >Incoming Patients
                <span class="badge badge-danger" id="notify"></span>
                </a>
                @endif
                
            </div>
            @endif
            @if($role == 6)
            <div class="nav flex-column nav-pills"   aria-orientation="vertical">
                @if($task == 'Add Ambulance')
                <a class="nav-link active" href="add-ambulance" >Add Ambulance</a>
                @else
                <a class="nav-link" href="add-ambulance" >Add Ambulance</a>
                @endif
                @if($task == 'View Ambulance')
                <a class="nav-link active" href="view-ambulance" >View Ambulance</a>
                @else
                <a class="nav-link" href="view-ambulance" >View Ambulance</a>
                @endif
            </div>
            @endif
        </div>
        <div class="col-sm-9 py-4" >
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-center">
                                <h3>{{$task}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @yield('workload')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-1">

        </div>
  </div>
</div>
<script>
$.ajax({
    url: '/getnotifications'
}).done(function(data){
    if(data == 0){
        $('#notify').html('');
    }
    else{
        $('#notify').html(data);
    }
    setTimeout(GetNotify, 5000);
});
function GetNotify()
{
    $.ajax({
        url: '/getnotifications'
    }).done(function(data){
        if(data == 0){
        $('#notify').html('');
        }
        else{
            $('#notify').html(data);
        }
    });
    setTimeout(GetNotify, 5000);
}
</script>
@endsection
