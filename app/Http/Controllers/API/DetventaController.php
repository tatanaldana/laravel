<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Detventa;
use Illuminate\Http\Request;

class DetventaController extends Controller
{
    public function get(){
        try{
            $data=Detventa::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $detventas = Detventa::where('ventas_id', 'like', "%$data%")
                        ->orWhere('nom_producto', 'like', "%$data%")
                        ->get();
            
            if ($detventas->isEmpty()) {
                return response()->json(['message' => 'No se encontraron ventas'], 404);
            }
            
            return response()->json(['message' => 'Detalle de venta encontrado', 'data' => $detventas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request) {
        try {
            $detventas = Detventa::orderBy('ventas_id', 'asc')->paginate(10);
            
            if ($detventas->isEmpty()) {
                return response()->json(['message' => 'No hay ventas disponibles'], 404);
            }
            
            return response()->json(['message' => 'Detalle de venta obtenido con éxito', 'data' => $detventas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try{
            $data['nom_producto']=$request['nom_producto'];
            $data['pre_producto']=$request['pre_producto'];
            $data['cantidad']=$request['cantidad'];
            $data['subtotal']=$request['subtotal'];
            $data['ventas_id']=$request['ventas_id'];
            $detventas=Detventa::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $detventas], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $detventas=Detventa::where('ventas_id', $id)->first();
            if(!$detventas) {
                return response()->json(['error' => 'Detalle de venta no encontrado'], 404);
            }
            return response()->json($detventas, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

}