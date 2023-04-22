<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $table = 'GEN_Formulario';
    protected $primaryKey='FORM_Id';

    protected $fillable = [
        'FORM_Nombre'
    ];
}
