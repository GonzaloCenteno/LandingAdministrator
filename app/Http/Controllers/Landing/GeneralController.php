<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\FormularioElemento;
use App\Models\Departamento;
use App\Models\Distrito;

class GeneralController extends Controller
{

    public function index(Request $request)
    {   
        return view('landing.general.index', [
            'datos' => $this->obtenerDatosLanding(),
            'departamentos' => $this->obtenerDepartamentos(),
            'portada' => $this->obtenerPortada()
        ]);
    }

    private function obtenerDatosLanding() {
        return FormularioElemento::with('elemento')->where('FORM_Id',1)->orderBy('ELEM_Id','asc')->get();
    }

    private function obtenerDepartamentos() {
        return Departamento::get();
    }

    private function obtenerPortada() {
        return FormularioElemento::with('elemento')
                ->where([['FORM_Id',1],['ELEM_Id',2]])->first();
    }

    public function show($id,Request $request)
    {
        return Distrito::get();
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