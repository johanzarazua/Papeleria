<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    //
    protected $table = 'puestos';

    protected $fillable = [
        'id',
        'nombre',
    ];

    public function empleados(){
        return $this->hasMany('App\Empleado');
    }
}
