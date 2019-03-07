<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\attendance;

class AttendanceController extends Controller
{

  public function attendancereport(Request $request)
  {
      $employee_id = $request->employee_id;
      $startdaate  = $request->startdaate;
      $enddaate    = $request->enddaate;

    $report = attendance::where('employee_id' , '=' , $employee_id)
                        ->whereBetween('date', [$startdaate, $enddaate])->orderBy('date', 'asc')->get();

    return response()->json([
      'report'    => $report,
    ], 200);
  }

  public function checkout(Request $request )
  {

    $employee_id = $request->employee_id ;
    $date = $request->date ;
    $checkout = $request->checkout ;
    $hours = $request->hours ;
    $daystatus = $request->daystatus ;

    $attendance = attendance::where('date', $date )
                            ->where('employee_id',$employee_id )
                            ->update([
                              'checkout' => $checkout,
                              'working_hours' => $hours,
                              'daystatus' => $daystatus,
                            ]);
  }
  public function checkin(Request $request )
  {
    $employee_id = $request->employee_id ;
    $date = $request->date ;
    $status = $request->status ;
    $checkin = $request->checkin ;
    $request->request->add(['company_id' => 1]);

    $attendance = attendance::firstOrCreate(
        ['employee_id' => $employee_id , 'date' => $date  ],
        [
            'employee_id' => request('employee_id'),
              'company_id' => request('company_id'),
              'date'        => request('date'),
              'attendance'      => request('status'),
              'checkin'     => request('checkin'),
        ]
    );
  }
  public function getcheckin(Request $request)
  {
    $employee_id = $request->employee_id ;
    $date = $request->date ;
    $checkin = attendance::where('date', $date )
                            ->where('employee_id',$employee_id )
                            ->pluck('checkin');
    return $checkin;
  }
}
