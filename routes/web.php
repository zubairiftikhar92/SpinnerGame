<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SpinerGamaController;
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
    return view('welcome');
});

Route::post('spinner-game-registeration' , [SpinerGamaController::class , 'spinerGameRegisteration'])->name('spinner-game-registeration');
Route::get('spinner-game-login' , [SpinerGamaController::class , 'spinerGameLoginView'])->name('spinner-game-login');
Route::post('spinner-game-login-store' , [SpinerGamaController::class , 'spinerGameLoginStore'])->name('spinner-game-login-store');
Route::get('spinner-game' , [SpinerGamaController::class , 'spinerGame'])->name('spinner-game');
Route::post('spinner-game-reward' , [SpinerGamaController::class , 'spinnerGameReward'])->name('spinner-game-reward');
Route::post('verify-user-already-spinned' , [SpinerGamaController::class , 'verifyUserAlreadySpinned'])->name('verify-user-already-spinned');
// Route::get('social-media-rewards' , [SpinerGamaController::class , 'socialMediaRewards'])->name('social-media-rewards');
Route::post('social-media-rewards' , [SpinerGamaController::class , 'socialMediaRewards'])->name('social-media-rewards');
Route::post('add-wallet-address' , [SpinerGamaController::class , 'addWalletAddress'])->name('add-wallet-address');
