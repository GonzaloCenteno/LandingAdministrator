<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
	use SoftDeletes;
	
    protected $table = 'GEN_Departamento';
    protected $primaryKey='DEPA_Id';

    protected $fillable = [
        'DEPA_Valor', 'DEPA_Nombre'
    ];
}
