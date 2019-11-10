<?php

namespace App\Http\Controllers\Health;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HealthStatus;
use App\Logins;
use App\Admit;
use App\Patients;

class StatusController extends Controller
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
            if($request->type == 'final')
            {
                $log = new HealthStatus();
                $log->type = $request->type;
                $log->admit_id = $request->patient_f;
                $log->date = $request->date;
                $log->health_status = $request->status;
                $log->recommendations = $request->recommendations;
                $log->description = $request->description;
                $log->save();

                $admit = Admit::where('id', $request->patient_f)
                                ->update(['status' => 3,'end_date' =>$request->date ]);

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
                $log = new HealthStatus();
                $log->type = $request->type;
                $log->admit_id = $request->patient_li;
                $log->date = $request->date;
                $log->health_status = $request->status;
                $log->recommendations = $request->recommendations;
                $log->description = $request->description;
                $log->save();

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
    public function show($id,Request $request)
    {
        if (auth()->user()->role == 4) {

            $reports = HealthStatus::where('status',null)->where('admit_id',$request->search_patient)->get();
            $patients = Patients::where('status', 1)->get();

            return redirect('view-patient-status')
            ->with('role',4)->with(['reports'=>$reports])->with('patients',$patients)
            ->with('task','View Patient Reports');
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
        //
    }
}
