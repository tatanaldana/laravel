<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table='categorias';
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_cat',

    ];

    //relacion uno a muchos
    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function promociones(){
        return $this->hasMany(Promocione::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}

