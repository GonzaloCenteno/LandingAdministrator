<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\FormularioElemento;
use App\Models\Departamento;
use App\Enums\FormularioTipos;
use App\Enums\ElementoTipos;

class AhorrosController extends Controller
{

    public function index(Request $request)
    {   
        return view('landing.ahorros.index', [
            'datos' => $this->obtenerDatosLanding(),
            'departamentos' => $this->obtenerDepartamentos(),
            'portada' => $this->obtenerPortada()
        ]);
    }

    private function obtenerDatosLanding() {
        return FormularioElemento::with('elemento')->where('FORM_Id',FormularioTipos::AHORROS->label())->orderBy('ELEM_Id','asc')->get();
    }

    private function obtenerDepartamentos() {
        return Departamento::get();
    }

    private function obtenerPortada() {
        return FormularioElemento::with('elemento')->where([['FORM_Id',FormularioTipos::AHORROS->label()],['ELEM_Id',ElementoTipos::IMAGENPORTADA->label()]])->first();
    }

    public function show($id,Request $request)
    {
       
    }
    
    public function store(Request $request)
    {
           
    }
    
    public function create(Request $request)
    {
        
    }
    
    public function edit($id ,Request $request)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
      
    }
}