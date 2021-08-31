<?php
Route::prefix('admin/withdrawalRequest/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('getAll',[App\Http\Controllers\Admin\WithdrawalrequestController::class, 'getALL'])->name('admin.withdrawalRequest.getAll');
        Route::get('approve/{id}',[App\Http\Controllers\Admin\WithdrawalrequestController::class, 'approve'])->name('admin.withdrawalRequest.approve');
        Route::get('reject/{id}',[App\Http\Controllers\Admin\WithdrawalrequestController::class, 'reject'])->name('admin.withdrawalRequest.reject');

    });
