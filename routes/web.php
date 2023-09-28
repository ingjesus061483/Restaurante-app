<?php

use App\Http\Controllers\CabanaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ExistenciaController;
use App\Http\Controllers\FacturaEncabezadoController;
use App\Http\Controllers\FormaPagoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImpresoraController;
use App\Http\Controllers\materiaprimaController;
use App\Http\Controllers\ObservacionController;
use App\Http\Controllers\OrdenDetalleController;
use App\Http\Controllers\OrdenEncabezadoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagoDetalleController;
use App\Http\Controllers\PreparacionController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

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

/*Route::get('/', function () {
    $data=['empresa_nombre'=>'los girasoles'];
    return view('Home.index',$data);
});*/
Route::resource('formapagos', FormaPagoController::class);
Route::resource('observaciones',ObservacionController::class);
Route::resource('impresoras',ImpresoraController::class);
Route::resource('pagos', PagoController::class);
Route::resource('pagodetalle',PagoDetalleController::class);
Route::resource('configuracion',ConfiguracionController::class);
Route::resource('categorias',CategoriaController::class);
Route::resource('unidad_medida',UnidadMedidaController::class);
Route::resource('materiaprimas',materiaprimaController::class);
Route::resource('existencias',ExistenciaController::class);
Route::resource("cabañas",CabanaController::class);
Route::resource("empleados",EmpleadoController::class);
Route::resource("roles",RoleController::class);
Route::resource("clientes",ClienteController::class);
Route::resource("empresas",EmpresaController::class);
Route::resource('ordenservicio',OrdenEncabezadoController::class);
Route::resource ('ingredientes', PreparacionController::class);
route::resource('facturacion',FacturaEncabezadoController::class);
//Route::get('ordendetalles/{id}',[OrdenDetalleController::class,'index']);
Route:: resource('ordendetalles',OrdenDetalleController::class);
Route::resource('impuestos', ImpuestoController::class);
Route::resource("usuarios",UserController::class);
Route::resource('productos',ProductosController::class);
Route::get('productos/cargarProductos/{search}',[ProductosController::class,'loadProduct']);
Route::get('productos/BuscarProductos/{id}',[ProductosController::class,'SearchProductById']);
Route::get('materiaprimas/cargarmateriaprima/{id}',[materiaprimaController::class,'LoadPrimaryMatter']);
Route::get('observaciones/GetObservacions/{codigo}',[ObservacionController::class,'GetObservacions']);
Route::get('clientes/showClient/{id}',[ClienteController::class,'showClient']);
Route::get('impuestos/calcularImpuestos/{subtotal}',[ImpuestoController::class,'CalcularImpuestos']);
Route::get('/',[HomeController::class,'index']);
Route::get('login',[LoginController::class,'show']);
Route::delete('login/{id}',[LoginController::class,'destroy']);
Route::post('login',[LoginController::class,'store']);
Route::get('reportes/printordenservicio/{id}',[ReportesController::class,'printOorenServicio']);
Route::get('reportes/printComanda/{id}',[ReportesController::class,'printComanda']);
Route::get('reportes/inventario',[ReportesController::class,'inventarioPdf']);
