<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employees;
use App\Roles;

class EmployeeController extends Controller
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
        $emp = new Employees();
        $emp->name = $request->name;
        $emp->employed_date = $request->emp_date;
        $emp->nic = $request->nic;
        $emp->role = $request->role;
        $emp->age = $request->age;
        $emp->gender = $request->gender;
        $emp->email = $request->email;
        $emp->mobile = $request->mobile;
        $emp->landline = $request->landline;
        $emp->address = $request->address;
        $emp->description = $request->description;
        $emp->status = 1;

        $emp->save();

        $roles = Roles::where('status', 1)->get();

            return view('addemployees')
            ->with('role',0)->with('roles',$roles)
            ->with('task','Add Employees');
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
    public function update(Request $request)
    {
        if (auth()->user()->role == 0) {

            $doc = Employees::where('id',$request->id)
                    ->update([$request->name => $request->change]);

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
            $app = Employees::where('id',$id)
                    ->update(['status' => 0]);

                    return redirect('view-employees');
        }
        else
        {
            return 'error' ;
        }
    }
}
