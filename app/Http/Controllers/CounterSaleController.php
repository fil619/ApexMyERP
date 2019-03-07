<?php

namespace App\Http\Controllers;

use App\CounterSale;
use Illuminate\Http\Request;
use Session;

class CounterSaleController extends Controller
{
    public function getCounterSales(){
        $cs = CounterSale::where('company_id', Session::get('company_id'))->orderBy('sold_on', 'desc')->get();

        return $cs;
    }

    public function addCounterSale(Request $request){
        $request->request->add(['company_id' => Session::get('company_id')]);

        $mrp = $request->input('sell_mrp');
        $gst = $request->input('gst_percent');
        $qty = $request->input('quantity');
        $gst_value = (($mrp/100)*$gst)*$qty;
        $request->request->add(['gst_value' => round($gst_value,2)]);

        $cs = CounterSale::create($request->all());

        return $cs;
    }

    public function deleteCounterSale($id,$company_id){
        $cs = CounterSale::where('id', $id)->where('company_id', $company_id)->first();
        $cs->delete();

        return 0;
    }
}
