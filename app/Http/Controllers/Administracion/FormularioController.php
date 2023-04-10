<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\FormularioElemento;
use App\Models\Elemento;
use App\Enums\FormularioTipos;
use App\Enums\ElementoTipos;
use Illuminate\Support\Str;
use Response;
use File;

class FormularioController extends Controller
{

    public function index(Request $request)
    {   
        return view('administracion.formulario.index', [
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
        return Elemento::get(['ELEM_Id', 'ELEM_Tipo', 'ELEM_ValorGeneral AS Valor']);
    }

    private function obtenerDatosFormularioAhorro()
    {
        return Elemento::get(['ELEM_Id', 'ELEM_Tipo', 'ELEM_ValorAhorro AS Valor']);
    }

    private function obtenerDatosFormularioCredito()
    {
        return Elemento::get(['ELEM_Id', 'ELEM_Tipo', 'ELEM_ValorCredito AS Valor']);
    }
    
    public function store(Request $request)
    {
        if($request->FORM_Id == FormularioTipos::GENERAL->label()):
            return $this->modificarDatosFormularioGeneral($request);
        elseif($request->FORM_Id == FormularioTipos::AHORROS->label()):
            return $this->modificarDatosFormularioAhorro($request);
        elseif($request->FORM_Id == FormularioTipos::CREDITOS->label()):
            return $this->modificarDatosFormularioCredito($request);
        else:
            return Response::json(false);
        endif;
    }

    private function modificarDatosFormularioGeneral(Request $request)
    {
        try{
            $imagen = $this->agregar_imagen($request->file('imagen'));

            Elemento::where('ELEM_Id',ElementoTipos::TITULO->label())
            ->update([
                'ELEM_ValorGeneral' => strtoupper($request['titulo'])
            ]);

            if($imagen)
            {
                File::delete((Elemento::select('ELEM_ValorGeneral')->where('ELEM_Id',ElementoTipos::IMAGENPORTADA->label())->first())->ELEM_ValorGeneral);
                Elemento::where('ELEM_Id',ElementoTipos::IMAGENPORTADA->label())
                ->update([
                    'ELEM_ValorGeneral' => $imagen
                ]);
            }

            return Response::json([
                'status' => true,
                'data' => 'OK'
            ], 200);
        } catch (\Exception $ex) {
            return Response::json([
                'status' => false,
                'data' => $ex->getMessage()
            ], 500);           
        }
    }

    private function modificarDatosFormularioAhorro(Request $request)
    {
        try{
            $imagen = $this->agregar_imagen($request->file('imagen'));

            Elemento::where('ELEM_Id',ElementoTipos::TITULO->label())
            ->update([
                'ELEM_ValorAhorro' => strtoupper($request['titulo'])
            ]);

            if($imagen)
            {
                File::delete((Elemento::select('ELEM_ValorAhorro')->where('ELEM_Id',ElementoTipos::IMAGENPORTADA->label())->first())->ELEM_ValorAhorro);
                Elemento::where('ELEM_Id',ElementoTipos::IMAGENPORTADA->label())
                ->update([
                    'ELEM_ValorAhorro' => $imagen
                ]);
            }

            return Response::json([
                'status' => true,
                'data' => 'OK'
            ], 200);
        } catch (\Exception $ex) {
            return Response::json([
                'status' => false,
                'data' => $ex->getMessage()
            ], 500);           
        }
    }

    private function modificarDatosFormularioCredito(Request $request)
    {
        try{
            $imagen = $this->agregar_imagen($request->file('imagen'));

            Elemento::where('ELEM_Id',ElementoTipos::TITULO->label())
            ->update([
                'ELEM_ValorCredito' => strtoupper($request['titulo'])
            ]);

            if($imagen)
            {
                File::delete((Elemento::select('ELEM_ValorCredito')->where('ELEM_Id',ElementoTipos::IMAGENPORTADA->label())->first())->ELEM_ValorCredito);
                Elemento::where('ELEM_Id',ElementoTipos::IMAGENPORTADA->label())
                ->update([
                    'ELEM_ValorCredito' => $imagen
                ]);
            }

            return Response::json([
                'status' => true,
                'data' => 'OK'
            ], 200);
        } catch (\Exception $ex) {
            return Response::json([
                'status' => false,
                'data' => $ex->getMessage()
            ], 500);           
        }
    }

    private function agregar_imagen($imagen){
        if($imagen)
        {
            $bandera = Str::random(12);
            $filename = $imagen->getClientOriginalName();
            $fileserver = $bandera.'_'.$filename;
            $imagen->move(public_path('portadas/'), htmlentities($fileserver));
            return 'portadas/'.$fileserver;
        }
        else
        {
            return false;
        }
    }
}