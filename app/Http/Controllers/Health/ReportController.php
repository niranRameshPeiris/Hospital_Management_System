<?php

namespace App\Http\Controllers\Health;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logins;
use App\Report;
use App\Patients;
use Mail;
use Smalot\PdfParser\Parser;
class ReportController extends Controller
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
        if (auth()->user()->role == 2)
        {
            // $filename=null;

            // if ($request->hasFile('file'))
            // {

            //     $this->validate($request, [

            //         'file' => 'required|mimes:pdf|max:10000',
            //     ]);

            //     $pdf = $request->file('file');
            //     $filename = 'Report-'.$request->report_id.'-'.$request->title.'-'.now()->timestamp.'.pdf';
            //     $destinationPath = public_path('/reports');
            //     $pdf->move($destinationPath, $filename);
            // }

            $login = Logins::where('login_id', auth()->user()->identifier)->get();
            $nurse =null;
            foreach($login as $log)
            {
                $nurse=$log->user_id;
            }

            // from pdf -> title, date, value, thresh, mType, description
            // from algo -> status

            //read pdf
            $this->validate($request, [

                'pdf' => 'required|mimes:pdf|max:5120',
            ]);

            $parser = new Parser();
            $pdf    = $parser->parseFile($request->pdf);
            $text = explode("\n", $pdf->getText());


            if( count($text) > 16 )
            {
                $pdfTitle =$text[14];
                $pdfDate =explode(':',$text[6])[1];
                $pdfDate = (int)explode('-',$pdfDate )[0].'-'.(int)explode('-',$pdfDate )[1].'-'.(int)explode('-',$pdfDate )[2];
                $pdfValue = explode(' ',$text[16])[1];
                $pdfThreshold =explode(' ',$text[16])[3];
                $pdfUnit =explode(' ',$text[16])[2];
                $pdfDescription =$text[12];

                // select status
                $reportStatus = null;
                $stripped = trim(preg_replace('/\s+/', ' ', $pdfTitle));
                if( strcmp($stripped, "PRE PRANDIAL BLOOD GLUCOSE") == 0){
                    if( (float)$pdfValue <= 140 &&  (float)$pdfValue >= 70  ){
                        $reportStatus="positive";
                    }
                    else{
                        $reportStatus="negative";
                    }
                }
                elseif( strcmp($stripped, "POST PRANDIAL BLOOD GLUCOSE") == 0){
                    if( (float)$pdfValue <= 140 &&  (float)$pdfValue >= 70  ){
                        $reportStatus="positive";
                    }
                    else{
                        $reportStatus="negative";
                    }
                }
                elseif(strcmp($stripped, "SYSTOLIC/DIASTOLIC BLOOD PRESSURE") == 0){
                    $vals = explode('/',$pdfValue);
                    if( (float)$vals[0] > 120  ){
                        $reportStatus="negative";
                    }
                    elseif( (float)$vals[1] > 80  ){
                        $reportStatus="negative";
                    }
                    else{
                        $reportStatus="positive";
                    }
                }
                else{
                    $reportStatus="neutral";
                }

                $log = new Report();
                $log->patient = $request->report_id;
                $log->title = $pdfTitle;
                $log->date = $pdfDate;
                $log->reason = $request->reason;
                $log->health_status_type = $pdfUnit;
                $log->health_status = $pdfValue;
                $log->normal_health_status = $pdfThreshold;

                $log->report_status = $reportStatus;

                $log->description = $pdfDescription;
                $log->reference_id = $request->location;
                //$log->path = $filename;
                $log->emp_id = $nurse;
                $log->save();

                if($request->doc_email != null)
                {
                    $data = array('name'=>$pdfTitle,'status'=>$reportStatus);
                    $email_to =$request->doc_email;

                    Mail::send('mailreport', $data, function($message)  use ($email_to){
                       $message->to($email_to, 'Doctor')->subject('Patient Report Upload Notification');
                       $message->from('hospital.management.system.email@gmail.com','Hospital Management System');
                    });
                }
            }


            $patients = Patients::where('status', 1)->get();
            if(count($login) == 0 )
            {
                $log =null;
            }
            else
            {
                $log = auth()->user()->identifier;
            }
            return view('addpatientreports')->with('log',$log)
            ->with('role',2)->with('patients', $patients)
            ->with('task','Add Patient Reports');

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

            if($request->date == null)
            {
                $reports = Report::where('status', null)->where('patient',$request->search_patient)->get();
                $patients = Patients::where('status', 1)->get();

                return redirect('view-patient-reports')
                ->with('role',4)->with(['reports'=>$reports])->with('patients',$patients)
                ->with('task','View Patient Reports');
            }
            else{
                $reports = Report::where('status', null)
                ->where('patient',$request->search_patient)
                ->where('date',$request->date)->get();
                $patients = Patients::where('status', 1)->get();

                return redirect('view-patient-reports')
                ->with('role',4)->with(['reports'=>$reports])->with('patients',$patients)
                ->with('task','View Patient Reports');
            }


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
        if (auth()->user()->role == 2)
        {
            $app = Report::where('id',$id)
                    ->update(['status' => 0]);

                    return redirect('remove-patient-reports');
        }
        else
        {
            return 'error' ;
        }
    }
}
