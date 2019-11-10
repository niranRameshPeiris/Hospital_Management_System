<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patients;
use Mail;

class PatientController extends Controller
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
        $pat = new Patients();

        $pat->name = $request->name;
        $pat->nic = $request->nic;
        $pat->birthday = $request->birthday;
        $pat->gender = $request->gender;
        $pat->email = $request->email;
        $pat->contact = $request->contact;
        $pat->address = $request->address;
        $pat->guardian = $request->guardian;
        $pat->guardian_email = $request->guardian_email;
        $pat->description = $request->description;
        $pat->status = 1;

        $pat->save();

        if($request->guardian_email != null && $request->guardian != null)
        {
            $to = $request->guardian_email;
            $data = array('name'=>$request->guardian,'patient'=>$request->name);
            $email_to =$request->guardian_email;

            Mail::send('mail', $data, function($message)  use ($email_to){
               $message->to($email_to, 'Guardian')->subject('Patient Registration Notification');
               $message->from('hospital.management.system.email@gmail.com','Hospital Management System');
            });
        }

        if (auth()->user()->role == 1) {
            return view('reception')
            ->with('role',1)
            ->with('task','Patients Registration');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if (auth()->user()->role == 0) {

            $patients = Patients::where('status', 1)->where('nic',$request->nic)->get();

            return redirect('view-patients')
            ->with('role',0)->with(['patients'=>$patients])
            ->with('task','View Patients');
        }
        else
        {
            return "error";
        }
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
        if (auth()->user()->role == 0)
        {
            $app = Patients::where('id',$id)
                    ->update(['status' => 0]);

                    return redirect('view-patients');
        }
        else
        {
            return 'error' ;
        }
    }
}
