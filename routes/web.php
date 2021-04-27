<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaqueteriaController;
use App\Http\Controllers\SucursalesController;

use Illuminate\Http\Request;

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

// Auth::routes();
Auth::routes(['register' => false]);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route Components
Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
Route::get('layouts/boxed', [StaterkitController::class, 'layout_boxed'])->name('layout-boxed');
Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [StaterkitController::class, 'home'])->name('home');
    Route::get('home', [StaterkitController::class, 'home'])->name('home');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

Route::middleware('auth')->group(function() {
    Route::get('/sessions', function () {
        $sessions = DB::table('sessions')
            ->where('user_id', auth()->id())
            ->orderBy('last_activity', 'DESC')
            ->get();
        return view('sessions', ['sessions' => $sessions]);
    });
    Route::post('/delete-session', function(Request $request) {
        DB::table('sessions')
            ->where('id', $request->id)
            ->where('user_id', auth()->id())
            ->delete();
    });
});

Route::get('/paquetes', [PaqueteriaController::class, 'index'])->name('paquetes.index');

Route::get('/paquetes/create', [PaqueteriaController::class, 'create'])->name('paquetes.create');
Route::post('/paquetes', [PaqueteriaController::class, 'store'])->name('paquetes.store');

Route::get('/paquetes/{envio}', [PaqueteriaController::class, 'show'])->name('paquetes.show');
Route::get('/paquetes/{envio}/edit', [PaqueteriaController::class, 'edit'])->name('paquetes.edit');
Route::put('/paquetes/{remitente}{destinatario}{envio}', [PaqueteriaController::class, 'update'])->name('paquetes.update');
Route::get('/sucursales', [SucursalesController::class, 'index'])->name('sucursales.index');

Route::get('/sucursales/{sucursal}{edit}', [SucursalesController::class, 'show'])->name('sucursales.show');
Route::put('/sucursales/{sucursal}', [SucursalesController::class, 'update'])->name('sucursales.update');

Route::post('/sucursales', [SucursalesController::class, 'store'])->name('sucursales.store');
Route::delete('/sucursales/{sucursal}', [SucursalesController::class, 'destroy'])->name('sucursales.destroy');
