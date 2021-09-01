<?php

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix'=>'payment-methods'
], function ($router) {
    Route::get('getAll',[App\Http\Controllers\Admin\PaymentMethodController::class, 'getALL'])->name('admin.paymentMethods.getAll');
    Route::post('add',[App\Http\Controllers\Admin\PaymentMethodController::class, 'add'])->name('admin.paymentMethods.add');
    Route::post('update/{id}',[App\Http\Controllers\Admin\PaymentMethodController::class, 'update'])->name('admin.paymentMethods.update');
    Route::get('active/{id}',[App\Http\Controllers\Admin\PaymentMethodController::class, 'active'])->name('admin.paymentMethods.active');
    Route::get('unactive/{id}',[App\Http\Controllers\Admin\PaymentMethodController::class, 'unactive'])->name('admin.paymentMethods.unactive');
});
