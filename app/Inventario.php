<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    //
    protected $table = 'inventario';

    protected $fillable = [
        'id',
        'descripcion',
        'p_costo',
        'p_venta',
        'p_mayoreo',
        'inventario',
        'inventario_min',
        //'categoria_id',
        'colores',
        'departamento_id',
        'imagen'
    ];

    protected $hidden = [
        'created_at', 'update_at',
    ];

    public function departamento(){
        return $this->belongsTo('App\Departamento');
    }

    /*public function categoria(){
        return $this->belongsTo('App\Categorias');
    }*/
}
