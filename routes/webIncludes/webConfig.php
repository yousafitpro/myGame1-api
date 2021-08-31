<?php
Route::prefix('admin/webConfig/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('getConfig',[App\Http\Controllers\Admin\WebconfigController::class, 'getConfig'])->name('admin.webConfig.getConfig');
        Route::post('updateConfig',[App\Http\Controllers\Admin\WebconfigController::class, 'updateConfig'])->name('admin.webConfig.updateConfig');
    });
