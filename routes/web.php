<?php

use App\Http\Controllers\ElectionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(
    [
        'as' => 'election_commission_officer.',
        'prefix' => 'election_commission_officer',
    ],
    function () {
        Route::post('elections/update', [ElectionController::class, 'update'])->name('elections.update');
    }
);
