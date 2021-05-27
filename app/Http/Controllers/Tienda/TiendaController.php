<?php

namespace App\Http\Controllers\Tienda;

use App\Inventario;
use App\Departamento;
use Cart;
use App\Http\Controllers\Controller;
use App\Pedidos;
use App\Horarioentrega;
use App\Orden;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    //
    public function papeleria(){
        $departamento = Departamento::where('nombre', 'Papeleria')->first();
        $inventario = Inventario::where('departamento_id', $departamento->id)->paginate(4);
        return view('tienda.papeleria', ['inventario' => $inventario]);
    }

    public function servicios(){
        $departamento = Departamento::where('nombre', 'Servicios')->first();
        $inventario = Inventario::where('departamento_id', $departamento->id)->get();
        return view('tienda.servicios', ['inventario' => $inventario]);
    }

    public function add(Request $request){
        $producto = Inventario::find($request->id);
        $precio = 0.00;
        $total = 0.00;
        $cantidad_registrada = 0;
        foreach(Cart::getContent() as $i => $item){
            if ($item->id == $producto->id ) {
                $cantidad_registrada = $item->quantity + $request->cantidad;
            }
        }
        
        if ($cantidad_registrada == 0) {
            $cantidad_registrada = $request->cantidad;
        }

        if ($cantidad_registrada >= 10) {
            $total = $producto->p_mayoreo * $cantidad_registrada;
            Cart::add(
                $producto->id,
                $producto->descripcion,
                $producto->p_mayoreo,
                $request->cantidad,
                array(
                    'url_foto' => $producto->imagen,
                    'total' => $total
                )
            );
        }else{
            $total = $producto->p_venta * $cantidad_registrada;
            Cart::add(
                $producto->id,
                $producto->descripcion,
                $producto->p_venta,
                $request->cantidad,
                array(
                    'url_foto' => $producto->imagen,
                    'total' => $total
                )
            );
        }
        return response()->json(["reload" => rand(1,800)]);
    }

    public function clear(){
        Cart::clear();
    }

    public function remove(Request $request){
        Cart::remove([
            'id' => $request->id
        ]);
    }

    public function actualizar_carrito(){
        echo view('tienda.carrito');
    }

    public function update(Request $request){
        $producto = Cart::get($request->id);
        $cantidad = $request->cantidad - $producto->quantity;
    
        $inventario = Inventario::find($producto->id);
        if ($inventario->inventario < $request->cantidad){
            return response()->json(['error' => true, 'mensaje' => 'No contamos con el inventario suficiente para cubrir la cantidad']);
        }else{
            Cart::update($request->id, array('quantity' => $cantidad));
            $producto = Cart::get($request->id);
            if ($producto->quantity >= 10) {
                $total = $inventario->p_mayoreo * $producto->quantity;
                Cart::update($request->id, array(
                    'price' => $inventario->p_mayoreo,
                    'attributes' => array(
                        'url_foto' => $inventario->imagen,
                        'total' => $total
                    )
                ));
            }else{
                $total = $inventario->p_venta * $producto->quantity;
                Cart::update($request->id, array(
                    'price' => $inventario->p_venta, 
                    'attributes' => array(
                        'url_foto' => $inventario->imagen,
                        'total' => $total
                    )
                ));
            }
            return response()->json(['error' => false]);
        }
    }

    public function checkout(){
        if (Cart::getSubTotal() < 200) {
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Costo de envio $30',
                'type' => 'shipping',
                'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
                'value' => '+30',
            ));
            Cart::condition($condition);
        }
        if(session()->has('status')){
            if(session()->has('pedido_id')){
                if(session()->has('pago')){
                    return view('tienda.checkout',['status' => session('status'), 'pedido_id' => session('pedido_id'), 'pago' => true]);
                }else{
                    return view('tienda.checkout',['status' => session('status'), 'pedido_id' => session('pedido_id')]);
                }
            }else{
                return view('tienda.checkout',['status' => session('status')]);
            }
        }else{
            return view('tienda.checkout');
        }
    }

    public function horarios_disponibles(Request $request){
        $pedidos = Pedidos::where('fecha_entrega', $request->fecha)->get();
        $horarios_ocupaddos = [];
        foreach ($pedidos as $pedido) {
            array_push($horarios_ocupaddos, $pedido->horariosentrega_id);
        }
        $horarios_disponibles = Horarioentrega::whereNotIn('id', $horarios_ocupaddos)->get();
        return response()->json(['horarios_disponibles' => $horarios_disponibles]);
    }

    public function pedido_finalizado(Request $request){
        foreach (Cart::getContent() as $item){
            Orden::create([
                'pedidos_id' => $request->pedido_id,
                'inventario_id' => $item->id,
                'cantidad' =>$item->quantity
            ]);

            $producto = Inventario::find($item->id);
            $producto->update(['inventario' => $producto->inventario - $item->quantity]);
        }
        $status = 'Su orden se creo correctamente.';
        Cart::clear();
        return redirect('/tienda/checkout')->with(['status'=>$status, 'pedido_id' => $request->pedido_id, 'pago' => true]);
    }
}
