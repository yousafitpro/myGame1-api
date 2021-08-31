<?php
Route::prefix('admin/role/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('add',[App\Http\Controllers\Admin\roleController::class, 'addView'])->name('admin.role.add');
        Route::post('add',[App\Http\Controllers\Admin\roleController::class, 'add'])->name('admin.role.add');
        Route::get('getOne/{id}',[App\Http\Controllers\Admin\roleController::class, 'getOne'])->name('admin.role.getOne');
        Route::get('deleteOne/{id}',[App\Http\Controllers\Admin\roleController::class, 'deleteOne'])->name('admin.role.deleteOne');
        Route::post('update/{id}',[App\Http\Controllers\Admin\roleController::class, 'update'])->name('admin.role.update');
        Route::get('getAll',[App\Http\Controllers\Admin\roleController::class, 'getALL'])->name('admin.role.getAll');
    });
