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
Route::post('/add-openBalanceAgent', 'AgentController@addOpenBalance')->name('addopenBalanceAgent');

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
Route::post('/aaa/{id}', 'OperationsController@sendToAccount')->name('aaa');
Route::get('/customer/print-pdf', 'OperationsController@printPDF')->name('customer.printpdf');


Route::get('selector_type_operation/fetch', 'CashFinanceController@selector_type')->name('selector_type_operation.fetch');





/*---------------------------------------------Accounting ----------------------------------*/
// ----------------------------Cash_box------------------
Route::resource('/cash-box', 'CashBoxController');
// ----------------------------Bank------------------CashFinanceController
Route::resource('/bank', 'BankController');
/*-----------------------------CashFinanceController-------------------------*/
Route::resource('/cash-finance', 'CashFinanceController');
Route::get('/add-cash-finance/{id}', 'CashFinanceController@addCashFinance')->name('add-cash-finance');
Route::get('clientSelect/fetch', 'CashFinanceController@clientSelect')->name('clientSelect.fetch');
Route::get('selector_type/fetch', 'CashFinanceController@selector_type')->name('selector_type.fetch');
Route::get('selectionSelect/fetch', 'CashFinanceController@selectionSelect')->name('selectionSelect.fetch');


/*-----------------------------BankFinanceController-------------------------*/
Route::resource('/bank-finance', 'BankFinanceController');
Route::get('/add-bank-finance/{id}', 'BankFinanceController@addBankFinance')->name('add-bank-finance');
Route::get('bankClientSelect/fetch', 'BankFinanceController@clientSelect')->name('bankClientSelect.fetch');
Route::get('bank_selector_type/fetch', 'BankFinanceController@selector_type')->name('bank_selector_type.fetch');
Route::get('bank_selectionSelect/fetch', 'BankFinanceController@selectionSelect')->name('bank_selectionSelect.fetch');
// ----------------------------invoice------------------
Route::resource('/invoice', 'InvoiceController');
Route::get('dynamicoperation/fetch', 'InvoiceController@fetExist')->name('dynamicoperation.fetch');
Route::get('/sendStatment', 'InvoiceController@sendStatment')->name('sendStatment');
Route::get('/sendInvoice', 'InvoiceController@sendInvoice')->name('sendInvoice');
Route::get('/customer/print-pdf/{id}', 'InvoiceController@printInvoicePDF')->name('customer.printpdf');
Route::get('/customer/print-statment/{id}', 'InvoiceController@printStatmentPDF')->name('customer.printstatment');


/*-------------------------Statment----------------------------------*/
Route::resource('/account-statment', 'AccountStatmentController');
Route::get('selector_statment/fetch', 'AccountStatmentController@selector_type')->name('selector_statment.fetch');
/*-------------------------BankCashStatmentController----------------------------------*/
Route::resource('/bank-cash-statment', 'BankCashStatmentController');

/*-------------------------Statment----------------------------------*/
Route::get('/notifications/{id}', 'UserNotificationsController@show')->name('notifications');



/*-------------------------Reports----------------------------------*/
Route::resource('/client-report', 'ClientReport');
Route::get('fetch-client-report/fetch', 'ClientReport@fetchReport')->name('fetch-client-report.fetch');


/*-------------------------Supplier Reports----------------------------------*/
Route::resource('/supplier-report', 'SuppliersReport');
Route::get('fetch-supplier-report/fetch', 'SuppliersReport@fetchReport')->name('fetch-supplier-report.fetch');
Route::get('supplier_selector_report/fetch', 'SuppliersReport@selector_type')->name('supplier_selector_report.fetch');

/*-------------------------Reports----------------------------------*/
Route::resource('/total-balance', 'TotalBalance');

/*-------------------------earn-balance----------------------------------*/
Route::resource('/earn-balance', 'EarnReportController');
/*-------------------------operation-balance----------------------------------*/
Route::resource('/operation-balance', 'OperationBalanceController');

