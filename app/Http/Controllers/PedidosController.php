<?php

namespace App\Http\Controllers;

use App\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    //
    public function nuevos(){
        $pedidos_nuevos = Pedidos::where('status_notificacion',0)->count();
        return response()->json(['pedidos' => $pedidos_nuevos]);
    }

    public function show(){
        $pedidos = Pedidos::where('id', '>=', 0)->orderBy('status_notificacion')->orderBy('created_at', 'desc')->get();
        //DB::select('SELECT * FROM pedidos ORDER BY status_notificacion , created_at DESC');
        //Pedidos::all()->orderByAsc('status_notificacion')->orderByDesc('created_at');
        if ( count($pedidos) > 0 ) {
            $contenido = '<div class="table-responsive-lg">
                            <table class="table table-striped table-sm" id="tablaPedidos">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1 text-center">Fecha</th>
                                        <th class="col-sm-3 text-center">Cliente</th>
                                        <th class="col-sm-2 text-center">Direccion</th>
                                        <th class="col-sm-1 text-center">Telefono</th>
                                        <th class="col-sm-1 text-center">Entrega</th>
                                        <th class="col-sm-1 text-center">Estado</th>
                                        <th class="col-sm-2 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>';
            foreach ($pedidos as $pedido) {
                $contenido .= '<tr>
                                        <td class="text-center">'.$pedido->created_at.'</td>
                                        <td class="text-center">'.$pedido->nombre.' '.$pedido->apellidos.'</td>
                                        <td class="text-center">'.$pedido->calle.', '.$pedido->colonia.', '.$pedido->municipio.', cp '.$pedido->cp.'</td>
                                        <td class="text-center">'.$pedido->telefono.'</td>
                                        <td class="text-center">'.$pedido->fecha_entrega.' '.$pedido->horario->hora_in.':00-'.$pedido->horario->hora_fn.':00 </td>
                                        <td class="text-center">'.$pedido->status->nombre.'</td>
                                        <td class="text-center">';
                                        if($pedido->status->nombre == 'Confirmado'){
                                            $contenido .= '<button type="button" id="BAEC'.$pedido->id.'"  class="btn btn-outline-danger btn-sm"  onclick="PedidoEnCamino('.$pedido->id.')">
                                                <span class="spinner-border spinner-border-sm sBAEC'.$pedido->id.'" role="status" aria-hidden="true" style="display: none;"></span>
                                                Pedido en camino
                                            </button>';
                                        }elseif ($pedido->status->nombre == 'En camino') {
                                            $contenido .= '<button type="button" id="BAEC'.$pedido->id.'"  class="btn btn-outline-danger btn-sm"  onclick="PedidoEntregado('.$pedido->id.')">
                                                <span class="spinner-border spinner-border-sm sBAEC'.$pedido->id.'" role="status" aria-hidden="true" style="display: none;"></span>
                                                Pedido entregado
                                            </button>';
                                        }elseif ($pedido->status->nombre == 'Entregado') {
                                            $contenido .= '<label class="text-center">Entregado '.\Carbon\Carbon::parse($pedido->update_at)->format('d/m/Y').'</label>
                                            <button type="button" class="btn btn-outline-secondary btn-sm"  onclick="imagenPedido('.$pedido->id.',\''.$pedido->imagenentrega.'\')">Imagen</button>';
                                        }
                $contenido .=          '</td>
                                    </tr>';
            }
            $contenido .= '     </tbody>
                            </table>
                        </div>';
        }else{
            $contenido = '<div class="alert alert-warning" role="alert">No hay pedidos registrados</div>';
        }
        return response()->json([ 'contenido' => $contenido]);
    }

    public function leidos(){
        $pedidos = Pedidos::where('status_notificacion',0)->get();
        foreach ($pedidos as $pedido) {
            $pedido->update([
                'status_notificacion' => 1
            ]);
        }
    }

    public function encamino(Request $request){
        $pedido = Pedidos::find($request->id);
        $pedido->update([
            'statuspedido_id' => 2
        ]);
    }

    public function entregado(Request $request){
        if($request->hasFile('imagen_pe')){
            $imagen = $request->file('imagen_pe');
            $nuevoNombre = $request->id_pedido_f.'.'.$imagen->getClientOriginalExtension();
            $imagen->move(public_path('pedidos_entregados'), $nuevoNombre);

            $pedido = Pedidos::find($request->id_pedido_f);
            $pedido->update([
                'statuspedido_id' => 3,
                'imagenentrega' => $nuevoNombre
            ]);
            return response()->json([
                'mensaje' => 'Guarde la imagen revisa en la carpeta',
                'nombre_imagen' => $nuevoNombre
            ]);
        }else{
            return response()->json([
                'mensaje' => 'Algo salio mal'
            ]);
        }
    }
}
