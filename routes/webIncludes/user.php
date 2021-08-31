<?php
Route::prefix('user/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('update-profile',[App\Http\Controllers\Admin\userController::class, 'showProfile'])->name('user.showProfile');
        Route::post('update-profile',[App\Http\Controllers\Admin\userController::class, 'updateProfile'])->name('user.showProfile');
        Route::post('reset-password',[App\Http\Controllers\Admin\userController::class, 'resetPassword'])->name('user.resetPassword');
        Route::get('WalletAmounts',[App\Http\Controllers\Admin\leaderboardController::class, 'wallet_amounts'])->name('user.walletAmounts');

    });
