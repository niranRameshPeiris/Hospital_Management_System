<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IPResults;
use Mail;

class EmailController extends Controller
{
    public function handel(Request $request)
    {
        

        $result = new IPResults();
        $result->patient = $request->patient;
        $result->image = $request->image;
        $result->date = $request->date;
        $result->accuracy = $request->accuracy;
        $result->result = $request->result;
        $result->status = 1;

        $result->save();

        if($request->email != null)
        {
            $to = $request->email;
            $data = array('image'=>$name,'patient'=>$request->patient,'result'=>$request->result);
            $email_to =$request->email;

            Mail::send('mailshare', $data, function($message)  use ($email_to){
                $message->to($email_to, 'Doctor')->subject('Emergency Arrival Notification');
                $message->from('hospital.management.system.email@gmail.com','Hospital Management System');
            });
        }

        return ['message' => 'done'];
    }
}
