<?php

namespace App\Http\Controllers\Tienda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedidos;
use App\Horarioentrega;
use Darryldecode\Cart\Cart as CartCart;
use App\Inventario;
use App\Departamento;
use Cart;
use App\Orden;

class PedidoController extends Controller
{
    //
    public function crear(Request $request){
        $pedido = Pedidos::create([
            'nombre'            =>$request->nombre,
            'apellidos'         =>$request->apellidos,
            'correo'            =>$request->email,
            'telefono'          =>$request->telefono,
            'calle'             =>$request->direccion,
            'colonia'           =>$request->colonia,
            'municipio'         =>$request->municipio,
            'estado'            =>$request->estado,
            'cp'                =>$request->cp,
            'fecha_entrega'     =>$request->dia_entrega,
            'horariosentrega_id'=>$request->hora_entrega,
            'comentarios'       =>$request->comments,
        ]);

        if($pedido){
            /*foreach (Cart::getContent() as $item){
                Orden::create([
                    'pedidos_id' => $pedido->id,
                    'inventario_id' => $item->id,
                    'cantidad' =>$item->quantity
                ]);
            }*/
            return response()->json(['success'=>true, 'p_id' => $pedido->id]);
        }else{
            return response()->json(['success'=>false]);
        }
    }

    public function eliminar(Request $request){
        $pedido = Pedidos::find($request->pedido_id);
        $pedido->delete();
    }
}
