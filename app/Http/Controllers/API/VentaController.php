<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function get(){
        try{
            $data=Venta::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $ventas = Venta::where('id', 'like', "%$data%")
                        ->orWhere('users_doc', 'like', "%$data%")
                        ->get();
            
            if ($ventas->isEmpty()) {
                return response()->json(['message' => 'No se encontraron ventas'], 404);
            }
            
            return response()->json(['message' => 'Ventas encontradas', 'data' => $ventas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request) {
        try {
            $ventas = Venta::orderBy('id', 'asc')->paginate(10);
            
            if ($ventas->isEmpty()) {
                return response()->json(['message' => 'No hay ventas disponibles'], 404);
            }
            
            return response()->json(['message' => 'Ventas obtenidas con éxito', 'data' => $ventas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try{
            $data['metodo_pago']=$request['metodo_pago'];
            $data['estado']=$request['estado'];
            $data['total']=$request['total'];
            $data['users_doc']=$request['users_doc'];
            $ventas=Venta::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $ventas], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $ventas=Venta::find($id);
            if(!$ventas) {
                return response()->json(['error' => 'Venta no encontrada'], 404);
            }
            return response()->json($ventas, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['estado']=$request['estado'];
            $ventas = Venta::find($id);
            if(!$ventas) {
                return response()->json(['error' => 'Venta no encontrada'], 404);
            }
            $ventas->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $ventas], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $ventas=Venta::find($id);
            if(!$ventas) {
                return response()->json(['error' => 'Venta no encontrada'], 404);
            }
            $ventas->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}