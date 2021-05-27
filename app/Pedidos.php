<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    //
    protected $table = 'pedidos';

    protected $fillable = [
        'id',
        'nombre',
        'apellidos',
        'correo',
        'telefono',
        'calle',
        'colonia',
        'municipio',
        'estado',
        'cp',
        'fecha_entrega',
        'horariosentrega_id',
        'comentarios',
        'statuspedido_id',
        'statuspago_id',
        'status_notificacion',
        'imagenentrega',
        'created_at',
        'update_at',

    ];

    /*protected $hidden = [
        'created_at', 'update_at',
    ];*/

    public function orden(){
        return $this->hasMany('App\Orden');
    }

    public function status(){
        return $this->belongsTo('App\Statuspedido','statuspedido_id' );
    }

    public function horario(){
        return $this->belongsTo('App\Horarioentrega', 'horariosentrega_id');
    }

    public function statuspago(){
        return $this->belongsTo('App\Statuspago','statuspago_id' );
    }
}
