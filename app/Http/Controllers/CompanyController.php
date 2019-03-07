<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class CompanyController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $request->request->add(['expiry_date' => Carbon::now()->addYear()->toDateTimeString()]);
        $company = Company::create($request->all());

        Session::put('company_id', $company->id);

        return $company->id;
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        //
    }

    public function update(Request $request, Company $company)
    {
        //
    }

    public function destroy(Company $company)
    {
        //
    }
}
