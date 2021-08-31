<?php
Route::prefix('admin/user/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('add',[App\Http\Controllers\Admin\userController::class, 'addView'])->name('admin.user.add');
        Route::post('add',[App\Http\Controllers\Admin\userController::class, 'add'])->name('admin.user.add');
        Route::get('deleteOne/{id}',[App\Http\Controllers\Admin\userController::class, 'deleteOne'])->name('admin.user.deleteOne');
        Route::get('getOne/{id}',[App\Http\Controllers\Admin\userController::class, 'getOne'])->name('admin.user.getOne');
        Route::post('update/{id}',[App\Http\Controllers\Admin\userController::class, 'update'])->name('admin.user.update');
        Route::get('active/{id}',[App\Http\Controllers\Admin\userController::class, 'active'])->name('admin.user.active');
        Route::get('unActive/{id}',[App\Http\Controllers\Admin\userController::class, 'unActive'])->name('admin.user.unActive');
        Route::get('getAll',[App\Http\Controllers\Admin\userController::class, 'getAll'])->name('admin.user.getAll');
    });
