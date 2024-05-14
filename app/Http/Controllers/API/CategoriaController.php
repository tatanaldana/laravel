<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function get(){
        try{
            $data=Categoria::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $categorias = Categoria::where('nombre_cat', 'like', "%$data%")->get();
            
            if ($categorias->isEmpty()) {
                return response()->json(['message' => 'No se encontraron categorías'], 404);
            }
            
            return response()->json(['message' => 'Categorías encontradas', 'data' => $categorias], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request) {
        try {
            $categorias = Categoria::orderBy('nombre_cat', 'asc')->paginate(10);
            
            if ($categorias->isEmpty()) {
                return response()->json(['message' => 'No hay categorías disponibles'], 404);
            }
            
            return response()->json(['message' => 'Categorías obtenidas con éxito', 'data' => $categorias], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try{
            $data['nombre_cat']=$request['nombre_cat'];
            $categorias=Categoria::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $categorias], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $categorias=Categoria::find($id);
            if(!$categorias) {
                return response()->json(['error' => 'Categoría no encontrada'], 404);
            }
            return response()->json($categorias, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['nombre_cat']=$request['nombre_cat'];
            $categorias = Categoria::find($id);
            if(!$categorias) {
                return response()->json(['error' => 'Categoría no encontrada'], 404);
            }
            $categorias->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $categorias], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $categorias=Categoria::find($id);
            if(!$categorias) {
                return response()->json(['error' => 'Categoría no encontrada'], 404);
            }
            $categorias->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
