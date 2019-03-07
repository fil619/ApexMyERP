<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Additional;

class AdditionalController extends Controller
{
  public function store(Request $request)
  {
    $request->request->add(['company_id' => 1]);
    $advance = Additional::create([
      'emp_id'       => request('emp_id'),
      'company_id' => request('company_id'),
      'vehicle'       => request('vehicle'),
      'date'          => request('date'),
      'amount'         => request('amount'),
      'work'         => request('work')
    ]);
  }
}
