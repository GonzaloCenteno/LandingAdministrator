<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Departamento;

class Distrito extends Model
{
	use SoftDeletes;
	
    protected $table = 'GEN_Distrito';
    protected $primaryKey='DIST_Id';

    protected $fillable = [
        'DIST_Valor', 'DIST_Nombre', 'DEPA_Id'
    ];

    public function departamento()
    {
        return $this->hasOne(Departamento::class,'DEPA_Id','DEPA_Id');
    }
}
