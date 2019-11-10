<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Doctors;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ChangeStatus(Request $request)
    {
        if (auth()->user()->role == 0)
        {
            $app = User::where('id',$request->id)
                    ->update(['status' => $request->status]);

                    return redirect('account-activation');
        }
        else
        {
            return 'error' ;
        }
    }

    public function GetDoc(Request $request)
    {

            $id= " ";
            $name = " ";

            if($request->id == 1){
                $docs = Doctors::where('status',1)->where('specialty','Cardiologist')->take(1)->get();
                if(count($docs) == 0){
                }
                else{
                    foreach($docs as $doc)
                    {
                        $id = $doc->id;
                        $name = $doc->name;
                    }
                }
            }
            else if($request->id == 2){
            $docs = Doctors::where('status',1)->where('specialty','Immunologist')->take(1)->get();
                if(count($docs) == 0){
                }
                else{
                    foreach($docs as $doc)
                    {
                        $id = $doc->id;
                        $name = $doc->name;
                    }
                }
            }

        $ret = $id ."#".$name;
        return $ret;
    }
    public function ViewUser(Request $request)
    {
        if (auth()->user()->role == 0)
        {
            $user = User::where('id',$request->view_id)->get();

            return view('resetpassword')->with('user',$user)->with('role',0)->with('task','Reset Password');
        }
        else
        {
            return 'error' ;
        }
    }

    public function ResetPassword(Request $request)
    {
        if (auth()->user()->role == 0)
        {
            $app = User::where('id',$request->user_id)
                    ->update(['password' => Hash::make($request->pw) ]);

            $user = User::where('id',$request->user_id)->get();

            return view('resetpassword')->with('user',$user)->with('role',0)->with('task','Reset Password');
        }
        else
        {
            return 'error' ;
        }
    }


}
