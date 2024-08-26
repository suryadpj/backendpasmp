<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OplController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\TradeInController;
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
Route::resource('katalog', CatalogController::class);
Route::post('katalog/updatenew', [CatalogController::class, 'updatenew'])->name('katalog.updatenew');
Route::resource('kendaraan', KendaraanController::class);
Route::post('kendaraan/updatenew', [KendaraanController::class, 'updatenew'])->name('kendaraan.updatenew');
Route::resource('material', MaterialController::class);
Route::post('material/updatenew', [MaterialController::class, 'updatenew'])->name('material.updatenew');
Route::resource('jasa', JasaController::class);
Route::post('jasa/updatenew', [JasaController::class, 'updatenew'])->name('jasa.updatenew');
Route::resource('part', PartController::class);
Route::post('part/updatenew', [PartController::class, 'updatenew'])->name('part.updatenew');
Route::resource('opl', OplController::class);
Route::post('opl/updatenew', [OplController::class, 'updatenew'])->name('opl.updatenew');
Route::resource('tradein', TradeInController::class);
Route::post('tradein/updatenew', [TradeInController::class, 'updatenew'])->name('tradein.updatenew');

Route::get('/linkstorage', function () {
    return Artisan::call('storage:link');
});



Auth::routes();

