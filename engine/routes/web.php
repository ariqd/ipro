<?php

Auth::routes();
    Route::get('/welcome', function(){
        return view('welcome');
    });

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');

    Route::resource('dashboard', 'DashboardController');
    Route::resource('pos', 'PosController');
    Route::resource('catalogues', 'CatalogueController');

    Route::resource('items', 'ItemController');

    Route::get('stocks/get', 'StockController@getJsonTable');
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

    Route::get('sales-orders/search/{id}',"SalesOrderController@searchdetailSO");

    Route::post('purchase-orders/{id}/approve',"PurchaseOrderController@searchApprove");
    Route::get('sales-orders/check/approve', 'SalesOrderController@unapprovedList');
    Route::get('sales-orders/{id}/payment', 'SalesOrderController@getPaymentForm');
    Route::post('sales-orders/{id}/payment', 'SalesOrderController@postPaymentForm');


});
