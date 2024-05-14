<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matprima;

class MatprimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get(){
        try{
            $data=Matprima::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $matprimas = Matprima::where('referencia', 'like', "%$data%")->get();
            
            if ($matprimas->isEmpty()) {
                return response()->json(['message' => 'No se encontraron materias primas'], 404);
            }
            
            return response()->json(['message' => 'Materias primas encontradas', 'data' => $matprimas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
     
    public function index(Request $request) {
        try {
            $matprimas = Matprima::orderBy('referencia', 'asc')->paginate(10);
            
            if ($matprimas->isEmpty()) {
                return response()->json(['message' => 'No hay materias primas disponibles'], 404);
            }
            
            return response()->json(['message' => 'Materias primas obtenidas con éxito', 'data' => $matprimas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){
        try{
            $data['referencia']=$request['referencia'];
            $data['descripcion']=$request['descripcion'];
            $data['existencia']=$request['existencia'];
            $data['entrada']=$request['entrada'];
            $data['salida']=$request['salida'];
            $data['stock']=$request['stock'];
            $matprimas=Matprima::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $matprimas], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $matprimas=Matprima::find($id);
            if(!$matprimas) {
                return response()->json(['error' => 'Materia prima no encontrada'], 404);
            }
            return response()->json($matprimas, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['referencia']=$request['referencia'];
            $data['descripcion']=$request['descripcion'];
            $data['existencia']=$request['existencia'];
            $data['entrada']=$request['entrada'];
            $data['salida']=$request['salida'];
            $data['stock']=$request['stock'];
            $matprimas = Matprima::find($id);
            if(!$matprimas) {
                return response()->json(['error' => 'Materia prima no encontrada'], 404);
            }
            $matprimas->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $matprimas], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $matprimas=Matprima::find($id);
            if(!$matprimas) {
                return response()->json(['error' => 'Materia prima no encontrada'], 404);
            }
            $matprimas->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}    
