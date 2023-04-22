<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\FormularioElemento;
use App\Models\Formulario;
use Carbon\Carbon;
use Response;

class LandingController extends Controller
{
    public function index(Request $request)
    {   
        return view('administracion.landing.index', [
            'formularios' => $this->obtenerTipoFormulario()
        ]);
    }

    private function obtenerTipoFormulario() {
        return Formulario::get();
    }

    public function show($valor,Request $request)
    {
        if($valor == 1):
            return $this->obtenerDatosFormularioGeneral();
        elseif($valor == 2):
            return $this->obtenerDatosFormularioAhorro();
        elseif($valor == 3):
            return $this->obtenerDatosFormularioCredito();
        else:
            return Response::json(false);
        endif;
    }

    private function obtenerDatosFormularioGeneral()
    {
        return DB::select('SELECT 
            FOEL.FORM_Id,
            ELEM.ELEM_Id, 
            ELEM.ELEM_Tipo,
            ELEM_Nombre,
            ELEM.ELEM_ValorGeneral AS Valor,
            ELEM.ELEM_ValorCampo,
            ELEM.ELEM_Icono,
            ELEM.ELEM_ValorAuxiliar,
            CASE WHEN FOEL.FORM_Id IS NULL THEN 0 ELSE 1 END AS TipoActivacion 
        FROM gen_elemento ELEM
        LEFT OUTER JOIN gen_formularioelemento FOEL ON FOEL.ELEM_Id = ELEM.ELEM_Id AND FOEL.FORM_Id = :formulario
        ORDER BY ELEM.ELEM_Id ASC', [ 'formulario' => 1 ]);
    }

    private function obtenerDatosFormularioAhorro()
    {
        return DB::select('SELECT 
            FOEL.FORM_Id,
            ELEM.ELEM_Id, 
            ELEM.ELEM_Tipo,
            ELEM_Nombre,
            ELEM.ELEM_ValorAhorro AS Valor,
            ELEM.ELEM_ValorCampo,
            ELEM.ELEM_Icono,
            ELEM.ELEM_ValorAuxiliar,
            CASE WHEN FOEL.FORM_Id IS NULL THEN 0 ELSE 1 END AS TipoActivacion 
        FROM gen_elemento ELEM
        LEFT OUTER JOIN gen_formularioelemento FOEL ON FOEL.ELEM_Id = ELEM.ELEM_Id AND FOEL.FORM_Id = :formulario
        ORDER BY ELEM.ELEM_Id ASC', [ 'formulario' => 2 ]);
    }

    private function obtenerDatosFormularioCredito()
    {
        return DB::select('SELECT 
            FOEL.FORM_Id,
            ELEM.ELEM_Id, 
            ELEM.ELEM_Tipo,
            ELEM_Nombre,
            ELEM.ELEM_ValorCredito AS Valor,
            ELEM.ELEM_ValorCampo,
            ELEM.ELEM_Icono,
            ELEM.ELEM_ValorAuxiliar,
            CASE WHEN FOEL.FORM_Id IS NULL THEN 0 ELSE 1 END AS TipoActivacion 
        FROM gen_elemento ELEM
        LEFT OUTER JOIN gen_formularioelemento FOEL ON FOEL.ELEM_Id = ELEM.ELEM_Id AND FOEL.FORM_Id = :formulario
        ORDER BY ELEM.ELEM_Id ASC', [ 'formulario' => 3 ]);
    }
    
    public function store(Request $request)
    {
        try{
            $data = FormularioElemento::create($request->all());
            return Response::json([
                'status' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $ex) {
            return Response::json([
                'status' => false,
                'data' => $ex->getMessage()
            ], 500);           
        }
    }
    
    public function destroy($id,Request $request)
    {
        try{
            $data = FormularioElemento::where([['FORM_Id',$request['FORM_Id']],['ELEM_Id',$request['ELEM_Id']]])->delete();
            return Response::json([
                'status' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $ex) {
            return Response::json([
                'status' => false,
                'data' => $ex->getMessage()
            ], 500);                 
        }
    }
}