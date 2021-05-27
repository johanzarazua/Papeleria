<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    //
    protected $table = 'pago';

    protected $fillable = [
        'id',
        'pedidos_id',
        'monto',
        'tipo_pago',
        'id_PayPal',
        'status_PayPal',
        'payerId_PayPal',
    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];

    public function pedido(){
        return $this->belongsTo('App\Pedidos');
    }


}
