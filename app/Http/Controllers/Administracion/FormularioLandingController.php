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
        ]);
         
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'messages' => $validator->messages()
            ], 422); 
        }

        return Response::json([
            'status' => true,
            'messages' => 'OK'
        ], 200);
    }
}