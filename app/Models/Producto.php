<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table='productos';

    protected $fillable = [
        'nom_producto',
        'precio_producto',
        'detalle',
        'codigo',
        'categorias_id',
    ];


    public function categorias(){
        return $this->belongsTo(Categoria::class);
    }

    public function detpromociones(){
        return $this->hasMany(Detpromocione::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
