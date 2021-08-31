<?php
Route::prefix('admin/game/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('add',[App\Http\Controllers\Admin\GameController::class, 'addView'])->name('admin.game.add');
        Route::post('add',[App\Http\Controllers\Admin\GameController::class, 'add'])->name('admin.game.add');
        Route::get('getOne/{id}',[App\Http\Controllers\Admin\GameController::class, 'getOne'])->name('admin.game.getOne');
        Route::get('deleteOne/{id}',[App\Http\Controllers\Admin\GameController::class, 'deleteOne'])->name('admin.game.deleteOne');
        Route::post('update/{id}',[App\Http\Controllers\Admin\GameController::class, 'update'])->name('admin.game.update');
        Route::get('getAll',[App\Http\Controllers\Admin\GameController::class, 'getALL'])->name('admin.game.getAll');

    });
