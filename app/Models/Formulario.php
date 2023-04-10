<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formulario extends Model
{
	use SoftDeletes;
	
    protected $table = 'GEN_Formulario';
    protected $primaryKey='FORM_Id';

    protected $fillable = [
        'FORM_Nombre'
    ];
}
