<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\PaqueteriaController;
use App\Http\Controllers\SucursalesController;

// Main Page Route
// Route::get('/', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');
Route::get('/', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce');

Auth::routes(['verify' => true]);

/* Route Dashboards */
Route::group(['prefix' => 'dashboard'], function () {
  Route::get('analytics', [DashboardController::class,'dashboardAnalytics'])->name('dashboard-analytics');
  Route::get('ecommerce', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce');
});
/* Route Dashboards */

/* Route Apps */
Route::group(['prefix' => 'app'], function () {
  Route::get('file-manager', [AppsController::class,'file_manager'])->name('app-file-manager');
});

/* Route Tables */
Route::group(['prefix' => 'table'], function () {
  Route::get('', [TableController::class,'table'])->name('table');
  Route::get('datatable/basic', [TableController::class,'datatable_basic'])->name('datatable-basic');
  Route::get('datatable/advance', [TableController::class,'datatable_advance'])->name('datatable-advance');
  Route::get('ag-grid', [TableController::class,'ag_grid'])->name('ag-grid');
});
/* Route Tables */

Route::get('/error', [MiscellaneousController::class,'error'])->name('error');

/* Route Authentication Pages */
Route::group(['prefix' => 'auth'], function () {
  Route::get('login-v1', [AuthenticationController::class,'login_v1'])->name('auth-login-v1');
  Route::get('login-v2', [AuthenticationController::class,'login_v2'])->name('auth-login-v2');
  Route::get('register-v1', [AuthenticationController::class,'register_v1'])->name('auth-register-v1');
  Route::get('register-v2', [AuthenticationController::class,'register_v2'])->name('auth-register-v2');
  Route::get('forgot-password-v1', [AuthenticationController::class,'forgot_password_v1'])->name('auth-forgot-password-v1');
  Route::get('forgot-password-v2', [AuthenticationController::class,'forgot_password_v2'])->name('auth-forgot-password-v2');
  Route::get('reset-password-v1', [AuthenticationController::class,'reset_password_v1'])->name('auth-reset-password-v1');
  Route::get('reset-password-v2', [AuthenticationController::class,'reset_password_v2'])->name('auth-reset-password-v2');
  Route::get('lock-screen', [AuthenticationController::class,'lock_screen'])->name('auth-lock_screen');
});
/* Route Authentication Pages */

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

//+ Mis rutas 
// Route::resource('paquetes', PaqueteriaController::class);

Route::get('/paquetes', [PaqueteriaController::class, 'index'])->name('paquetes.index');

Route::get('/paquetes/create', [PaqueteriaController::class, 'create'])->name('paquetes.create');
Route::post('/paquetes', [PaqueteriaController::class, 'store'])->name('paquetes.store');

Route::get('/paquetes/{envio}', [PaqueteriaController::class, 'show'])->name('paquetes.show');
Route::get('/paquetes/{envio}/edit', [PaqueteriaController::class, 'edit'])->name('paquetes.edit');
Route::put('/paquetes/{remitente}{destinatario}{envio}', [PaqueteriaController::class, 'update'])->name('paquetes.update');

Route::delete('/productos/{envio}', [PaqueteriaController::class, 'destroy'])->name('paquetes.destroy'); 


//* GET paquetes , alias = paquetes.index    
//* POST paquetes , alias = paquetes.store
//* GET paquetes/create , alias = paquetes.create
//* GET paquetes/{paquete} , alias = paquetes.show 
//* PUT paquetes/{paquete} , alias = paquetes.update 
//* DELETE paquetes/{paquete} , alias = paquetes.destroy
//* GET paquetes/{paquete}/edit , alias = paquetes.edit

//+ Catalogos
Route::get('/sucursales', [SucursalesController::class, 'index'])->name('sucursales.index');

Route::get('/sucursales/{sucursal}{edit}', [SucursalesController::class, 'show'])->name('sucursales.show');
Route::put('/sucursales/{sucursal}', [SucursalesController::class, 'update'])->name('sucursales.update');

Route::post('/sucursales', [SucursalesController::class, 'store'])->name('sucursales.store');
Route::delete('/sucursales/{sucursal}', [SucursalesController::class, 'destroy'])->name('sucursales.destroy');



// Route::get('/remitentes', [SucursalesController::class, 'index'])->name('sucursales.index');

// Route::get('/destinatarios', [SucursalesController::class, 'index'])->name('sucursales.index');
// Route::get('/suministros', [SucursalesController::class, 'index'])->name('sucursales.index');
// Route::get('/cupones', [SucursalesController::class, 'index'])->name('sucursales.index');
// Route::get('/paises', [SucursalesController::class, 'index'])->name('sucursales.index');

// Route::get('/codigo-postal', [SucursalesController::class, 'index'])->name('sucursales.index');
// Route::get('/mercancias', [SucursalesController::class, 'index'])->name('sucursales.index');
// Route::get('/monedas', [SucursalesController::class, 'index'])->name('sucursales.index');
// Route::get('/mensajerias', [SucursalesController::class, 'index'])->name('sucursales.index');
// Route::get('/unidades-medida', [SucursalesController::class, 'index'])->name('sucursales.index');


