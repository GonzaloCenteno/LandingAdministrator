<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Distrito;
use Response;

class FormularioLandingController extends Controller
{
    public function show($id,Request $request)
    {
        return Distrito::get();
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dni' => 'sometimes|required|numeric',
            'correoElectronico' => 'sometimes|required|email',
            'numeroCelular' => 'sometimes|required|numeric',
            'tipoIngresos' => 'sometimes|required',
            'departamento' => 'sometimes|required',
            'distrito' => 'sometimes|required',
            'acepto' => 'sometimes|required|in:true',
            'condiciones' => 'sometimes|required|in:true', 
            'nombrePersona' => 'sometimes|required',
            'textoAdicional' => 'sometimes|required',
        ]);
         
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'messages' => $validator->messages()
            ], 422); 
        }

        $url_form ="https://getform.io/f/54fc2270-0e4b-47ec-a149-3c5a7ca80233";
        $data1 = [
            'dni'=>isset($request['dni']) ? $request['dni'] : '',
            'correo'=>isset($request['correoElectronico']) ? $request['correoElectronico'] : '',
            'celular'=>isset($request['numeroCelular']) ? $request['numeroCelular'] : '',
            'ingresos'=>isset($request['tipoIngresos']) ? $request['tipoIngresos'] : '',
            'departamento'=>isset($request['departamento']) ? $request['departamento'] : '',
            'otros'=>isset($request['acepto']) ? $request['acepto'] : '',
            'f07' => "",
            'f08' => "",
            'f09' => "",
        ];

        $ch2 = curl_init($url_form);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data",]);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $data1);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($ch2);
        curl_close($ch2);

        return Response::json([
            'status' => true,
            'messages' => 'OK'
        ], 200);
    }
}