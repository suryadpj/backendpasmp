<?php

use App\Http\Controllers\VcardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

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
    return view('home');
})->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profil', [App\Http\Controllers\HomeController::class, 'profile'])->name('profil');
Route::post('/profil_save', [App\Http\Controllers\HomeController::class, 'profilesave'])->name('profilesave')->middleware('auth');
Route::get('/profile/{slug}', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile2/{slug}', [ProfileController::class, 'show2'])->name('profile2');

Route::resource('vcard', VcardController::class);
Route::post('vcard/updatenew', [VcardController::class, 'updatenew'])->name('vcard.updatenew');



Auth::routes();

