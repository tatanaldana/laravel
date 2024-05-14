<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    use HasFactory;

    protected $table='proveedores';

    protected $fillable = [
        'codigo',
        'nombre',
        'telefono',
        'direccion',
    ];


}
