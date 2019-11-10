<?php

namespace App\Http\Controllers\Availability;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Availability;
use App\Logins;
use App\Doctors;
use App\Appointment;

class AvailabilityController extends Controller
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
                $log = new Availability();
                $log->doctor = $doc;
                $log->date = $request->date;
                $log->start = $request->start;
                $log->end = $request->end;
                $log->limit = $request->limit;
                $log->save();


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
                return redirect('set-availability');
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
        $docs = Availability::where('status', null)->where('doctor', $request->doctor)
                ->where('date', $request->date)->get();
        foreach($docs as $doc)
        {
            $app = Appointment::where('status', 1)->where('doctor', $doc->doctor)
            ->where('date',$doc->date)->get();
            $doc->status = count($app);
        }

        $doctor = Doctors::where('status', 1)->get();

        return redirect('doctors-availability')
        ->with('role',1)->with('doctors',$doctor)->with(['docs'=>$docs])
        ->with('task','Doctors Availability');
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
        if (auth()->user()->role == 4)
        {
            $app = Availability::where('id',$id)
                    ->update(['status' => 0]);

                    return redirect('view-availability');
        }
        else
        {
            return 'error' ;
        }
    }
}
