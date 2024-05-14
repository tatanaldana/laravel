<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Detpromocione;
use Illuminate\Http\Request;

class DetpromocioneController extends Controller
{
    public function get(){
        try{
            $data=Detpromocione::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $detpromociones = Detpromocione::where('promociones_id', 'like', "%$data%")
                        ->orWhere('productos_id', 'like', "%$data%")
                        ->get();
            
            if ($detpromociones->isEmpty()) {
                return response()->json(['message' => 'No se encontraron promociones'], 404);
            }
            
            return response()->json(['message' => 'Detalle de promocion encontrado', 'data' => $detpromociones], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request) {
        try {
            $detpromociones = Detpromocione::orderBy('promociones_id', 'asc')->paginate(10);
            
            if ($detpromociones->isEmpty()) {
                return response()->json(['message' => 'No hay promocion disponibles'], 404);
            }
            
            return response()->json(['message' => 'Detalle de promocion obtenido con éxito', 'data' => $detpromociones], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try{
            $data['cantidad']=$request['cantidad'];
            $data['descuento']=$request['descuento'];
            $data['subtotal']=$request['subtotal'];
            $data['promociones_id']=$request['promociones_id'];
            $data['productos_id']=$request['productos_id'];
            $detpromociones=Detpromocione::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $detpromociones], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $detpromociones=Detpromocione::where('promociones_id', $id)->first();
            if(!$detpromociones) {
                return response()->json(['error' => 'Detalle de promocion no encontrado'], 404);
            }
            return response()->json($detpromociones, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['cantidad']=$request['cantidad'];
            $data['descuento']=$request['descuento'];
            $data['subtotal']=$request['subtotal'];
            $data['productos_id']=$request['productos_id'];
            $detpromociones = Detpromocione::where('promociones_id', $id)->first();
            if(!$detpromociones) {
                return response()->json(['error' => 'Detalle de promocion no encontrado'], 404);
            }
            $detpromociones->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $detpromociones], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }


}