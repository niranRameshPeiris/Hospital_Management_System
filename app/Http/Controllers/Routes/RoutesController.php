<?php

namespace App\Http\Controllers\Routes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Doctors;
use  App\Beds;
use  App\Wards;
use  App\Employees;
use  App\Roles;
use  App\Patients;
use Carbon\Carbon;
use App\Ambulance;
use App\Logins;
use App\Availability;
use App\Appointment;
use App\Admit;
use App\Report;
use App\User;
use App\IPResults;
use GuzzleHttp\Client;

class RoutesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role == 1) {
            return view('reception')
            ->with('role',1)
            ->with('task','Patients Registration');
        }
        else if (auth()->user()->role == 0) {
            return view('adddoctors')
            ->with('role',0)
            ->with('task','Add Doctors');
        }
        else if (auth()->user()->role == 2) {
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }

            $wards = Wards::where('status', 1)->get();
            $beds = Beds::where('status', 1)->get();

            $admit = Admit::where('admits.status', null)
                ->join('patients', 'patients.id', '=', 'admits.patient')
                ->select('admits.*', 'patients.name')->get();

            return view('assignadmission')->with('log',$log)
            ->with('role',2)->with('admits', $admit)->with('beds', $beds)->with('wards', $wards)
            ->with('task','Assign Patients');
        }
        else if (auth()->user()->role == 4) {
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }

            return view('setavailability')
            ->with('role',4)->with('log',$log)
            ->with('task','Set Availability');
        }
        else if (auth()->user()->role == 5) {
            $patients = Patients::where('status', 1)->paginate(15);

            return view('patientprofiles')
            ->with('role',5)->with('patients',$patients)
            ->with('task','Patient Profiles');
        }
        else if (auth()->user()->role == 6) {

            return view('addambulance')
            ->with('role',6)
            ->with('task','Add Ambulance');
        }


    }


    // nurse routes
    public function AssignPatients()
    {
        if (auth()->user()->role == 2) {
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }

            $wards = Wards::where('status', 1)->get();
            $beds = Beds::where('status', 1)->get();

            $admit = Admit::where('admits.status', null)
                ->join('patients', 'patients.id', '=', 'admits.patient')
                ->select('admits.*', 'patients.name')->get();

            return view('assignadmission')->with('log',$log)
            ->with('role',2)->with('admits', $admit)->with('beds', $beds)->with('wards', $wards)
            ->with('task','Assign Patients');
        }
        else
        {
            return "error";
        }

    }

    public function ChangePatients()
    {
        if (auth()->user()->role == 2) {
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }

            $wards = Wards::where('status', 1)->get();
            $beds = Beds::where('status', 1)->get();

            $admit = Admit::where('admits.status', 1)
                ->join('patients', 'patients.id', '=', 'admits.patient')
                ->select('admits.*', 'patients.name')->get();

            return view('changepatients')->with('log',$log)
            ->with('role',2)->with('admits', $admit)->with('beds', $beds)->with('wards', $wards)
            ->with('task','Change Patients');
        }
        else
        {
            return "error";
        }

    }



    public function AddPatientReports()
    {
        if (auth()->user()->role == 2) {
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }

            $patients = Patients::where('status', 1)->get();

            return view('addpatientreports')->with('log',$log)
            ->with('role',2)->with('patients', $patients)
            ->with('task','Add Patient Reports');
        }
        else
        {
            return "error";
        }

    }

    public function RemovePatientReports()
    {
        if (auth()->user()->role == 2) {
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }

            $patients = Patients::where('status', 1)->get();

            return view('removepatientreports')->with('log',$log)
            ->with('role',2)->with('patients', $patients)
            ->with('task','Remove Patient Reports');
        }
        else
        {
            return "error";
        }

    }

    public function SearchReports(Request $request)
    {
        if (auth()->user()->role == 2) {
            $patients = Report::where('reports.status', null)->where('reports.patient', $request->id)
            ->join('patients', 'patients.id', '=', 'reports.patient')
            ->select('reports.*','patients.name as patient')
           ->get();

            return redirect('remove-patient-reports')->with(['patients'=>$patients]);
        }
        else
        {
            return "error";
        }

    }


    // reception routes
    public function ReceptionRegistration()
    {
        if (auth()->user()->role == 1) {
            return view('reception')
            ->with('role',1)
            ->with('task','Patients Registration');
        }
        else
        {
            return "error";
        }

    }
    public function DoctorsAvailability()
    {
        if (auth()->user()->role == 1) {
            $doctor = Doctors::where('status', 1)->get();

            return view('doctorsavailability')
            ->with('role',1)->with('doctors',$doctor)->with('docs',null)
            ->with('task','Doctors Availability');
        }
        else
        {
            return "error";
        }

    }

    public function AddAppointment()
    {
        if (auth()->user()->role == 1) {
            $doctor = Doctors::where('status', 1)->get();
            $patients = Patients::where('status', 1)->get();

            return view('appointment')
            ->with('role',1)->with('doctors',$doctor)->with('patients',$patients)
            ->with('task','Appointment');
        }
        else
        {
            return "error";
        }

    }

    public function AddAutoAppointment()
    {
        if (auth()->user()->role == 1) {
            $doctor = Doctors::where('status', 1)->get();
            $patients = Patients::where('status', 1)->get();

            return view('autoappointmentt')
            ->with('role',1)->with('doctors',$doctor)->with('patients',$patients)
            ->with('task','Auto Appointment');
        }
        else
        {
            return "error";
        }

    }

    public function ViewAppointment()
    {
        if (auth()->user()->role == 1) {
            $appointment = Appointment::where('appointments.status', 1)
                ->where('appointments.date','>=',date('Y-m-d'))
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor')
                ->join('patients', 'patients.id', '=', 'appointments.patient')
                ->select('appointments.id','appointments.date','appointments.disease', 'doctors.name as doctor','patients.name as patient')
                ->get();

            return view('viewappointment')
            ->with('role',1)->with('appointment',$appointment)
            ->with('task','View Appointment');
        }
        else
        {
            return "error";
        }

    }

    // admin routes
    public function AddDoctors()
    {
        if (auth()->user()->role == 0) {
            return view('adddoctors')
            ->with('role',0)
            ->with('task','Add Doctors');
        }
        else
        {
            return "error";
        }

    }

    public function AddLogins()
    {
        if (auth()->user()->role == 0) {
            return view('addlogins')
            ->with('role',0)
            ->with('task','Add Logins')
            ->with('error',false);
        }
        else
        {
            return "error";
        }

    }

    public function ViewLogins()
    {
        if (auth()->user()->role == 0) {

            $logs = Logins::where('status', null)->get();

            return view('viewlogins')
            ->with('role',0)->with('logs',$logs)
            ->with('task','View Logins');
        }
        else
        {
            return "error";
        }

    }
    public function AccountActivation()
    {
        if (auth()->user()->role == 0) {

            $users = User::all();

            return view('accountactivation')
            ->with('role',0)->with('users',$users)
            ->with('task','Account Activation');
        }
        else
        {
            return "error";
        }

    }


    public function AddEmployees()
    {
        if (auth()->user()->role == 0) {
            $roles = Roles::where('status', 1)->get();

            return view('addemployees')
            ->with('role',0)->with('roles',$roles)
            ->with('task','Add Employees');
        }
        else
        {
            return "error";
        }

    }

    public function AddWards()
    {
        if (auth()->user()->role == 0) {

            $doctor = Doctors::where('status', 1)->get();

            return view('addwards')
            ->with('role',0)->with('doctors',$doctor)
            ->with('task','Add Wards');
        }
        else
        {
            return "error";
        }

    }

    public function AddBeds()
    {
        if (auth()->user()->role == 0) {
            $wards = Wards::where('status', 1)->get();

            return view('addbeds')
            ->with('role',0)->with('wards',$wards)
            ->with('task','Add Beds');
        }
        else
        {
            return "error";
        }

    }

    public function AddRoles()
    {
        if (auth()->user()->role == 0) {
            return view('addroles')
            ->with('role',0)
            ->with('task','Add Roles');
        }
        else
        {
            return "error";
        }

    }

    public function ViewRoles()
    {
        if (auth()->user()->role == 0) {
            $roles = Roles::where('status', 1)->get();

            return view('viewroles')
            ->with('role',0)->with('roles',$roles)
            ->with('task','View Roles');
        }
        else
        {
            return "error";
        }

    }

    public function ViewDoctors()
    {
        if (auth()->user()->role == 0) {

            $doctor = Doctors::where('status', 1)->get();

            return view('viewdoctors')
            ->with('role',0)->with('doctors',$doctor)
            ->with('task','View Doctors');
        }
        else
        {
            return "error";
        }

    }
    public function ViewDoctor(Request $request)
    {
        if (auth()->user()->role == 0) {

            $doctor = Doctors::where('status', 1)->where('id', $request->id)->get();

            return view('viewdoctor')
            ->with('role',0)->with('doctors',$doctor)
            ->with('task','View Doctors');
        }
        else
        {
            return "error";
        }

    }



    public function ViewEmployees()
    {
        if (auth()->user()->role == 0) {
            $employee = Employees::where('employees.status', 1)
                        ->join('roles', 'employees.role', '=', 'roles.id')
                        ->select('employees.*', 'roles.name as role_name')
                        ->get();

            return view('viewemployees')
            ->with('role',0)->with('employees',$employee)
            ->with('task','View Employees');
        }
        else
        {
            return "error";
        }

    }
    public function ViewEmployee(Request $request)
    {
        if (auth()->user()->role == 0) {
            $employee = Employees::where('employees.status', 1)->where('employees.id', $request->id)
            ->join('roles', 'employees.role', '=', 'roles.id')
                        ->select('employees.*', 'roles.name as role_name')
                        ->get();

            return view('viewemployee')
            ->with('role',0)->with('employees',$employee)
            ->with('task','View Employees');
        }
        else
        {
            return "error";
        }

    }

    public function ViewPatients()
    {
        if (auth()->user()->role == 0) {

            return view('viewpatient')
            ->with('role',0)
            ->with('task','View Patients');
        }
        else
        {
            return "error";
        }

    }

    public function ViewWards()
    {
        if (auth()->user()->role == 0) {

            $wards = Wards::where('wards.status', 1)
                    ->join('doctors', 'wards.doctor', '=', 'doctors.id')
                    ->select('wards.*', 'doctors.name as doc_name')
                    ->get();
            return view('viewwards')
            ->with('role',0)->with('wards',$wards)
            ->with('task','View Wards');
        }
        else
        {
            return "error";
        }

    }

    public function ViewBeds()
    {
        if (auth()->user()->role == 0) {

            $beds = Beds::where('beds.status', 1)
                    ->join('wards', 'beds.ward', '=', 'wards.id')
                    ->select('beds.*', 'wards.name as ward_name')
                    ->get();

            return view('viewbeds')
            ->with('role',0)->with('beds',$beds)
            ->with('task','View Beds');
        }
        else
        {
            return "error";
        }

    }

    // director routes
    public function ViewSummery()
    {
        if (auth()->user()->role == 2) {
            return view('viewsummery')
            ->with('role',2)
            ->with('task','View Summery Report');
        }
        else
        {
            return "error";
        }

    }

    // doctor routes
    public function SetAvailability()
    {
        if (auth()->user()->role == 4) {
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }

            return view('setavailability')
            ->with('role',4)->with('log',$log)
            ->with('task','Set Availability');
        }
        else
        {
            return "error";
        }

    }
    public function ViewPatientReports()
    {
        if (auth()->user()->role == 4) {

            // $reports = Report::where('status', null)->get();
            $patients = Patients::where('status', 1)->get();

            return view('viewpatientreports')
            ->with('role',4)->with('reports',[])->with('patients',$patients)
            ->with('task','View Patient Reports');
        }
        else
        {
            return "error";
        }

    }
    public function ViewAvailability()
    {
        if (auth()->user()->role == 4) {

            $docs=null;
            $login = Logins::where('login_id', auth()->user()->identifier)->get();

            foreach($login as $log)
            {
                $docs = Availability::where('status', null)->where('doctor', $log->user_id)
                ->where('date','>=',date('Y-m-d'))->get();
                foreach($docs as $doc)
                {
                    $app = Appointment::where('status', 1)->where('doctor', $log->user_id)
                    ->where('date',$doc->date)->get();
                    $doc->status = count($app);
                }
            }
            return view('viewavailability')
            ->with('role',4)->with('docs',$docs)
            ->with('task','View Availability');
        }
        else
        {
            return "error";
        }

    }

    public function AdmitPatient()
    {
        if (auth()->user()->role == 4) {

            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }
            $patients = Patients::where('status', 1)->get();

            return view('admitpatient')
            ->with('role',4)->with('patients',$patients)->with('log',$log)
            ->with('task','Admit Patient');
        }
        else
        {
            return "error";
        }

    }

    public function AddDailyStatus()
    {
        if (auth()->user()->role == 4) {
            $docs=null;
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            $admit=null;
            foreach($login as $log)
            {
                $admit = Admit::where('admits.status', 1)
                ->join('patients', 'patients.id', '=', 'admits.patient')
                ->where('doctor', $log->user_id)
                ->select('admits.*', 'patients.name')->get();
            }


            return view('adddailystatus')
            ->with('role',4)->with('admits',$admit)
            ->with('task','Add Daily Status');
        }
        else
        {
            return "error";
        }

    }
    public function ViewPatientStatus()
    {
        if (auth()->user()->role == 4) {
            $patients = Patients::where('status', 1)->get();

            return view('viewpatientstatus')
            ->with('role',4)->with('patients',$patients)
            ->with('task','View Patient Status');
        }
        else
        {
            return "error";
        }

    }
    public function AddFinalStatus()
    {
        if (auth()->user()->role == 4) {
            $docs=null;
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            $admit=null;
            foreach($login as $log)
            {
                $admit = Admit::where('admits.status', 1)
                ->join('patients', 'patients.id', '=', 'admits.patient')
                ->where('doctor', $log->user_id)
                ->select('admits.*', 'patients.name')->get();
            }
            return view('addfinalstatus')
            ->with('role',4)->with('admits',$admit)
            ->with('task','Add Final Status');
        }
        else
        {
            return "error";
        }

    }
    public function AnalyseWounds()
    {
        if (auth()->user()->role == 4) {

            return view('analysewounds')
            ->with('role',4)
            ->with('task','Analyse Wounds');
        }
        else
        {
            return "error";
        }

    }
    public function PredictImage(Request $request)
    {
        if (auth()->user()->role == 4) {

            $client = new Client();
            $res = $client->request('POST', 'http://100.24.32.114:3000/upload', [
                'form_params' => [
                    'image' => file_get_contents($request->file('image')->path())
                ]
            ]);
            echo $res->getStatusCode();
            // "200"
            echo $res->getHeader('content-type')[0];
            // 'application/json; charset=utf8'
            echo $res->getBody();
            return 0;

            return redirect('analyse-wounds')
            ->with(['patient'=>$request->name])
            ->with(['accuracy'=>$patients])
            ->with(['result'=>$patients]);
        }
        else
        {
            return "error";
        }

    }



    // director routes
    public function PatientProfiles()
    {
        if (auth()->user()->role == 5) {
            $patients = Patients::where('status', 1)->paginate(15);

            return view('patientprofiles')
            ->with('role',5)->with('patients',$patients)
            ->with('task','Patient Profiles');
        }
        else
        {
            return "error";
        }

    }

    public function PatientProfile(Request $request)
    {
        if (auth()->user()->role == 5) {
            $patients = Patients::where('status', 1)
                        ->where('id', $request->id)->get();
            foreach($patients as $patient)
            {
                $patient->birthday = Carbon::parse($patient->birthday)->age;
            }

            $reports = Report::where('status', null)
                        ->where('patient', $request->id)->get();

            $admits = Admit::where('admits.status','!=', 0)
                        ->join('doctors', 'doctors.id', '=', 'admits.doctor')
                        ->where('patient', $request->id)
                        ->select('admits.*', 'doctors.name')->get();

            return view('patientprofile')
            ->with('role',5)->with('patient',$patients)
            ->with('reports',$reports)->with('admits',$admits)
            ->with('task','Patient Profiles');
        }
        else
        {
            return "error";
        }

    }

    public function DiabeticPredictions()
    {
        if (auth()->user()->role == 5) {
            $patients = Patients::where('status', 1)->get();

            return view('diabeticpredictions')
            ->with('role',5)->with('patients',$patients)->with('results',null)->with('prediction',null)
            ->with('task','Diabetic Predictions');
        }
        else
        {
            return "error";
        }

    }

    public function Predictions_01()
    {
        if (auth()->user()->role == 5) {
            $patients = Patients::where('status', 1)->get();

            return view('01predictions')
            ->with('role',5)->with('patients',$patients)->with('results',null)->with('prediction',null)
            ->with('task','01 Predictions');
        }
        else
        {
            return "error";
        }

    }

    public function Predictions_02()
    {
        if (auth()->user()->role == 5) {
            $patients = Patients::where('status', 1)->get();

            return view('02predictions')
            ->with('role',5)->with('patients',$patients)->with('results',null)->with('prediction',null)
            ->with('task','02 Predictions');
        }
        else
        {
            return "error";
        }

    }

    public function PredictWounds()
    {
        if (auth()->user()->role == 5) {
            $patients = IPResults::where('id','!=',0)->orderBy('id', 'desc')->paginate(15);

            return view('predictwounds')
            ->with('role',5)->with('patients',$patients)
            ->with('task','Incoming Patients');
        }
        else
        {
            return "error";
        }

    }
    public function Notification()
    {
        $patients = IPResults::where('status',1)->get();
        $count =0 ;
        foreach ($patients as $p)
        {
            $count++;
        }

        return response($count);

    }
    public function MakeSeen(Request $request)
    {
        $app = IPResults::where('id',$request->id)
                    ->update(['status' => 2]);

        return redirect('predict-wounds');

    }



    public function AddAmbulance()
    {
        if (auth()->user()->role == 6) {

            return view('addambulance')
            ->with('role',6)
            ->with('task','Add Ambulance');
        }
        else
        {
            return "error";
        }

    }

    public function ViewAmbulance()
    {
        if (auth()->user()->role == 6) {
            $ambulance = Ambulance::where('status', 1)->get();

            return view('viewambulance')
            ->with('role',6)->with('ambulances',$ambulance)
            ->with('task','View Ambulance');
        }
        else
        {
            return "error";
        }

    }


}
