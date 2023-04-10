<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Distrito;
use App\Models\Departamento;
use Response;

class DistritoController extends Controller
{

    public function index(Request $request)
    {   
        return view('administracion.distrito.index', [
            'distritos' => $this->obtenerDistritos(),
            'departamento' => $this->obtenerDepartamento()
        ]);
    }

    private function obtenerDistritos() 
    {
        return Distrito::with('departamento')->orderBy('DIST_Id','ASC')->get();
    }

    private function obtenerDepartamento()
    {
        return Departamento::where('DEPA_Nombre', 'Lima')->first();
    }

    public function show($id,Request $request)
    {
        return Distrito::where('DIST_Id',$id)->first();
    }
    
    public function store(Request $request)
    {
        try{
            $data = Distrito::create($request->all());
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
    
    public function update(Request $request, $id)
    {
        try{
            $data = Distrito::find($id);
            $data->update($request->all());
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
    
    public function destroy($id, Request $request)
    {
        return Distrito::where('DIST_Id',$id)->delete();
    }
}