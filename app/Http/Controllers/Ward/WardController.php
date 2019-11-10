<?php

namespace App\Http\Controllers\Ward;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wards;
use App\Doctors;

class WardController extends Controller
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
        $ward = new Wards();
        $ward->name = $request->name;
        $ward->no = $request->no;
        $ward->doctor = $request->search_name;
        $ward->extension = $request->ext;
        $ward->description = $request->description;
        $ward->status = 1;

        $ward->save();

        $doctor = Doctors::where('status', 1)->get();

            return view('addwards')
            ->with('role',0)->with('doctors',$doctor)
            ->with('task','Add Wards');
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
        if (auth()->user()->role == 0)
        {
            $app = Wards::where('id',$id)
                    ->update(['status' => 0]);

                    return redirect('view-wards');
        }
        else
        {
            return 'error' ;
        }
    }
}
