<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function get(){
        try{
            $data=Role::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $roles = Role::where('nombre', 'like', "%$data%")
                        ->orWhere('id', 'like', "%$data%")
                        ->get();
            
            if ($roles->isEmpty()) {
                return response()->json(['message' => 'No se encontraron roles'], 404);
            }
            
            return response()->json(['message' => 'Roles encontrados', 'data' => $roles], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request) {
        try {
            $roles = Role::orderBy('nombre', 'asc')->paginate(10);
            
            if ($roles->isEmpty()) {
                return response()->json(['message' => 'No hay roles disponibles'], 404);
            }
            
            return response()->json(['message' => 'Roles obtenidos con éxito', 'data' => $roles], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try{
            $data['nombre']=$request['nombre'];
            $roles=Role::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $roles], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($id){
        try{
            $roles=Role::find($id);
            if(!$roles) {
                return response()->json(['error' => 'Rol no encontrado'], 404);
            }
            return response()->json($roles, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try{
            $data['nombre']=$request['nombre'];
            $roles = Role::find($id);
            if(!$roles) {
                return response()->json(['error' => 'Rol no encontrado'], 404);
            }
            $roles->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $roles], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $roles=Role::find($id);
            if(!$roles) {
                return response()->json(['error' => 'Rol no encontrado'], 404);
            }
            $roles->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
