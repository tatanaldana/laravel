<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(){
        try{
            $data=User::get();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }

    public function search(Request $request) {
        try {
            $data = $request->input('search');
            $users = User::where('doc', 'like', "%$data%")
                        ->orWhere('nombre', 'like', "%$data%")
                        ->orWhere('apellido', 'like', "%$data%")
                        ->get();
            
            if ($users->isEmpty()) {
                return response()->json(['message' => 'No se encontraron usuarios'], 404);
            }
            
            return response()->json(['message' => 'Usuarios encontrados', 'data' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request) {
        try {
            $users = User::orderBy('nombre', 'asc')->paginate(10);
            
            if ($users->isEmpty()) {
                return response()->json(['message' => 'No hay usuarios disponibles'], 404);
            }
            
            return response()->json(['message' => 'Usuarios obtenidos con éxito', 'data' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try{
            $data['doc']=$request['doc'];
            $data['nombre']=$request['nombre'];
            $data['apellido']=$request['apellido'];
            $data['tipo_doc']=$request['tipo_doc'];
            $data['tel']=$request['tel'];
            $data['fecha_naci']=$request['fecha_naci'];
            $data['genero']=$request['genero'];
            $data['direccion']=$request['direccion'];
            $data['rol_id']=$request['rol_id'];
            $data['email']=$request['email'];
            $data['password']=$request['password'];
            $users=User::create($data);
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $users], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function show($doc){
        try{
            $users=User::find($doc);
            if(!$users) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
            return response()->json($users, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$doc){
        try{
            $data['tel']=$request['tel'];
            $data['genero']=$request['genero'];
            $data['direccion']=$request['direccion'];
            $users = User::find($doc);
            if(!$users) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
            $users->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $users], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($doc){
        try{
            $users=User::find($doc);
            if(!$users) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
            $users->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
