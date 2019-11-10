<?php

namespace App\Http\Controllers\Bed;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wards;
use App\Beds;

class BedController extends Controller
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
        $bed = new Beds();
        $bed->name = $request->name;
        $bed->no = $request->no;
        $bed->ward = $request->search_name;
        $bed->description = $request->description;
        $bed->status = 1;

        $bed->save();

        $wards = Wards::where('status', 1)->get();

            return view('addbeds')
            ->with('role',0)->with('wards',$wards)
            ->with('task','Add Beds');
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
            $app = Beds::where('id',$id)
                    ->update(['status' => 0]);

                    return redirect('view-beds');
        }
        else
        {
            return 'error' ;
        }
    }
}
