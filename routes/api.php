<?php

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'v1/auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});

Route::group([
    'namespace' => 'App\Http\Controllers\API',
    'prefix' => 'v1',
    'middleware'=>'auth:api'
], function ($router) {

    Route::get('score_by_game_id', 'ScoreController@score_by_game_id');
    Route::post('save_score', 'ScoreController@save_score');

    Route::post('set_wallet_amount', 'WalletAmountController@set_wallet_amount');
    Route::get('get_wallet', 'WalletAmountController@get_wallet');


    Route::post('withdraw_request', 'WithdrawalrequestController@withdraw_request');

    Route::get('get_withdraw_history', 'WithdrawalhistoryController@get_withdraw_history');

    Route::post('send_time', 'leaderboardController@send_time');

    Route::get('get_withdrawl_request/{wallet_amount_id}', 'WalletAmountController@withdrawl_request');
    Route::get('get_withdrawl_requests', 'WalletAmountController@withdrawl_requests');
    Route::get('get_withdrawl_requests_histories', 'WalletAmountController@withdrawl_requests_histories');


});

Route::group([
    'namespace' => 'App\Http\Controllers\API',
    'prefix' => 'v1'

], function ($router) {
    Route::get('get_leaderboard','leaderboardController@leaderboard');
});
Route::any("reset",function (){
    $c1=\Illuminate\Support\Facades\Artisan::call('config:cache');
    $c2=\Illuminate\Support\Facades\Artisan::call('cache:clear');
    $c3=\Illuminate\Support\Facades\Artisan::call('config:cache');
    return "<---Restored--->";
});
