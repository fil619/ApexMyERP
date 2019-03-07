<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class RouteCheckController extends Controller
{
    public function index(){
        Session::flush();
        return view('login');
    }

    public function login(){
        if(Session::has('company_id') AND Session::has('employee_id')){
            return view('panel');
        } else{
            return redirect('/');
        }
    }
}
