<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Icono extends Model
{
	use SoftDeletes;
	
    protected $table = 'GEN_Icono';
    protected $primaryKey='ICON_Id';

    protected $fillable = [
        'ICON_Valor', 'ICON_Nombre'
    ];
}
