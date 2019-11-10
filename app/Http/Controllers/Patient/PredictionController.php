<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Patients;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class PredictionController extends Controller
{
    public function Predict(Request $request)
    {
        if (auth()->user()->role == 5) {

            if($request->type == '00'){
                $patients = Patients::where('status', 1)->get();
                $results = Patients::where('status', 1)->where('id', $request->search_patient)->get();

                $inputs = $request->val01.";".$request->val02;
                $process = new Process("analyse_string.py \"{$inputs}\"");
                $process->run();

                // executes after the command finishes
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                $result=$process->getOutput();

                return view('diabeticpredictions')
                ->with('role',5)->with('patients',$patients)->with('results',$results)->with('prediction', $result)
                ->with('task','Diabetic Predictions');
            }
            elseif($request->type == '01'){
                $patients = Patients::where('status', 1)->get();
                $results = Patients::where('status', 1)->where('id', $request->search_patient)->get();

                $inputs = $request->val01.";".$request->val02;
                $process = new Process("analyse_string.py \"{$inputs}\"");
                $process->run();

                // executes after the command finishes
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                $result=$process->getOutput();

                return view('01predictions')
                ->with('role',5)->with('patients',$patients)->with('results',$results)->with('prediction', $result)
                ->with('task','01 Predictions');
            }
            elseif($request->type == '02'){
                $patients = Patients::where('status', 1)->get();
                $results = Patients::where('status', 1)->where('id', $request->search_patient)->get();

                $inputs = $request->val01.";".$request->val02;
                $process = new Process("analyse_string.py \"{$inputs}\"");
                $process->run();

                // executes after the command finishes
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                $result=$process->getOutput();

                return view('02predictions')
                ->with('role',5)->with('patients',$patients)->with('results',$results)->with('prediction', $result)
                ->with('task','02 Predictions');
            }

        }
        else
        {
            return "error";
        }
    }
}
