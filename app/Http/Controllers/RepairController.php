<?php

namespace App\Http\Controllers;

use App\Repair;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class RepairController extends Controller
{
    public function startRepair(Request $request){
        $request->request->add(['company_id' => Session::get('company_id')]);

        $repair = Repair::where('company_id', $request->input('company_id'))->where('bill_id', $request->input('bill_id'))->first();

        if($repair){
            return $repair;
        } else {
            $repair = Repair::create($request->all());
            return $repair;
        }
    }

    public function updateRepair(Request $request){
        $request->request->add(['repaired_on' => Carbon::now()]);
        Repair::where('company_id', $request->input('company_id'))->where('bill_id', $request->input('bill_id'))->where('employee_id', $request->input('employee_id'))->first()->update($request->all());

        return 0;
    }
}
