<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Formulario;
use App\Models\Elemento;
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
        if($request->FORM_Id == 1):
            return $this->modificarDatosFormularioGeneral($request);
        elseif($request->FORM_Id == 2):
            return $this->modificarDatosFormularioAhorro($request);
        elseif($request->FORM_Id == 3):
            return $this->modificarDatosFormularioCredito($request);
        else:
            return Response::json(false);
        endif;
    }

    private function modificarDatosFormularioGeneral(Request $request)
    {
        try{
            $imagen = $this->agregar_imagen($request->file('imagen'));

            Elemento::where('ELEM_Id',1)
            ->update([
                'ELEM_ValorGeneral' => $request['titulo']
            ]);

            Elemento::where('ELEM_Id',3)
            ->update([
                'ELEM_ValorGeneral' => $request['dni']
            ]);

            Elemento::where('ELEM_Id',4)
            ->update([
                'ELEM_ValorGeneral' => $request['correoElectronico']
            ]);

            Elemento::where('ELEM_Id',5)
            ->update([
                'ELEM_ValorGeneral' => $request['numeroCelular']
            ]);

            Elemento::where('ELEM_Id',6)
            ->update([
                'ELEM_ValorGeneral' => $request['nombrePersona']
            ]);

            Elemento::where('ELEM_Id',7)
            ->update([
                'ELEM_ValorGeneral' => $request['textoAdicional']
            ]);

            if($imagen)
            {
                File::delete((Elemento::select('ELEM_ValorGeneral')->where('ELEM_Id',2)->first())->ELEM_ValorGeneral);
                Elemento::where('ELEM_Id',2)
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

            Elemento::where('ELEM_Id',1)
            ->update([
                'ELEM_ValorAhorro' => $request['titulo']
            ]);

            Elemento::where('ELEM_Id',3)
            ->update([
                'ELEM_ValorAhorro' => $request['dni']
            ]);

            Elemento::where('ELEM_Id',4)
            ->update([
                'ELEM_ValorAhorro' => $request['correoElectronico']
            ]);

            Elemento::where('ELEM_Id',5)
            ->update([
                'ELEM_ValorAhorro' => $request['numeroCelular']
            ]);

            Elemento::where('ELEM_Id',6)
            ->update([
                'ELEM_ValorAhorro' => $request['nombrePersona']
            ]);

            Elemento::where('ELEM_Id',7)
            ->update([
                'ELEM_ValorAhorro' => $request['textoAdicional']
            ]);

            if($imagen)
            {
                File::delete((Elemento::select('ELEM_ValorAhorro')->where('ELEM_Id',2)->first())->ELEM_ValorAhorro);
                Elemento::where('ELEM_Id',2)
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

            Elemento::where('ELEM_Id',1)
            ->update([
                'ELEM_ValorCredito' => $request['titulo']
            ]);

            Elemento::where('ELEM_Id',3)
            ->update([
                'ELEM_ValorCredito' => $request['dni']
            ]);

            Elemento::where('ELEM_Id',4)
            ->update([
                'ELEM_ValorCredito' => $request['correoElectronico']
            ]);

            Elemento::where('ELEM_Id',5)
            ->update([
                'ELEM_ValorCredito' => $request['numeroCelular']
            ]);

            Elemento::where('ELEM_Id',6)
            ->update([
                'ELEM_ValorCredito' => $request['nombrePersona']
            ]);

            Elemento::where('ELEM_Id',7)
            ->update([
                'ELEM_ValorCredito' => $request['textoAdicional']
            ]);

            if($imagen)
            {
                File::delete((Elemento::select('ELEM_ValorCredito')->where('ELEM_Id',2)->first())->ELEM_ValorCredito);
                Elemento::where('ELEM_Id',2)
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