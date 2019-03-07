<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function getSales(Request $request){
        $sales = Sale::where('company_id', $request->company_id)->where('bill_id', $request->bill_id)->orderBy('sold_on', 'asc')->get();

        return $sales;
    }

    public function addSale(Request $request){

        $mrp = $request->input('sell_mrp');
        $gst = $request->input('gst_percent');
        $qty = $request->input('quantity');
        $gst_value = (($mrp/100)*$gst)*$qty;
        $total = $mrp*$qty;

        $request->request->add(['gst_value' => $gst_value]);
        $request->request->add(['sale_total' => $total]);
        $sale = Sale::create($request->all());

        return $sale;
    }
}
