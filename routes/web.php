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

    Route::get('inventories/get', 'InventoryController@getJsonTable');
//    Route::get('inventories/restock', 'InventoryController@restock');
    Route::get('inventories/{id}/restock', 'InventoryController@restock');
    Route::post('inventories/{id}/restock', 'InventoryController@restockSingular');
    Route::resource('inventories', 'InventoryController');

    Route::resource('purchase-orders', 'PurchaseOrderController');
    Route::get('purchase-orders/create/add-items', 'PurchaseOrderController@addItems');
    Route::resource('sales-orders', 'SalesOrderController');
//    Route::get('sales-orders/create', 'SalesOrderController@create');

    Route::resource('finances', 'FinanceController');
    Route::resource('accounts', 'AccountController');
    Route::resource('branches', 'BranchController');
    Route::resource('deposits', 'DepositController');
});
