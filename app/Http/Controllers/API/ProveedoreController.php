<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedore;

class ProveedoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get(){
        try{
            $data=Proveedore::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $proveedores = Proveedore::where('nombre', 'like', "%$data%")->get();
            
            if ($proveedores->isEmpty()) {
                return response()->json(['message' => 'No se encontraron proveedores'], 404);
            }
            
            return response()->json(['message' => 'Proveedores encontradas', 'data' => $proveedores], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
     
    public function index(Request $request) {
        try {
            $proveedores = Proveedore::orderBy('nombre', 'asc')->paginate(10);
            
            if ($proveedores->isEmpty()) {
                return response()->json(['message' => 'No hay proveedores disponibles'], 404);
            }
            
            return response()->json(['message' => 'Proveedores obtenidas con éxito', 'data' => $proveedores], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){
        try{
            $data['codigo']=$request['codigo'];
            $data['nombre']=$request['nombre'];
            $data['telefono']=$request['telefono'];
            $data['direccion']=$request['direccion'];
            $proveedores=Proveedore::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $proveedores], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $proveedores=Proveedore::find($id);
            if(!$proveedores) {
                return response()->json(['error' => 'Proveedores no encontrados'], 404);
            }
            return response()->json($proveedores, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['codigo']=$request['codigo'];
            $data['nombre']=$request['nombre'];
            $data['telefono']=$request['telefono'];
            $data['direccion']=$request['direccion'];
            $proveedores = Proveedore::find($id);
            if(!$proveedores) {
                return response()->json(['error' => 'Proveedores no encontrados'], 404);
            }
            $proveedores->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $proveedores], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $proveedores=Proveedore::find($id);
            if(!$proveedores) {
                return response()->json(['error' => 'Proveedores no encontrados'], 404);
            }
            $proveedores->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}  