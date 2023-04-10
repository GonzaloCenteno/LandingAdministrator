<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\FormularioElemento;
use App\Enums\FormularioTipos;
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
        return FormularioTipos::cases();
    }

    public function show($valor,Request $request)
    {
        if($valor == FormularioTipos::GENERAL->label()):
            return $this->obtenerDatosFormularioGeneral();
        elseif($valor == FormularioTipos::AHORROS->label()):
            return $this->obtenerDatosFormularioAhorro();
        elseif($valor == FormularioTipos::CREDITOS->label()):
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
        ORDER BY ELEM.ELEM_Id ASC', [ 'formulario' => FormularioTipos::GENERAL->label() ]);
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
        ORDER BY ELEM.ELEM_Id ASC', [ 'formulario' => FormularioTipos::AHORROS->label() ]);
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
        ORDER BY ELEM.ELEM_Id ASC', [ 'formulario' => FormularioTipos::CREDITOS->label() ]);
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