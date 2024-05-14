<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoriaController;
use App\Http\Controllers\API\MatprimaController;
use App\Http\Controllers\API\ProveedoreController;
use App\Http\Controllers\API\PqrController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\DetpromocioneController;
use App\Http\Controllers\API\DetventaController;
use App\Http\Controllers\API\PromocioneController;
use App\Http\Controllers\API\VentaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('V1/categoria')->group(function(){
    Route::get('/',[CategoriaController::class,'get']);
    Route::get('/paginacion', [CategoriaController::class, 'index']);
    Route::get('/buscar', [CategoriaController::class, 'search']);
    Route::post('/',[CategoriaController::class,'create']);
    Route::get('/{id}',[CategoriaController::class,'show']);
    Route::put('/{id}',[CategoriaController::class,'update']);
    Route::delete('/{id}',[CategoriaController::class,'destroy']);
});

Route::prefix('V1/matprimas')->group(function(){
    Route::get('/',[MatprimaController::class,'get']);
    Route::get('/paginacion', [MatprimaController::class, 'index']);
    Route::get('/buscar', [MatprimaController::class, 'search']);
    Route::post('/',[MatprimaController::class,'create']);
    Route::get('/{id}',[MatprimaController::class,'show']);
    Route::put('/{id}',[MatprimaController::class,'update']);
    Route::delete('/{id}',[MatprimaController::class,'destroy']);
});

Route::prefix('V1/proveedores')->group(function(){
    Route::get('/',[ProveedoreController::class,'get']);
    Route::get('/paginacion', [ProveedoreController::class, 'index']);
    Route::get('/buscar', [ProveedoreController::class, 'search']);
    Route::post('/',[ProveedoreController::class,'create']);
    Route::get('/{id}',[ProveedoreController::class,'show']);
    Route::put('/{id}',[ProveedoreController::class,'update']);
    Route::delete('/{id}',[ProveedoreController::class,'destroy']);
});

Route::prefix('V1/pqrs')->group(function(){
    Route::get('/',[PqrController::class,'get']);
    Route::get('/paginacion', [PqrController::class, 'index']);
    Route::get('/buscar', [PqrController::class, 'search']);
    Route::post('/',[PqrController::class,'create']);
    Route::get('/{id}',[PqrController::class,'show']);
    Route::patch('/{id}',[PqrController::class,'update']);
    Route::delete('/{id}',[PqrController::class,'destroy']);
});


Route::prefix('V1/roles')->group(function(){
    Route::get('/',[RoleController::class,'get']);
    Route::get('/paginacion', [RoleController::class, 'index']);
    Route::get('/buscar', [RoleController::class, 'search']);
    Route::post('/',[RoleController::class,'create']);
    Route::get('/{id}',[RoleController::class,'show']);
    Route::put('/{id}',[RoleController::class,'update']);
    Route::delete('/{id}',[RoleController::class,'destroy']);
});

Route::prefix('V1/users')->group(function(){
    Route::get('/',[UserController::class,'get']);
    Route::get('/buscar', [UserController::class, 'search']);
    Route::post('/',[UserController::class,'create']);
    Route::get('/paginacion', [UserController::class, 'index']);
    Route::get('/{doc}',[UserController::class,'show']);
    Route::patch('/{doc}',[UserController::class,'update']);
    Route::delete('/{doc}',[UserController::class,'destroy']);
});

Route::prefix('V1/productos')->group(function(){
    Route::get('/',[ProductoController::class,'get']);
    Route::get('/buscar', [ProductoController::class, 'search']);
    Route::post('/',[ProductoController::class,'create']);
    Route::get('/paginacion', [ProductoController::class, 'index']);
    Route::get('/{id}',[ProductoController::class,'show']);
    Route::patch('/{id}',[ProductoController::class,'update']);
    Route::delete('/{id}',[ProductoController::class,'destroy']);
});

Route::prefix('V1/detpromo')->group(function(){
    Route::get('/',[DetpromocioneController::class,'get']);
    Route::get('/buscar', [DetpromocioneController::class, 'search']);
    Route::post('/',[DetpromocioneController::class,'create']);
    Route::get('/paginacion', [DetpromocioneController::class, 'index']);
    Route::get('/{id}',[DetpromocioneController::class,'show']);
    Route::patch('/{id}',[DetpromocioneController ::class,'update']);
});

Route::prefix('V1/detventa')->group(function(){
    Route::get('/',[DetventaController::class,'get']);
    Route::get('/buscar', [DetventaController::class, 'search']);
    Route::post('/',[DetventaController::class,'create']);
    Route::get('/paginacion', [DetventaController::class, 'index']);
    Route::get('/{id}',[DetventaController::class,'show']);
});

Route::prefix('V1/promo')->group(function(){
    Route::get('/',[PromocioneController::class,'get']);
    Route::get('/buscar', [PromocioneController::class, 'search']);
    Route::post('/',[PromocioneController::class,'create']);
    Route::get('/paginacion', [PromocioneController::class, 'index']);
    Route::get('/{id}',[PromocioneController::class,'show']);
    Route::patch('/{id}',[PromocioneController::class,'update']);
    Route::delete('/{id}',[PromocioneController::class,'destroy']);
});

Route::prefix('V1/ventas')->group(function(){
    Route::get('/',[VentaController::class,'get']);
    Route::get('/buscar', [VentaController::class, 'search']);
    Route::post('/',[VentaController::class,'create']);
    Route::get('/paginacion', [VentaController::class, 'index']);
    Route::get('/{id}',[VentaController::class,'show']);
    Route::patch('/{id}',[VentaController::class,'update']);
    Route::delete('/{id}',[VentaController::class,'destroy']);
});