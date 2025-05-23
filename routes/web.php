<?php

use App\Http\Controllers\CabanaController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CajaMovimientoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\CuentasCobrarController;
use App\Http\Controllers\CuentasCobrarDetallesController;
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
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProveedorController;
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

/*Route::get('/', function () {
    $data=['empresa_nombre'=>'los girasoles'];
    return view('Home.index',$data);
});*/
Route::resource('movimientocaja',CajaMovimientoController::class);
Route::resource('cajas',CajaController::class);
Route::resource('formapagos', FormaPagoController::class);
Route::resource('observaciones',ObservacionController::class);
Route::patch('ordenservicio/MoveTableByOrder/{id}',[OrdenEncabezadoController::class,'MoveTableByOrder']);

//Route::resource('impresoras',ImpresoraController::class);
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
//Route::resource("proveedores",ProveedorController::class);
Route::resource("empresas",EmpresaController::class);
Route::resource('ordenservicio',OrdenEncabezadoController::class);
Route::resource ('ingredientes', PreparacionController::class);
route::resource('facturacion',FacturaEncabezadoController::class);
//Route::get('ordendetalles/{id}',[OrdenDetalleController::class,'index']);
Route:: resource('ordendetalles',OrdenDetalleController::class);
Route::resource('impuestos', ImpuestoController::class);
Route::resource("usuarios",UserController::class);
Route::resource('productos',ProductosController::class);
Route::resource('cuentascobrar',CuentasCobrarController::class);
Route::resource('detallecuentascobrar',CuentasCobrarDetallesController::class);
Route::get('clientes/GetClientes/{cliente}',[ClienteController::class,'GetClientes']);
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
Route::get('file/propinasByEmpleado',[FileController::class,'PropinasByEmpleado']);
Route::get('file/ventasbycabaña',[FileController::class,'VentasByMesas']);
Route::get('file/inventario',[FileController::class,'inventario']);
Route::get('file/OrdenesByFecha',[FileController::class,'OrdenesByFecha']);
Route::get('file/ProductosVendidosByFecha',[FileController::class,'ProductosVendidosByFecha']);
Route::get('file/OrdenServicio/{id}',[FileController::class,'OrdenServicio']);
Route::get('file/MostrarExistenciaPorProducto/{id}',[FileController::class,'MostrarExistenciaPorProducto']);
Route::get('impresoras', [PrinterController::class,'index']);
Route::post('impresoras', [PrinterController::class,'store']);
Route::patch('impresoras/{id}', [PrinterController::class,'update']);
Route::delete('impresoras/{id}', [PrinterController::class,'destroy']);
Route::get('impresoras/create', [PrinterController::class,'create']);
Route::get('impresoras/{id}/edit', [PrinterController::class,'edit']);
Route::get('reportes/printComandaSesion/{id}', [PrinterController::class,'ComandaSesion']);
Route::get('reportes/printordenservicio/{id}',[PrinterController::class,'OrdenServicio']);
Route::get('reportes/printComanda/{id}',[PrinterController::class,'Comanda']);