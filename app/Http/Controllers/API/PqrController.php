<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pqr;
use Illuminate\Http\Request;

class PqrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get(){
        try{
            $data=Pqr::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $pqrs = Pqr::where('tipo_suge', 'like', "%$data%")
                         ->orWhere('users_doc', 'like', "%$data%")
                         ->get();
            
            if ($pqrs->isEmpty()) {
                return response()->json(['message' => 'No se encontraron pqrs'], 404);
            }
            
            return response()->json(['message' => 'Pqrs encontradas', 'data' => $pqrs], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
     
    public function index(Request $request) {
        try {
            $pqrs = Pqr::orderBy('tipo_suge', 'asc')->paginate(10);
            
            if ($pqrs->isEmpty()) {
                return response()->json(['message' => 'No hay pqrs disponibles'], 404);
            }
            
            return response()->json(['message' => 'Pqrs obtenidas con éxito', 'data' => $pqrs], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){
        try{
            $data['sugerencia']=$request['sugerencia'];
            $data['tipo_suge']=$request['tipo_suge'];
            $data['estado']=$request['estado'];
            $data['users_doc']=$request['users_doc'];
            $pqrs=Pqr::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $pqrs], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $pqrs=Pqr::find($id);
            if(!$pqrs) {
                return response()->json(['error' => 'Pqrs no encontrados'], 404);
            }
            return response()->json($pqrs, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['estado']=$request['estado'];
            $pqrs = Pqr::find($id);
            if(!$pqrs) {
                return response()->json(['error' => 'Pqrs no encontrados'], 404);
            }
            $pqrs->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $pqrs], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $pqrs=Pqr::find($id);
            if(!$pqrs) {
                return response()->json(['error' => 'Pqrs no encontrados'], 404);
            }
            $pqrs->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}    