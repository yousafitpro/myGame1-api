<?php
Route::group([
    'namespace' => 'App\Http\Controllers\API',
    'prefix'=>'general'
], function ($router) {


    Route::post('updateProfile', 'generalController@updateProfile');

});
