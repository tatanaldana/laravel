<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matprima extends Model
{
    protected $table='matprimas';

    protected $fillable = [
        'referencia',
        'descripcion',
        'existencia',
        'entrada',
        'salida',
        'stock',
    ];

    use HasFactory;
}

