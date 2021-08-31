<?php
Route::prefix('admin/lottery/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('add',[App\Http\Controllers\Admin\LotteryController::class, 'addView'])->name('admin.lottery.add');
        Route::post('add',[App\Http\Controllers\Admin\LotteryController::class, 'add'])->name('admin.lottery.add');
        Route::get('getOne/{id}',[App\Http\Controllers\Admin\LotteryController::class, 'getOne'])->name('admin.lottery.getOne');
        Route::get('deleteOne/{id}',[App\Http\Controllers\Admin\LotteryController::class, 'deleteOne'])->name('admin.lottery.deleteOne');
        Route::post('update/{id}',[App\Http\Controllers\Admin\LotteryController::class, 'update'])->name('admin.lottery.update');
        Route::get('getAll',[App\Http\Controllers\Admin\LotteryController::class, 'getALL'])->name('admin.lottery.getAll');
    });
