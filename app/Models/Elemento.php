<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Elemento extends Model
{
	use SoftDeletes;
	
    protected $table = 'GEN_Elemento';
    protected $primaryKey='ELEM_Id';

    protected $fillable = [
        'ELEM_Nombre', 'ELEM_Tipo', 'ELEM_ValorAhorro', 'ELEM_ValorGeneral', 'ELEM_ValorCredito', 'ELEM_Icono'
    ];

    protected $appends = ['icono'];

    public function getIconoAttribute()
    {
        if($this->attributes['ELEM_Icono'] != null):
            return explode('/', $this->attributes['ELEM_Icono']);
        endif;
    }
}
