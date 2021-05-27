<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colores extends Model
{
    //
    protected $table = 'colores';

    protected $fillable = [
        'id',
        'inventario_id',
        'color_hexadecimal',
    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];
}
