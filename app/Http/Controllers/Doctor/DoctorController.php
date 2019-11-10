<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Doctors;

class DoctorController extends Controller
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
        $doc = new Doctors();
        $doc->name = $request->name;
        $doc->employed_date = $request->emp_date;
        $doc->registration_date = $request->reg_date;
        $doc->registration_no = $request->reg_no;
        $doc->nic = $request->nic;
        $doc->specialty = $request->specialty;
        $doc->age = $request->age;
        $doc->gender = $request->gender;
        $doc->email = $request->email;
        $doc->mobile = $request->mobile;
        $doc->landline = $request->landline;
        $doc->address = $request->address;
        $doc->description = $request->description;
        $doc->status = 1;

        $doc->save();

        return view('adddoctors')
            ->with('role',0)
            ->with('task','Add Doctors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function update(Request $request)
    {
        if (auth()->user()->role == 0) {

            $doc = Doctors::where('id',$request->id)
                    ->update([$request->name => $request->change]);

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
            $app = Doctors::where('id',$id)
                    ->update(['status' => 0]);

                    return redirect('view-doctors');
        }
        else
        {
            return 'error' ;
        }
    }
}
