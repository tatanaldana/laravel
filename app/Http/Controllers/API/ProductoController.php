<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function get(){
        try{
            $data=Producto::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $productos = Producto::where('codigo', 'like', "%$data%")
                        ->orWhere('nom_producto', 'like', "%$data%")
                        ->get();
            
            if ($productos->isEmpty()) {
                return response()->json(['message' => 'No se encontraron productos'], 404);
            }
            
            return response()->json(['message' => 'Productos encontrados', 'data' => $productos], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request) {
        try {
            $productos = Producto::orderBy('nom_producto', 'asc')->paginate(10);
            
            if ($productos->isEmpty()) {
                return response()->json(['message' => 'No hay productos disponibles'], 404);
            }
            
            return response()->json(['message' => 'Productos obtenidos con éxito', 'data' => $productos], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try{
            $data['nom_producto']=$request['nom_producto'];
            $data['precio_producto']=$request['precio_producto'];
            $data['detalle']=$request['detalle'];
            $data['codigo']=$request['codigo'];
            $data['categorias_id']=$request['categorias_id'];
            $productos=Producto::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $productos], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $productos=Producto::find($id);
            if(!$productos) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }
            return response()->json($productos, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['nom_producto']=$request['nom_producto'];
            $data['precio_producto']=$request['precio_producto'];
            $data['detalle']=$request['detalle'];
            $data['codigo']=$request['codigo'];
            $productos = Producto::find($id);
            if(!$productos) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }
            $productos->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $productos], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $productos=Producto::find($id);
            if(!$productos) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }
            $productos->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}