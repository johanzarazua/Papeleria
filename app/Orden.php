<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    //
    protected $table = 'orden';

    protected $fillable = [
        'id',
        'pedidos_id',
        'inventario_id',
        'colores_id',
        'cantidad'
    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];

    public function pedido(){
        return $this->belongsTo('App\Pedidos');
    }

    public function color(){
        return $this->belongsTo('App\Colores');
    }
}
