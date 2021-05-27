<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table = 'empleado';

    protected $fillable = [
        'id',
        'nombre',
        'puesto_id',
        'estado',

    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];

    public function puesto(){
        return $this->belongsTo('App\Puesto');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id', 'empleado_id');
    }
}
