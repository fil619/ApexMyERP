<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Sale;
use App\Repair;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class BillController extends Controller
{
    public function startBill(Request $request){
        $request->request->add(['company_id' => Session::get('company_id')]);

        $bill = Bill::where('company_id', $request->input('company_id'))->where('customer_id', $request->input('customer_id'))->where('type', $request->input('type'))->whereNull('ended_on')->first();

        if($bill){
            return $bill;
        } else {
            $bill = Bill::create($request->all());
            return $bill;
        }
    }

    public function getBill(Request $request){
        $request->request->add(['company_id' => Session::get('company_id')]);

        if($request->has('customer_id')){
            $bill = Bill::where('company_id', $request->input('company_id'))->where('customer_id', $request->input('customer_id'))->where('type', $request->input('type'))->whereNull('ended_on')->first();
        } else if($request->has('id')){
            $bill = Bill::where('company_id', $request->input('company_id'))->where('id', $request->input('id'))->where('type', $request->input('type'))->whereNull('ended_on')->first();
        }

        if($bill){
            return $bill;
        } else {
            return 0;
        }
    }

    public function updateBill(Request $request){
        $sale_total = Sale::where('company_id', $request->input('company_id'))->where('bill_id', $request->input('id'))->sum('sale_total');
        $sale_gst = Sale::where('company_id', $request->input('company_id'))->where('bill_id', $request->input('id'))->sum('gst_value');

        $service_charge = Repair::where('company_id', $request->input('company_id'))->where('bill_id', $request->input('id'))->sum('service_charge');
        $other_charge = Repair::where('company_id', $request->input('company_id'))->where('bill_id', $request->input('id'))->sum('other_charge');

        $sub_total = $sale_total + $service_charge + $other_charge;

        $request->request->add(['sub_total' => $sub_total]);
        $request->request->add(['gst_total' => $sale_gst]);

        $request->merge(['grand_total' => $request->get('sub_total') - $request->get('discount')]); 
        $request->merge(['balance' => $request->input('grand_total') - $request->input('advance')]);

        if($request->has('paid') && ($request->get('paid') > 0)){
            $request->merge(['returnable' => $request->get('paid') - $request->get('balance')]);
            $request->merge(['ended_on' => Carbon::now()]);
        }

        Bill::where('company_id', $request->input('company_id'))->where('id', $request->input('id'))->where('customer_id', $request->input('customer_id'))->first()->update($request->all());

        $bill = Bill::where('company_id', $request->input('company_id'))->where('id', $request->input('id'))->where('customer_id', $request->input('customer_id'))->first();

        return $bill;
    }
}
