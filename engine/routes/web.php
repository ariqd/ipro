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


//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');

    Route::resource('dashboard', 'DashboardController');
    Route::resource('pos', 'PosController');
    Route::resource('catalogues', 'CatalogueController');

    Route::resource('items', 'ItemController');
    Route::get('stocks/get', 'StockController@getJsonTable');
//    Route::get('stocks/restock', 'StockController@restock');
    Route::get('stocks/{id}/restock', 'StockController@restock');
    Route::post('stocks/{id}/restock', 'StockController@restockSingular');
    Route::get('stocks/getdatabycategory/{id}', 'StockController@getDataByCategory');
    Route::resource('stocks', 'StockController');

    Route::resource('purchase-orders', 'PurchaseOrderController');
    Route::get('purchase-orders/create/add-items', 'PurchaseOrderController@addItems');
    Route::resource('sales-orders', 'SalesOrderController');
    Route::get('sales-orders/create/search-stocks', 'SalesOrderController@searchStocks');
    Route::get('sales-orders/create/customer', 'SalesOrderController@createCustomer');
    Route::post('sales-orders/create/customer', 'SalesOrderController@insertCustomer');
    Route::get('sales-orders/create/customer/{id}', 'SalesOrderController@getCustomer');

    Route::resource('finances', 'FinanceController');
    Route::resource('accounts', 'AccountController');
    Route::resource('branches', 'BranchController');
    Route::resource('deposits', 'DepositController');

    Route::resource('customers', 'CustomerController');

    Route::resource('brands', 'BrandController');
    Route::resource('categories', 'CategoryController');
    
    Route::get('categories/search/{id}', 'CategoryController@search');
    Route::get('items/search/{id}', 'ItemController@search');
    Route::get('items/search/detail/{id}', 'ItemController@searchdetail');
});
