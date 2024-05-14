<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Promocione;
use Illuminate\Http\Request;

class PromocioneController extends Controller
{
    public function get(){
        try{
            $data=Promocione::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $promociones = Promocione::where('codigo', 'like', "%$data%")
                        ->orWhere('nom_producto', 'like', "%$data%")
                        ->get();
            
            if ($promociones->isEmpty()) {
                return response()->json(['message' => 'No se encontraron promociones'], 404);
            }
            
            return response()->json(['message' => 'Promociones encontradas', 'data' => $promociones], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request) {
        try {
            $promociones = Promocione::orderBy('nom_producto', 'asc')->paginate(10);
            
            if ($promociones->isEmpty()) {
                return response()->json(['message' => 'No hay promociones disponibles'], 404);
            }
            
            return response()->json(['message' => 'Promociones obtenidas con éxito', 'data' => $promociones], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try{
            $data['nom_promo']=$request['nom_promo'];
            $data['total_promo']=$request['total_promo'];
            $data['categorias_id']=$request['categorias_id'];
            $promociones=Promocione::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $promociones], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $promociones=Promocione::find($id);
            if(!$promociones) {
                return response()->json(['error' => 'Promocion no encontrada'], 404);
            }
            return response()->json($promociones, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['nom_promo']=$request['nom_promo'];
            $data['total_promo']=$request['total_promo'];
            $promociones = Promocione::find($id);
            if(!$promociones) {
                return response()->json(['error' => 'Promocion no encontrada'], 404);
            }
            $promociones->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $promociones], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $promociones=Promocione::find($id);
            if(!$promociones) {
                return response()->json(['error' => 'Promocion no encontrada'], 404);
            }
            $promociones->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}