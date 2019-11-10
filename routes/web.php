<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Smalot\PdfParser\Parser;

Route::get('/test', function () {

    $inputs = "niran;SLIIT;10;20";
    $process = new Process("analyse_string.py \"{$inputs}\"");
    $process->run();

    // executes after the command finishes
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    $result=$process->getOutput();


    return $result;
});

Route::get('/pdf', function () {

    $parser = new Parser();
    $pdf    = $parser->parseFile('sample.pdf');

    $text = $pdf->getText();

    echo $text;
    echo "==========";
    echo explode(" ", $text)[1];

    return 0;
    return view('pdf');

});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['reset' => false]);

Route::get('/home', 'Routes\RoutesController@index')->name('home');

//reception
Route::get('/reception-registration', 'Routes\RoutesController@ReceptionRegistration');
Route::get('/doctors-availability', 'Routes\RoutesController@DoctorsAvailability');
Route::get('/add-appointment', 'Routes\RoutesController@AddAppointment');
Route::get('/add-auto-appointment', 'Routes\RoutesController@AddAutoAppointment');
Route::get('/view-appointment', 'Routes\RoutesController@ViewAppointment');
Route::get('/getdoc', 'HomeController@GetDoc');

//admin
Route::get('/add-doctors', 'Routes\RoutesController@AddDoctors');
Route::get('/add-employees', 'Routes\RoutesController@AddEmployees');
Route::get('/add-wards', 'Routes\RoutesController@AddWards');
Route::get('/add-beds', 'Routes\RoutesController@AddBeds');
Route::get('/add-roles', 'Routes\RoutesController@AddRoles');
Route::get('/add-logins', 'Routes\RoutesController@AddLogins');
Route::get('/account-activation', 'Routes\RoutesController@AccountActivation');
Route::post('/change-status', 'HomeController@ChangeStatus');
Route::post('/view-user', 'HomeController@ViewUser');
Route::post('/reset-password', 'HomeController@ResetPassword');



Route::get('/view-doctors', 'Routes\RoutesController@ViewDoctors');
Route::post('/view-doctor', 'Routes\RoutesController@ViewDoctor');
Route::post('/update-doctor', 'Doctor\DoctorController@update');
Route::get('/view-employees', 'Routes\RoutesController@ViewEmployees');
Route::post('/view-employee', 'Routes\RoutesController@ViewEmployee');
Route::post('/update-employee', 'Employee\EmployeeController@update');
Route::get('/view-wards', 'Routes\RoutesController@ViewWards');
Route::get('/view-beds', 'Routes\RoutesController@ViewBeds');
Route::get('/view-roles', 'Routes\RoutesController@ViewRoles');
Route::get('/view-logins', 'Routes\RoutesController@ViewLogins');
Route::get('/view-patients', 'Routes\RoutesController@ViewPatients');

//reports
Route::get('/patient-profiles', 'Routes\RoutesController@PatientProfiles');
Route::post('/patient-profile', 'Routes\RoutesController@PatientProfile');
Route::get('/predict-wounds', 'Routes\RoutesController@PredictWounds');
Route::get('/getnotifications', 'Routes\RoutesController@Notification');
Route::post('/make-seen', 'Routes\RoutesController@MakeSeen');
Route::get('/diabetic-predictions', 'Routes\RoutesController@DiabeticPredictions');
Route::get('/01-predictions', 'Routes\RoutesController@Predictions_01');
Route::get('/02-predictions', 'Routes\RoutesController@Predictions_02');


//doctors
Route::get('/set-availability', 'Routes\RoutesController@SetAvailability');
Route::get('/view-availability', 'Routes\RoutesController@ViewAvailability');
Route::get('/admit-patient', 'Routes\RoutesController@AdmitPatient');
Route::get('/add-daily-status', 'Routes\RoutesController@AddDailyStatus');
Route::get('/add-final-status', 'Routes\RoutesController@AddFinalStatus');
Route::get('/view-patient-reports', 'Routes\RoutesController@ViewPatientReports');
Route::get('/view-patient-status', 'Routes\RoutesController@ViewPatientStatus');
Route::get('/analyse-wounds', 'Routes\RoutesController@AnalyseWounds');
Route::post('/predict-image', 'Routes\RoutesController@PredictImage');


//nurse
Route::get('/assign-patients', 'Routes\RoutesController@AssignPatients');
Route::get('/change-patients', 'Routes\RoutesController@ChangePatients');
Route::get('/add-patient-reports', 'Routes\RoutesController@AddPatientReports');
Route::get('/remove-patient-reports', 'Routes\RoutesController@RemovePatientReports');
Route::get('/search-reports', 'Routes\RoutesController@SearchReports');


//ambulance
Route::get('/add-ambulance', 'Routes\RoutesController@AddAmbulance');


//predictions
Route::post('/predict', 'Patient\PredictionController@Predict');

// resource controllers
Route::resource('ambulance', 'Ambulance\AmbulanceController')->only([
    'store'
]);
Route::resource('doctors', 'Doctor\DoctorController')->only([
    'store','destroy'
]);
Route::resource('employees', 'Employee\EmployeeController')->only([
    'store','destroy'
]);
Route::resource('wards', 'Ward\WardController')->only([
    'store','destroy'
]);
Route::resource('beds', 'Bed\BedController')->only([
    'store','destroy'
]);
Route::resource('roles', 'Role\RoleController')->only([
    'store','destroy'
]);
Route::resource('patients', 'Patient\PatientController')->only([
    'store','destroy','show'
]);
Route::resource('logins', 'Logins\LoginsController')->only([
    'store','destroy'
]);
Route::resource('availability', 'Availability\AvailabilityController')->only([
    'store','show','destroy'
]);
Route::resource('appointment', 'Appointment\AppointmentController')->only([
    'store','destroy'
]);
Route::resource('admit', 'Admit\AdmitController')->only([
    'store','update'
]);
Route::resource('status', 'Health\StatusController')->only([
    'store','show'
]);
Route::resource('report', 'Health\ReportController')->only([
    'store','show','destroy'
]);
