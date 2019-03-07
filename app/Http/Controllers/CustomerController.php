<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Bill;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public function addCustomer(Request $request){
        $request->request->add(['company_id' => Session::get('company_id')]);

        if($request->has('vehicle_no')){
            $customer = Customer::where('company_id', $request->input('company_id'))->where('vehicle_no', $request->input('vehicle_no'))->first();
        } else if($request->has('mobile')){
            $customer = Customer::where('company_id', $request->input('company_id'))->where('mobile', $request->input('mobile'))->first();
        } else if($request->has('id')){
            $customer = Customer::where('company_id', $request->input('company_id'))->where('id', $request->input('id'))->first();
        }

        if($customer){
            return $customer;
        } else {
            $customer = Customer::create($request->all());
            return $customer;
        }
    }
}


 // $bill = Bill::create(['company_id' => Session::get('company_id'),'customer_id' => $customer->id]);
// $customer->setAttribute('bill_id', $bill->id);