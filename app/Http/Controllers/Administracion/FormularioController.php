<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Formulario;
use App\Models\Elemento;
use App\Models\Icono;
use Illuminate\Support\Str;
use Response;
use File;

class FormularioController extends Controller
{

    public function index(Request $request)
    {   
        return view('administracion.formulario.index', [
            'formularios' => $this->obtenerTipoFormulario(),
            'iconos' => Icono::get()
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
        return Elemento::get(['ELEM_Id', 'ELEM_Tipo', 'ELEM_Icono', 'ELEM_ValorGeneral AS Valor']);
    }

    private function obtenerDatosFormularioAhorro()
    {
        return Elemento::get(['ELEM_Id', 'ELEM_Tipo', 'ELEM_Icono', 'ELEM_ValorAhorro AS Valor']);
    }

    private function obtenerDatosFormularioCredito()
    {
        return Elemento::get(['ELEM_Id', 'ELEM_Tipo', 'ELEM_Icono', 'ELEM_ValorCredito AS Valor']);
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

    private function crearItem($texto,$idFormulario,$valor)
    {
        $arreglo = explode('/', $texto);

        if($idFormulario == 1):
            $arreglo[1] = $valor;
        elseif($idFormulario == 2):
            $arreglo[0] = $valor;
        elseif($idFormulario == 3):
            $arreglo[2] = $valor;
        endif;

        return implode('/', $arreglo);
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
                'ELEM_ValorGeneral' => $request['dni'],
                'ELEM_Icono' => $this->crearItem($request['hdnDni'],$request['FORM_Id'],$request['slcDni'])
            ]);

            Elemento::where('ELEM_Id',4)
            ->update([
                'ELEM_ValorGeneral' => $request['correoElectronico'],
                'ELEM_Icono' => $this->crearItem($request['hdnCorreoElectronico'],$request['FORM_Id'],$request['slcCorreoElectronico'])
            ]);

            Elemento::where('ELEM_Id',5)
            ->update([
                'ELEM_ValorGeneral' => $request['numeroCelular'],
                'ELEM_Icono' => $this->crearItem($request['hdnNumeroCelular'],$request['FORM_Id'],$request['slcNumeroCelular'])
            ]);

            Elemento::where('ELEM_Id',6)
            ->update([
                'ELEM_ValorGeneral' => $request['nombrePersona'],
                'ELEM_Icono' => $this->crearItem($request['hdnNombrePersona'],$request['FORM_Id'],$request['slcNombrePersona'])
            ]);

            Elemento::where('ELEM_Id',7)
            ->update([
                'ELEM_ValorGeneral' => $request['textoAdicional'],
                'ELEM_Icono' => $this->crearItem($request['hdnAdicional'],$request['FORM_Id'],$request['slcAdicional'])
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
                'ELEM_ValorAhorro' => $request['dni'],
                'ELEM_Icono' => $this->crearItem($request['hdnDni'],$request['FORM_Id'],$request['slcDni'])
            ]);

            Elemento::where('ELEM_Id',4)
            ->update([
                'ELEM_ValorAhorro' => $request['correoElectronico'],
                'ELEM_Icono' => $this->crearItem($request['hdnCorreoElectronico'],$request['FORM_Id'],$request['slcCorreoElectronico'])
            ]);

            Elemento::where('ELEM_Id',5)
            ->update([
                'ELEM_ValorAhorro' => $request['numeroCelular'],
                'ELEM_Icono' => $this->crearItem($request['hdnNumeroCelular'],$request['FORM_Id'],$request['slcNumeroCelular'])
            ]);

            Elemento::where('ELEM_Id',6)
            ->update([
                'ELEM_ValorAhorro' => $request['nombrePersona'],
                'ELEM_Icono' => $this->crearItem($request['hdnNombrePersona'],$request['FORM_Id'],$request['slcNombrePersona'])
            ]);

            Elemento::where('ELEM_Id',7)
            ->update([
                'ELEM_ValorAhorro' => $request['textoAdicional'],
                'ELEM_Icono' => $this->crearItem($request['hdnAdicional'],$request['FORM_Id'],$request['slcAdicional'])
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
                'ELEM_ValorCredito' => $request['dni'],
                'ELEM_Icono' => $this->crearItem($request['hdnDni'],$request['FORM_Id'],$request['slcDni'])
            ]);

            Elemento::where('ELEM_Id',4)
            ->update([
                'ELEM_ValorCredito' => $request['correoElectronico'],
                'ELEM_Icono' => $this->crearItem($request['hdnCorreoElectronico'],$request['FORM_Id'],$request['slcCorreoElectronico'])
            ]);

            Elemento::where('ELEM_Id',5)
            ->update([
                'ELEM_ValorCredito' => $request['numeroCelular'],
                'ELEM_Icono' => $this->crearItem($request['hdnNumeroCelular'],$request['FORM_Id'],$request['slcNumeroCelular'])
            ]);

            Elemento::where('ELEM_Id',6)
            ->update([
                'ELEM_ValorCredito' => $request['nombrePersona'],
                'ELEM_Icono' => $this->crearItem($request['hdnNombrePersona'],$request['FORM_Id'],$request['slcNombrePersona'])
            ]);

            Elemento::where('ELEM_Id',7)
            ->update([
                'ELEM_ValorCredito' => $request['textoAdicional'],
                'ELEM_Icono' => $this->crearItem($request['hdnAdicional'],$request['FORM_Id'],$request['slcAdicional'])
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