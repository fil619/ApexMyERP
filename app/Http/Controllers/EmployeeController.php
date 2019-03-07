<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Session;
use DB;

class EmployeeController extends Controller
{
    public function login(Request $request){
        $employee = Employee::where('email', $request->input('email'))->where('password', $request->input('password'))->first();

        if($employee){
            Session::flush();
            Session::put('employee_id', $employee->id);
            Session::put('company_id', $employee->company_id);

            return 1;

        } else {

            return 0;

        }
    }

    public function getMechanics(){
        $mechanics = Employee::where('type', '=', 'Mechanic')->get();
        return $mechanics;
    }

    public function index()
    {
      $employee = employee::get();
      return response()->json([
          'employee'    => $employee,
      ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required|date|date_format:Y-m-d',
            'address' => 'required|string',
            'mobile' => 'required|regex:/[7-9]{1}[0-9]{9}/',
            'email' => 'required|email',
            'aadhaar' => 'string',
            'type' => 'required|string',
            'password' => 'required|string',
            'joined_on' => 'required|date|date_format:Y-m-d',
        ]);

        $employee = Employee::create($request->all());

        Session::put('employee_id', $employee->id);

        // return $employee->first_name;
        return Session::all();
    }

    public function store(Request $request)
    {
      $this->validate($request, [
          'first_name' => 'required|string',
          'last_name' => 'required|string',
          'dob' => 'required|date|date_format:Y-m-d',
          'address' => 'required|string',
          'mobile' => 'required|regex:/[7-9]{1}[0-9]{9}/',
          'aadhaar' => 'string',
          'type' => 'required|string',
          'joined_on' => 'required|date|date_format:Y-m-d',
      ]);
    // $request->request->add('company_id' , Session::get('company_id') );
    $request->request->add(['company_id' => Session::get('company_id')]);
    $request->request->add(['company_id' => 1]);
      $employee = Employee::create($request->all());

      Session::put('employee_id', $employee->id);

      // return $employee->first_name;
      return Session::all();
    }

    public function show(Employee $employee)
    {

    }

    public function edit(Employee $employee)
    {
        return 100;
    }


      public function staff()
      {
        // $users = DB::table('employees')
        //         ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
        //         ->get();
        // return $users ;
        $first = employee::where('type','!=','Admin')->get();
        return $first ;
      }
      public function status(Request $request)
      {
        $employee_id = $request->employee_id ;
        $status = $request->status;
        $employee = employee::where('id',$employee_id )
                                ->update(['status' => $status]);
                                return $status;
      }
    public function update(Request $request)
    {
    $id = $request->employee_id ;
    $employee = employee::find($id);
    $employee->first_name = request('first_name');
    $employee->last_name = request('last_name');
    $employee->dob = request('dob');
    $employee->address = request('address');
    $employee->telephone = request('telephone');
    $employee->mobile = request('mobile');
    $employee->email = request('email');
    $employee->aadhaar = request('aadhaar');
    $employee->type = request('type');
    $employee->password = request('password');
    $employee->joined_on = request('joined_on');
    $employee->save();
    }

    public function destroy(Employee $employee)
    {
        //
    }
}
