<?php

namespace App\Http\Controllers\Admit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Admit;
use  App\Logins;
use  App\Patients;
use  App\Wards;
use  App\Beds;

class AdmitController extends Controller
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
        if (auth()->user()->role == 4)
        {
            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            $doc =null;
            foreach($login as $log)
            {
                $doc=$log->user_id;
            }
            if(count($login) == 1)
            {
                $log = new Admit();
                $log->patient = $request->search_patient;
                $log->doctor = $doc;
                $log->start_date = $request->date;
                $log->disease = $request->disease;
                $log->save();

                $patients = Patients::where('status', 1)->get();

            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }
                return view('admitpatient')->with('log',$log)
                ->with('role',4)->with('patients',$patients)
                ->with('task','Admit Patient');
            }
            else{
                return redirect('admit-patient');
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
        $admit = Admit::where('id', $request->patient)
        ->update(['status' => 1,'ward_id' =>$request->ward,'bed_id' =>$request->bed ]);


        return redirect('assign-patients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
