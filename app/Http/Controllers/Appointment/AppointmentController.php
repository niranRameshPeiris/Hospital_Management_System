<?php

namespace App\Http\Controllers\Appointment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Appointment;
use  App\Patients;
use  App\Doctors;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == 1)
        {
            $log = new Appointment();
            $log->patient = $request->search_patient;
            $log->doctor = $request->search_doc;
            $log->date = $request->date;
            $log->disease = $request->disease;
            $log->status = 1;
            $log->save();

            $doctor = Doctors::where('status', 1)->get();
            $patients = Patients::where('status', 1)->get();

            if($log->add_meth == 1){
                return view('appointment')
                ->with('role',1)->with('doctors',$doctor)->with('patients',$patients)
                ->with('task','Appointment');
            }
            else{
                return view('autoappointmentt')
                ->with('role',1)->with('doctors',$doctor)->with('patients',$patients)
                ->with('task','Auto Appointment');
            }
        }
        else
        {
            return 'error' ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role == 1)
        {
            $app = Appointment::where('id',$id)
                    ->update(['status' => 0]);

                    return redirect('view-appointment');
        }
        else
        {
            return 'error' ;
        }
    }
}
