<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $table = 'departamento';

    protected $fillable = [
        'id',
        'nombre',
    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];

    public function inventario(){
        return $this->hasMany('App\Inventario');
    }
}
