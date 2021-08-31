<?php
Route::prefix('admin/app/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::post('add',[App\Http\Controllers\Admin\AppConfigController::class, 'add'])->name('admin.app.add');
        Route::get('getAll',[App\Http\Controllers\Admin\AppConfigController::class, 'getAll'])->name('admin.app.getAll');
        Route::get('deleteOne/{id}',[App\Http\Controllers\Admin\AppConfigController::class, 'deleteOne'])->name('admin.app.deleteOne');

    });
