<?php
Route::prefix('admin/withdrawalHistory/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('getAll',[App\Http\Controllers\Admin\WithdrawalhistoryController::class, 'getALL'])->name('admin.withdrawalHistory.getAll');
    });
