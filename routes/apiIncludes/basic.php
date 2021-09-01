<?php
Route::group([
    'namespace' => 'App\Http\Controllers\API'
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
    Route::get('tournaments', 'gameController@tournaments');
    Route::get('appupdateinfo/{id}', 'gameController@appupdateinfo');
     Route::get('paymentmethods', 'gameController@paymentmethods');
    Route::post('paymentrequest/{id}', 'gameController@paymentrequest');

});

Route::group([
    'namespace' => 'App\Http\Controllers\API',
], function ($router) {
    Route::get('get_leaderboard','leaderboardController@leaderboard');
});
