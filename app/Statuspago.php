<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuspago extends Model
{
    //
    protected $table = 'statuspago';

    protected $fillable = [
        'id',
        'nombre',

    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];
}
