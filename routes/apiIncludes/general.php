<?php
Route::group([
    'namespace' => 'App\Http\Controllers\API',
    'prefix'=>'general'
], function ($router) {


    Route::post('updateProfile', 'generalController@updateProfile');
    Route::get('get_web_config', 'generalController@get_web_config');
});
