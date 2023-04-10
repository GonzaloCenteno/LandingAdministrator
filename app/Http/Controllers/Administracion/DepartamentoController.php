<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Response;

class DepartamentoController extends Controller
{
    public function index(Request $request)
    {   
        return view('administracion.departamento.index', [
            'departamentos' => $this->obtenerDepartamentos()
        ]);
    }

    private function obtenerDepartamentos() 
    {
        return Departamento::orderBy('DEPA_Id','ASC')->get();
    }

    public function show($id,Request $request)
    {
       return Departamento::where('DEPA_Id',$id)->first();
    }
    
    public function store(Request $request)
    {
        try{
            $data = Departamento::create($request->all());
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
    
    public function update($id, Request $request)
    {
        try{
            $data = Departamento::find($id);
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
        return Departamento::where('DEPA_Id',$id)->delete();
    }
}