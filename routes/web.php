<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('Dashboard/')
    ->middleware(['auth'])
    ->group(function ($router) {
        Route::get('/',[App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
    });
// webConfig
include('webIncludes/webConfig.php');
// user
include('webIncludes/user.php');
// admin
include('webIncludes/admin.php');
//role
include('webIncludes/role.php');
//game
include('webIncludes/game.php');
//tournment
include('webIncludes/tournament.php');
//withdrawalHistory
include('webIncludes/withdrawalHistory.php');
//withdrawalRequest
include('webIncludes/withdrawalRequest.php');
//post
include('webIncludes/post.php');
//lottery
include('webIncludes/lottery.php');
//lottery
include('webIncludes/leaderboard.php');
// game users
include ("webIncludes/listeduser.php");
