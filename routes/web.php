<?php


Route::get('/', 'RouteCheckController@index');
Route::post('/addCompany', 'CompanyController@create');
Route::get('/dashboard', 'RouteCheckController@login');

Route::post('/addEmployee', 'EmployeeController@create');
Route::post('/login-user', 'EmployeeController@login');
Route::get('/employee/staff', 'EmployeeController@staff');
Route::patch('/employee/status', 'EmployeeController@status');
// Route::get('/employee/join', 'EmployeeController@join');


Route::resource('/employee', 'EmployeeController');
Route::resource('/additional', 'AdditionalController');
Route::get('/advance/report','AdvancetakenController@advancereport');
Route::resource('/advance', 'AdvancetakenController');
Route::patch('/attendance/checkout','AttendanceController@checkout');
Route::post('/attendance/checkin', 'AttendanceController@checkin');
Route::get('/attendance/getcheckin','AttendanceController@getcheckin');
Route::get('/attendance/report','AttendanceController@attendancereport');
Route::get('/event/notification', 'EventcalendarController@notification');
Route::post('/event/dragevent', 'EventcalendarController@dragevent');
Route::resource('/event', 'EventcalendarController');


//----------------------------------------------
//            Billing
//----------------------------------------------

Route::get('/getMechanics', 'EmployeeController@getMechanics');

Route::post('/addCustomer', 'CustomerController@addCustomer');

Route::post('/startBill', 'BillController@startBill');

Route::post('/getBill', 'BillController@getBill');

Route::post('/startRepair', 'RepairController@startRepair');

Route::post('/getSales', 'SaleController@getSales');

Route::post('/addSale', 'SaleController@addSale');

Route::post('/updateBill', 'BillController@updateBill');

Route::post('/updateRepair', 'RepairController@updateRepair');

Route::delete('/deleteSale/{id}/{company_id}', 'SaleController@deleteSale');

Route::get('/getCounterSales', 'CounterSaleController@getCounterSales');

Route::post('/addCounterSale', 'CounterSaleController@addCounterSale');

Route::delete('/deleteCounterSale/{id}/{company_id}', 'CounterSaleController@deleteCounterSale');
