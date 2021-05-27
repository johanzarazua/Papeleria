<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarioentrega extends Model
{
    //
    protected $table = 'horariosentrega';

    protected $fillable = [
        'id',
        'hora_in',
        'hora_fn'
    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];
}
