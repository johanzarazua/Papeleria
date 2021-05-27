<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuspedido extends Model
{
    //
    protected $table = 'statuspedido';

    protected $fillable = [
        'id',
        'nombre'
    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];
}
