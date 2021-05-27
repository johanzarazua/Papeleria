<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\User;
use App\Mail\EmpleadoNuevo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmpleadoController extends Controller
{
    //
    public function show(){
        $empleados = Empleado::all();
        $botones = '<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#registrarEmpleado">Agregar empleado</button>';
        $contenido = '<div class="table-responsive-lg">
                        <table class="table table-striped table-sm" id="tablaEmpleados">
                            <thead>
                                <tr>
                                    <th class="col-sm-1 text-center">#</th>
                                    <th class="col-sm-3 text-center">Nombre</th>
                                    <th class="col-sm-3 text-center">Correo</th>
                                    <th class="col-sm-2 text-center">Puesto</th>
                                    <th class="col-sm-1 text-center">Estado</th>
                                    <th class="col-sm-2 text-center"></th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($empleados as $key => $empleado) {
            if($empleado->estado == 'Activo'){
                $contenido .= '<tr>
                                    <td class="text-center">'.strval($key + 1).'</td>
                                    <td class="text-center">'.$empleado->nombre.'</td>
                                    <td class="text-center">'.$empleado->user->email.'</td>
                                    <td class="text-center">'.$empleado->puesto->nombre.'</td>
                                    <td class="text-center">'.$empleado->estado.'</td>
                                    <td class="text-center">
                                        <button type="button" id="BEE'.$empleado->id.'"  class="btn btn-outline-primary btn-sm" onclick="editarEmpleado('.$empleado->id.',\''.$empleado->nombre.'\','.$empleado->puesto->id.',\''.$empleado->user->email.'\')">Editar</button>
                                        <button type="button" id="BDE'.$empleado->id.'"  class="btn btn-outline-danger btn-sm"  onclick="despedirEmpleado('.$empleado->id.')">
                                            <span class="spinner-border spinner-border-sm sDE'.$empleado->id.'" role="status" aria-hidden="true" style="display: none;"></span>
                                            Despedir
                                        </button>
                                    </td>
                                </tr>';
            }else{
                $contenido .= '<tr>
                                    <td class="text-center">'.strval($key + 1).'</td>
                                    <td class="text-center">'.$empleado->nombre.'</td>
                                    <td class="text-center">'.$empleado->user->email.'</td>
                                    <td class="text-center">'.$empleado->puesto->nombre.'</td>
                                    <td class="text-center">'.$empleado->estado.'</td>
                                    <td class="text-center">
                                        <button type="button" id="BRE'.$empleado->id.'"  class="btn btn-outline-warning btn-sm" onclick="recuperarEmpleado('.$empleado->id.')">
                                            <span class="spinner-border spinner-border-sm sRE'.$empleado->id.'" role="status" aria-hidden="true" style="display: none;"></span>
                                            Recuperar
                                        </button>
                                        <button type="button" id="BBE'.$empleado->id.'"  class="btn btn-outline-danger btn-sm"  onclick="eliminarEmpleado('.$empleado->id.')">Eliminar</button>
                                    </td>
                                </tr>';
            }
                
        }

        $contenido .= '     </tbody>
                        </table>
                       </div>';

        return response()->json([ 'contenido' => $contenido, 'botones' => $botones]);
    }

    public function crear(Request $request){

        $password = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwvyz'),1,10);
        
        $empleado =  Empleado::Create([
            'nombre' => $request->nombre,
            'puesto_id' => $request->puesto 
        ]);
        $user = User::Create([
            'empleado_id' => $empleado->id,
            'email' => $request->correo,
            'password' => bcrypt($password),
        ]);

        if($empleado && $user){
            Mail::to($user->email)->send( new EmpleadoNuevo($user, $password) );
        }
    }

    public function editar(Request $request){
        $empleado = Empleado::find($request->id);
        $empleado->update([
            'nombre' => $request->nombre,
            'puesto_id' => $request->puesto
        ]);
        
        User::find($empleado->user->id)->update([
            'email' => $request->correo
        ]);
    }

    public function despedir(Request $request){
        Empleado::find($request->id)->update([
            'estado' => 'Baja'
        ]);
    }

    public function recuperar(Request $request){
        Empleado::find($request->id)->update([
            'estado' => 'Activo'
        ]);
    }

    public function eliminar(Request $request){
        $empleado = Empleado::find($request->id);
        User::find($empleado->user->id)->delete();
        $empleado->delete();
    }
}
