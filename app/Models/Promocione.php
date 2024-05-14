<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocione extends Model
{
    use HasFactory;

    protected $table='promociones';

    protected $fillable = [
        'nom_promo',
        'total_promo',
        'categorias_id',
    ];

    public function detpromociones(){
        return $this->hasMany(Detpromocione::class);
    }

    public function categorias(){
        return $this->belongsTo(Categoria::class);
    }


}