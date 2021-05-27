<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\Departamento;
use App\Colores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarioController extends Controller
{
    //
    public function show(){
        $inventario = Inventario::all();
        $botones = '<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#agregarProducto">Agregar producto</button>';
        if ( count($inventario) > 0 ) {
            
            $contenido = '<div class="table-responsive-lg">
                            <table class="table table-striped table-sm" id="tablaInventario">
                                <thead>
                                    <tr>
                                        <th class="col-sm-3 text-center">Descripcion</th>
                                        <th class="col-sm-1 text-center">Costo</th>
                                        <th class="col-sm-1 text-center">Venta</th>
                                        <th class="col-sm-1 text-center">Mayoreo</th>
                                        <th class="col-sm-1 text-center">Existencia</th>
                                        <th class="col-sm-2 text-center">Departamento</th>
                                        <th class="col-sm-3 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>';
            foreach ($inventario as $key => $producto) {
                    $contenido .= '<tr>
                                            <td class="text-center">'.$producto->descripcion.'</td>
                                            <td class="text-center">'.$producto->p_costo.'</td>
                                            <td class="text-center">'.$producto->p_venta.'</td>
                                            <td class="text-center">'.$producto->p_mayoreo.'</td>
                                            <td class="text-center">'.$producto->inventario.'</td>
                                            <td class="text-center">'.$producto->departamento->nombre.'</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="editarProducto('.$producto->id.',\''.$producto->descripcion.'\','.$producto->p_costo.','.$producto->p_venta.','.$producto->p_mayoreo.','.$producto->inventario.', '.$producto->inventario_min.' ,'.$producto->departamento->id.')">Editar</button>
                                                <button type="button" class="btn btn-outline-warning btn-sm"  onclick="imagenProducto('.$producto->id.',\''.$producto->imagen.'\')">Imagen</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm"  onclick="eliminarProducto('.$producto->id.')">Eliminar</button>';
                            if ($producto->colores == 1) {
                                $contenido .=   '<button type="button" class="btn btn-outline-secondary btn-sm"  onclick="verColores('.$producto->id.')">Colores</button>';
                            }                    
                        $contenido .=       '</td>
                                        </tr>';
            }
            $contenido .= '     </tbody>
                            </table>
                        </div>';
        }else{
            $contenido = '<div class="alert alert-warning" role="alert">No hay productos registrados</div>';
        }
        return response()->json([ 'contenido' => $contenido, 'botones' => $botones]);
    }

    public function crear(Request $request){

        $producto = Inventario::updateOrCreate([
            'descripcion' => $request->descripcion,
            'p_costo' => $request->p_costo,
            'p_venta' => $request->p_venta,
            'p_mayoreo' => $request->p_mayoreo,
            'inventario' => $request->existencia,
            'inventario_min' => $request->inventario_min,
            'departamento_id' => $request->departamento,
            'colores' => $request->colores,
        ]); 
        if ($producto->colores == 1) {
            return response()->json(['c' => 1, 'producto' => $producto->id]);
        }else{
            return response()->json(['c' => 0]);
        }  
    }

    public function colores(Request $request){
        if ($request->color) {
            Colores::create([
                'inventario_id' => $request->producto,
                'color_hexadecimal' => $request->color,
            ]);   
        }
        $colores = Colores::where('inventario_id', $request->producto)->get();
        if (count($colores) > 0) {
            $tabla = '<br><h6 class="text-center">Colores guardados</h6>
                      <div class="table-responsive">
                        <table class="table table-striped table-sm" id="colors_producto">
                            
                            <tbody>';
            foreach ($colores as $key => $color) {
                $tabla .= '     <tr>
                                    <td class="text-center col-5">
                                        <input type="color" disabled value="'.$color->color_hexadecimal.'">
                                    </td>
                                    <td class="text-center col-4">
                                        <button type="button" class="btn btn-outline-danger btn-sm"  onclick="eliminarColorProducto('.$color->id.')">Eliminar</button>
                                    </td>
                                </tr>';
            }
            $tabla .= '     </tbody>
                        </table>
                     </div>';
            
        }else{
            $tabla = 'no hay colores registrados';
        }
        return response()->json(['tabla' => $tabla]);
    }

    public function actualizar(Request $request){
        $producto = Inventario::find($request->id);
        $producto->update([
            'descripcion' => $request->descripcion,
            'p_costo' => $request->p_costo,
            'p_venta' => $request->p_venta,
            'p_mayoreo' => $request->p_mayoreo,
            'inventario' => $request->existencia,
            'inventario_min' => $request->inventario_min,
            'departamento_id' => $request->departamento,
        ]);
    }

    public function eliminar(Request $request){
        $producto = Inventario::find($request->id);
        
        if($producto->imagen != null){
            unlink(public_path('inv').'\\'.$producto->imagen);
        }

        $colores = Colores::where('inventario_id', $producto->id)->get();
        if (count($colores) > 0) {
            foreach ($colores as $key => $color) {
                $color->delete();
            }
        }
        $producto->delete();
    }

    public function subirImagen(Request $request){

        if($request->hasFile('imagen_p')){
            $imagen = $request->file('imagen_p');
            $nuevoNombre = $request->id_producto_f.'.'.$imagen->getClientOriginalExtension();
            $imagen->move(public_path('inv'), $nuevoNombre);
            

            $producto = Inventario::find($request->id_producto_f);
            $producto->update([
                'imagen' => $nuevoNombre,
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
