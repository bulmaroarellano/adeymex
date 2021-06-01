<?php

use App\Http\Controllers\CodigoPostalController;
use App\Http\Controllers\CotizarController;
use App\Http\Controllers\DestinatarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\EnvioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MensajeriaController;
use App\Http\Controllers\MercanciaController;
use App\Http\Controllers\MonedaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PaisController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RemitenteController;
use App\Http\Controllers\SepomexController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\SuministroController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UnidadMedidaController;
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
    // Route::get('/', [SucursalesController::class, 'index'])->name('sucursales.index');
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

//+ Catalogos

//-SUCURSALES 
Route::get('/sucursales', [SucursalesController::class, 'index'])->name('sucursales.index');
Route::get('/sucursales/list', [SucursalesController::class, 'getSucursales'])->name('sucursales.list');
Route::get('/sucursales-search', [SucursalesController::class, 'sucursalesSearch'])->name('sucursales.search');
Route::get('/sucursales-find', [SucursalesController::class, 'findSucursal'])->name('sucursales.find');
Route::get('/sucursales/{sucursal}{edit}', [SucursalesController::class, 'show'])->name('sucursales.show');
Route::put('/sucursales/{sucursal}', [SucursalesController::class, 'update'])->name('sucursales.update');
Route::post('/sucursales', [SucursalesController::class, 'store'])->name('sucursales.store');
Route::delete('/sucursales/{sucursal}', [SucursalesController::class, 'destroy'])->name('sucursales.destroy');

//-REMITENTES
Route::get('/remitentes', [RemitenteController::class, 'index'])->name('remitentes.index');
Route::get('/remitentes/list', [RemitenteController::class, 'getRemitentes'])->name('remitentes.list');
Route::get('/remitentes-search', [RemitenteController::class, 'remitentesSearch'])->name('remitentes.search');
Route::get('/remitentes-find', [RemitenteController::class, 'findRemitente'])->name('remitentes.search');
Route::get('/remitentes/{remitente}{edit}', [RemitenteController::class, 'show'])->name('remitentes.show');
Route::put('/remitentes/{remitente}', [RemitenteController::class, 'update'])->name('remitentes.update');
Route::post('/remitentes/', [RemitenteController::class, 'store'])->name('remitentes.store');
Route::delete('/remitentes/{remitente}', [RemitenteController::class, 'destroy'])->name('remitentes.destroy');

//-DESTINATARIO
Route::get('/destinatarios', [DestinatarioController::class, 'index'])->name('destinatarios.index');
Route::get('/destinatarios/list', [DestinatarioController::class, 'getDestinatarios'])->name('destinatarios.list');
Route::get('/destinatarios-search', [DestinatarioController::class, 'destinatariosSearch'])->name('destinatario.search');
Route::get('/destinatarios-find', [DestinatarioController::class, 'findDestinatario'])->name('destinatario.search');
Route::get('/destinatarios/{destinatario}{edit}', [DestinatarioController::class, 'show'])->name('destinatarios.show');
Route::put('/destinatarios/{destinatario}', [DestinatarioController::class, 'update'])->name('destinatarios.update');
Route::post('/destinatarios/', [DestinatarioController::class, 'store'])->name('destinatarios.store');
Route::delete('/destinatarios/{destinatario}', [DestinatarioController::class, 'destroy'])->name('destinatarios.destroy');

//-SUMINISTROS 
Route::get('/suministros', [SuministroController::class, 'index'])->name('suministros.index');
Route::get('/suministros/list', [SuministroController::class, 'getSuministros'])->name('suministros.list');
Route::get('/suministros/{suministro}{edit}', [SuministroController::class, 'show'])->name('suministros.show');
Route::put('/suministros/{suministro}', [SuministroController::class, 'update'])->name('suministros.update');
Route::post('/suministros/', [SuministroController::class, 'store'])->name('suministros.store');
Route::delete('/suministros/{suministro}', [SuministroController::class, 'destroy'])->name('suministros.destroy');

//-PAISES 
Route::get('/paises', [PaisController::class, 'index'])->name('paises.index');
Route::get('/paises/list', [PaisController::class, 'getPaises'])->name('paises.list');
Route::get('/paises-search', [PaisController::class, 'paisesSearch'])->name('paises.search');
Route::get('/paises/{pais}{edit}', [PaisController::class, 'show'])->name('paises.show');
Route::put('/paises/{pais}', [PaisController::class, 'update'])->name('paises.update');
Route::post('/paises/', [PaisController::class, 'store'])->name('paises.store');
Route::delete('/paises/{pais}', [PaisController::class, 'destroy'])->name('paises.destroy');

//-CODIGOS POSTALES 
Route::get('/codigospostales', [CodigoPostalController::class, 'index'])->name('codigosPostales.index');
Route::get('/codigospostales/list', [CodigoPostalController::class, 'getCodigosPostales'])->name('codigosPostales.list');
Route::get('/codigospostales/{codigoPostal}{edit}', [CodigoPostalController::class, 'show'])->name('codigosPostales.show');
Route::put('/codigospostales/{codigoPostal}', [CodigoPostalController::class, 'update'])->name('codigosPostales.update');
Route::post('/codigospostales/', [CodigoPostalController::class, 'store'])->name('codigosPostales.store');
Route::delete('/codigospostales/{codigoPostal}', [CodigoPostalController::class, 'destroy'])->name('codigosPostales.destroy');

// Route::get('/cupones', [SucursalesController::class, 'index'])->name('sucursales.index');

//-MERCANCIAS 
Route::get('/mercancias', [MercanciaController::class, 'index'])->name('mercancias.index');
Route::get('/mercancias/list', [MercanciaController::class, 'getMercancias'])->name('mercancias.list');
Route::get('/mercancias/{mercancia}{edit}', [MercanciaController::class, 'show'])->name('mercancias.show');
Route::put('/mercancias/{mercancia}', [MercanciaController::class, 'update'])->name('mercancias.update');
Route::post('/mercancias/', [MercanciaController::class, 'store'])->name('mercancias.store');
Route::delete('/mercancias/{mercancia}', [MercanciaController::class, 'destroy'])->name('mercancias.destroy');

//-MONEDAS
Route::get('/monedas', [MonedaController::class, 'index'])->name('monedas.index');
Route::get('/monedas/list', [MonedaController::class, 'getMonedas'])->name('monedas.list');
Route::get('/monedas-search', [MonedaController::class, 'monedasSearch'])->name('monedas.search');
Route::get('/monedas/{moneda}{edit}', [MonedaController::class, 'show'])->name('monedas.show');
Route::put('/monedas/{moneda}', [MonedaController::class, 'update'])->name('monedas.update');
Route::post('/monedas/', [MonedaController::class, 'store'])->name('monedas.store');
Route::delete('/monedas/{moneda}', [MonedaController::class, 'destroy'])->name('monedas.destroy');

//-MENSAJERIAS
Route::get('/mensajerias', [MensajeriaController::class, 'index'])->name('mensajerias.index');
Route::get('/mensajerias/{mensajeria}{edit}', [MensajeriaController::class, 'show'])->name('mensajerias.show');
Route::put('/mensajerias/{mensajeria}', [MensajeriaController::class, 'update'])->name('mensajerias.update');
Route::post('/mensajerias/', [MensajeriaController::class, 'store'])->name('mensajerias.store');
Route::delete('/mensajerias/{mensajeria}', [MensajeriaController::class, 'destroy'])->name('mensajerias.destroy');

//-UNIDADES DE MEDIDA 
Route::get('/unidadesmedidas', [UnidadController::class, 'index'])->name('unidades.index');
Route::get('/unidadesmedidas/list', [UnidadController::class, 'getUnidades'])->name('unidades.list');
Route::get('/unidades-search', [UnidadController::class, 'unidadesSearch'])->name('unidades.search');
Route::get('/unidadesmedidas/{unidadMedida}{edit}', [UnidadController::class, 'show'])->name('unidades.show');
Route::put('/unidadesmedidas/{unidadMedida}', [UnidadController::class, 'update'])->name('unidades.update');
Route::post('/unidadesmedidas/', [UnidadController::class, 'store'])->name('unidades.store');
Route::delete('/unidadesmedidas/{unidadMedida}', [UnidadController::class, 'destroy'])->name('unidades.destroy');

//-ENCARGADOS
Route::get('/encargados-search', [EncargadoController::class, 'encargadosSearch'])->name('encargados.search');
//-EMPRESAS
Route::get('/empresas-search', [EmpresaController::class, 'empresasSearch'])->name('empresas.search');

//-SEPOMEX
Route::get('/sepomex-search', [SepomexController::class, 'sepomexSearch'])->name('sepomex.search');

//-cotizacion
Route::get('/cotizacion', [CotizarController::class, 'getCotizacion'])->name('cotizar.cotizacion');

//- ENVIOS 
Route::get('/envio', [EnvioController::class, 'index'])->name('envios.index');
Route::get('/envio-paqueteria', [EnvioController::class, 'selecPaqueteria'])->name('envios.paqueteria');
Route::get('/envios', [EnvioController::class, 'listEnvios'])->name('envios.lista');
Route::get('/envios/list', [EnvioController::class, 'getEnvios'])->name('envios.list');
Route::get('/envios-search-cp', [EnvioController::class, 'getCodigosPostales'])->name('envios.postales');
Route::get('/envios/{envio}{edit}', [EnvioController::class, 'show'])->name('envios.show');
Route::put('/envios/{envio}', [EnvioController::class, 'update'])->name('envios.update');
Route::post('/envios', [EnvioController::class, 'store'])->name('envios.store');
Route::delete('/envios/{envio}', [EnvioController::class, 'destroy'])->name('envios.destroy');

// PAGOS 
Route::get('/pago', [PagoController::class, 'index'])->name('pagos.index');
Route::get('/pagos/{pago}{edit}', [PagoController::class, 'show'])->name('pagos.show');
Route::put('/pagos/{pago}', [PagoController::class, 'update'])->name('pagos.update');
Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::delete('/pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');