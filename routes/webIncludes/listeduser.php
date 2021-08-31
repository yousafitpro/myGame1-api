<?php
Route::prefix('admin/gameuser/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('add/{id}/{game_id}',[App\Http\Controllers\Admin\usergamerController::class, 'add'])->name('admin.user.gameusers.add');
        Route::get('remove/{id}/{game_id}',[App\Http\Controllers\Admin\usergamerController::class, 'remove'])->name('admin.user.gameusers.remove');
        Route::get('getAll/{id}',[App\Http\Controllers\Admin\usergamerController::class, 'getALL'])->name('admin.user.gameusers.getAllListed');
        Route::get('getAllListedUsers/{id}',[App\Http\Controllers\Admin\usergamerController::class, 'getAllListedUsers'])->name('admin.user.gameusers.getAllGamers');

    });
