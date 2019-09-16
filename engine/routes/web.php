<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');

    Route::resource('dashboard', 'DashboardController');

    Route::resource('stocks', 'StockController');
    Route::get('stocks/get', 'StockController@getJsonTable');
    Route::get('stocks/{id}/restock', 'StockController@restock');
    Route::post('stocks/{id}/restock', 'StockController@restockSingular');
    Route::get('stocks/getdatabycategory/{id}', 'StockController@getDataByCategory');

    Route::resource('purchase-orders', 'PurchaseOrderController');
    Route::get('purchase-orders/create/add-items', 'PurchaseOrderController@addItems');
    Route::post('purchase-orders/{id}/approve', "PurchaseOrderController@approve");
    Route::get('purchase-orders/{id}/search', "PurchaseOrderController@search");
    Route::get('purchase-orders/{id}/pdf/po', 'PurchaseOrderController@printPO');
    Route::get('purchase-orders/{id}/pdf/memo', 'PurchaseOrderController@printMemoPengambilanProduk');

    Route::get('nota-khusus', 'SalesOrder\SalesOrderController@notaKhusus');
    Route::post('nota-khusus-create', 'SalesOrder\SalesOrderController@notaKhususCreate');
    Route::resource('sales-orders', 'SalesOrder\SalesOrderController');
    Route::get('sales-orders/create/search-stocks', 'SalesOrder\SalesOrderSearchController@searchStocks');
    Route::get('sales-orders/search/{id}', "SalesOrder\SalesOrderSearchController@searchdetailSO");
    Route::get('sales-orders/create/customer', 'SalesOrder\SalesOrderCustomerController@create');
    Route::post('sales-orders/create/customer', 'SalesOrder\SalesOrderCustomerController@insert');
    Route::get('sales-orders/create/customer/{id}', 'SalesOrder\SalesOrderCustomerController@index');
    Route::get('sales-orders/check/approve', 'SalesOrder\SalesOrderApproveController@index');
    Route::get('sales-orders/{id}/payment', 'SalesOrder\SalesOrderApproveController@getPaymentForm');
    Route::post('sales-orders/{id}/payment', 'SalesOrder\SalesOrderApproveController@postPaymentForm');
    Route::get('sales-orders/{id}/approve/print', 'SalesOrder\SalesOrderApproveController@makeKwitansi');
    Route::get('sales-orders/{id}/pdf/quotation', 'SalesOrder\SalesOrderPrintController@makeQuotation');
    Route::post('sales-orders/{id}/pdf/invoice', 'SalesOrder\SalesOrderPrintController@makeInvoice');
    Route::get('sales-orders/{id}/pdf/surat-jalan', 'SalesOrder\DeliveryOrderController@print');

    Route::get('categories/search/{id}', 'CategoryController@search');

    Route::resource('items', 'ItemController');
    Route::get('items/search/{id}', 'ItemController@search');
    Route::get('items/search/detail/{id}', 'ItemController@searchdetail');

    Route::resource('pos', 'PosController');
    Route::resource('catalogues', 'CatalogueController');
    Route::resource('finances', 'FinanceController');
    Route::resource('accounts', 'AccountController');
    Route::resource('branches', 'BranchController');
    Route::resource('deposits', 'DepositController');
    Route::resource('customers', 'CustomerController');
    Route::resource('brands', 'BrandController');
    Route::resource('categories', 'CategoryController');
    Route::resource('goods-receive', 'ReceiveController');
    Route::resource('vendors', 'VendorController');

    // Additional
    Route::get('sales-orders/{id}/delivery-orders', 'SalesOrder\DeliveryOrderController@getForm');
    Route::post('sales-orders/{id}/delivery-orders', 'SalesOrder\DeliveryOrderController@store');
    // Route::get('print/memo', 'ReceiveController@printMemoPengambilanProduk');

    Route::get('finances/komisi/{user}/set', 'CommissionController@setKomisi')->name('finances.komisi.set');
    Route::post('finances/komisi/{user}/set', 'CommissionController@storeKomisi')->name('finances.komisi.store');
    Route::get('finances/komisi/{user}/print', 'CommissionController@printKomisi')->name('finances.komisi.print');
    Route::get('finances/komisi/{user}', 'CommissionController@show')->name('finances.komisi.show');

    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::post('settings', 'SettingsController@update')->name('settings.update');

    Route::get('warehouse/{branch}/create', 'WarehouseController@create');
    Route::get('warehouse/{branch}/edit', 'WarehouseController@edit');
    Route::post('warehouse/store', 'WarehouseController@store');
    Route::put('warehouse/update', 'WarehouseController@update');
});
