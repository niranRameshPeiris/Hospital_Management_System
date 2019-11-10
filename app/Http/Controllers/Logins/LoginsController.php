<?php

namespace App\Http\Controllers\Logins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logins;
use  App\Doctors;
use  App\User;
use  App\Employees;

class LoginsController extends Controller
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
        if (auth()->user()->role == 0) {
            $user=null;
            $login=null;
            $exist=null;
            $role=null;
            //checking
            if($request->type == 'doc')
            {
                $user = Doctors::where('status', 1)->where('id', $request->user_id)->get();
                $login = User::where('status', 1)->where('identifier', $request->login_id)->get();
                $exist = Logins::where('user_id', $request->user_id)->where('type', $request->type)->get();
                $role = Logins::where('login_id', $request->login_id)->get();
            }
            else if($request->type == 'emp')
            {
                $user = Employees::where('status', 1)->where('id', $request->user_id)->get();
                $login = User::where('status', 1)->where('identifier', $request->login_id)->get();
                $exist = Logins::where('user_id', $request->user_id)->where('type', $request->type)->get();
                $role = Logins::where('login_id', $request->login_id)->get();
            }
            //adding
            if(count($user) == 1 && count($login) == 1 && count($exist) == 0 && count($role) == 0  )
            {
                $log = new Logins();
                $log->user_id = $request->user_id;
                $log->login_id = $request->login_id;
                $log->type = $request->type;
                $log->save();

                return view('addlogins')
                ->with('role',0)
                ->with('task','Add Logins')
                ->with('error',false);
            }
            else
            {
                return view('addlogins')
                ->with('role',0)
                ->with('task','Add Logins')
                ->with('error',true);
            }
        }
        else
        {
            return "error";
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
        if (auth()->user()->role == 0)
        {
            $app = Logins::where('id', $id)->delete();

            return redirect('view-logins');
        }
        else
        {
            return 'error' ;
        }
    }
}
