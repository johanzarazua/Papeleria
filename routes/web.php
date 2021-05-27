<?php

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

//Parte administrativa//
/*Route::get('/login', function () {
    return redirect()->route('login');
});*/

Route::get('/login', function () {
	if(Auth::check()){
    	return redirect('/dashboard');
	}else{
		return redirect()->route('login');
	}
})->name('home');


Auth::routes();

Route::get('/dashboard', 'HomeController@index');

//Empleado
Route::get('/empleados', 'EmpleadoController@show')->name('empleados');
Route::post('/empleado_crear', 'EmpleadoController@crear')->name('empleado.crear');
Route::post('/empleado_editar', 'EmpleadoController@editar')->name('empleado.editar');
Route::post('/empleado_despedir', 'EmpleadoController@despedir')->name('empleado.despedir');
Route::post('/empleado_recuperar', 'EmpleadoController@recuperar')->name('empleado.recuperar');
Route::post('/empleado_eliminar', 'EmpleadoController@eliminar')->name('empleado.eliminar');

//Inventario
Route::get('/inventario', 'InventarioController@show')->name('inventario');
Route::post('/inventario_crear', 'InventarioController@crear')->name('inventario.crear');
Route::post('/inventario_actualizar', 'InventarioController@actualizar')->name('inventario.actualizar');
Route::post('/inventario_eliminar', 'InventarioController@eliminar')->name('inventario.eliminar');
Route::post('/inventario/imagen_subir', 'InventarioController@subirImagen')->name('inventario.subir.imagen');
Route::post('/inventario/colores', 'InventarioController@colores')->name('inventario.colores.productos');

//Pedidos
Route::get('/pedidos', 'PedidosController@show')->name('pedidos');
Route::get('/pedidos_nuevos', 'PedidosController@nuevos')->name('pedidos.nuevos');
Route::get('/pedidos_leidos', 'PedidosController@leidos')->name('pedidos.leidos');
Route::post('/pedido_en_cammino', 'PedidosController@encamino')->name('pedido.encamino');
Route::post('/pedido_entregado', 'PedidosController@entregado')->name('pedido.entregado');

//parte tienda
Route::view('/', 'index')->name('tienda_home');
Route::get('/tienda/papeleria', 'Tienda\TiendaController@papeleria')->name('tienda_papeleria');
Route::get('/tienda/servicios', 'Tienda\TiendaController@servicios')->name('tienda_servicios');

//Carrito
Route::post('/add_cart', 'Tienda\TiendaController@add')->name('cart_add');
Route::get('/clear_cart', 'Tienda\TiendaController@clear')->name('cart_clear');
Route::post('/remove_item', 'Tienda\TiendaController@remove')->name('cart_remove');
Route::post('/update_item', 'Tienda\TiendaController@update')->name('cart_remove');
Route::get('/actualizar_carrito', 'Tienda\TiendaController@actualizar_carrito')->name('cart_actualizar_carrito');
Route::get('/tienda/checkout', 'Tienda\TiendaController@checkout')->name('confirmar_compra');
Route::post('/horarios_disponibles', 'Tienda\TiendaController@horarios_disponibles')->name('horarios_disponibles');
Route::get('/tienda/finalizado/{pedido_id}', 'Tienda\TiendaController@pedido_finalizado')->name('finalizar_pedido');

//Pedidos Tienda
Route::post('/pedido/crear', 'Tienda\PedidoController@crear')->name('crear_pedidos');
Route::get('/pedidos/eliminar/{pedido_id}', 'Tienda\PedidoController@eliminar')->name('eliminar_pedido');

//PayPal
Route::get('/paypal/pay/{pedido_id}', 'PaymentController@payWithPayPal');
Route::get('/paypal/status/{pedido_id}', 'PaymentController@payPalStatus');