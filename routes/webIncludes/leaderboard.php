
<?php
Route::prefix('admin/leaderboard/')
    ->middleware(['auth'])
    ->group(function ($router) {

        Route::get('leaderboard/{id}',[App\Http\Controllers\Admin\leaderboardController::class, 'leaderboard'])->name('admin.leaderboard.show');

        Route::post('updateAmount/{id}',[App\Http\Controllers\Admin\leaderboardController::class, 'updateAmount'])->name('admin.leaderboard.updateAmount');
        Route::post('distributeAmount/{id}',[App\Http\Controllers\Admin\leaderboardController::class, 'distributeAmount'])->name('admin.leaderboard.distributeAmount');

    });
