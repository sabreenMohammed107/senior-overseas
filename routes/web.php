<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Route::get('registerTest', function () {
//     return view('auth.register');
// });
Route::post('reg', 'Auth\TestController@create')->name('reg');
/*-----------------------------------------------------------*/
Route::resource('/usersList', 'UserListController');
Route::get('/registerTest', 'UserListController@registerTest')->name('registerTest');
Route::get('/resetPassword/{id}', 'UserListController@resetPassword')->name('resetPassword');
Route::post('editUserPassword', 'UserListController@editUserPassword')->name('editUserPassword');

/*-------------------------------------------------------*/

// Route::get('/', function () {
//     return view('dashboard');
// });

// ----------------------------client------------------
Route::resource('/client', 'ClientController');
Route::post('/add-openBalanceClient', 'ClientController@addOpenBalance')->name('addopenBalanceClient');

// ----------------------------supplier------------------
Route::resource('/supplier', 'SupplierController');
Route::post('/add-openBalanceSupplier', 'SupplierController@addOpenBalance')->name('addopenBalanceSupplier');

// ----------------------------port------------------
Route::resource('/port', 'PortController');
// ----------------------------carrier------------------
Route::resource('/carrier', 'CarrierController');
Route::post('/add-openBalance', 'CarrierController@addOpenBalance')->name('addopenBalance');
// ----------------------------agent------------------
Route::resource('/agent', 'AgentController');
// ----------------------------expenses------------------
Route::resource('/expenses', 'ExpensesController');
// ----------------------------container------------------
Route::resource('/container', 'ContainerController');
// ----------------------------employee------------------
Route::resource('/employee', 'EmployeeController');
// ----------------------------bank-account------------------
Route::resource('/bank-account', 'BankAccountController');
// ----------------------------currency------------------
Route::resource('/currency', 'CurrencyController');
// ----------------------------commodity------------------
Route::resource('/commodity', 'CommodityController');
// ---------------------------country------------------
Route::resource('/country', 'CountryController');
// ---------------------------ocean-freight------------------
Route::resource('/ocean-freight', 'OceanFreightController');
// ---------------------------trucking-rate------------------
Route::resource('/trucking-rate', 'TruckingRateController');
// ---------------------------air-rate------------------
Route::resource('/air-rate', 'AirRateController');

// ----------------------------role------------------
Route::resource('/role', 'RolesController');
// ---------------------------sale_quote------------------
// Route::resource('/sale-quote', 'SalesQuoteController');
// Route::get('fetchAir', 'SalesQuoteController@fetchAir')->name('fetchAir');
// Route::get('fetchOcean', 'SalesQuoteController@fetchOcean')->name('fetchOcean');
// Route::get('fetchTrucking', 'SalesQuoteController@fetchTrucking')->name('fetchTrucking');



//----------------------------------------------------
Route::resource('/sale-quote', 'SalesQuoteController');
Route::get('fetchAir', 'SalesQuoteController@fetchAir')->name('fetchAir');
Route::get('fetchOcean', 'SalesQuoteController@fetchOcean')->name('fetchOcean');
Route::get('fetchTrucking', 'SalesQuoteController@fetchTrucking')->name('fetchTrucking');
Route::post('gotosave', 'SalesQuoteController@gotosave')->name('gotosave');
//------------------------------operations-------------------------
// ----------------------------supplier------------------
Route::resource('/operations', 'OperationsController');
Route::get('dynamicdependentexist/fetch', 'OperationsController@fetExist')->name('dynamicdependentexist.fetch');
//expenses
Route::post('/add-operationExpenses', 'OperationsController@addExpenses')->name('addOperationExpenses');
Route::post('/edit-operationExpenses', 'OperationsController@updateExpenses')->name('updateOperationExpenses');
Route::post('/delete-operationExpenses/{id}', 'OperationsController@deleteExpenses')->name('deleteOperationExpenses');
