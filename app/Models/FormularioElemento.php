<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Elemento;

class FormularioElemento extends Model
{
    protected $table = 'GEN_FormularioElemento';
    public $timestamps = false;

    protected $fillable = [
        'FORM_Id', 'ELEM_Id'
    ];

    public function elemento()
    {
        return $this->hasOne(Elemento::class,'ELEM_Id','ELEM_Id');
    }
}
