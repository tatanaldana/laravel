<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detpromocione extends Model
{
    use HasFactory;

    protected $table='detpromociones';

    protected $fillable = [
        'cantidad',
        'descuento',
        'subtotal',
        'promociones_id',
        'productos_id',
    ];


    public function promociones(){
        return $this->belongsTo(Promocione::class);
    }
    
    public function productos(){
        return $this->belongsTo(Producto::class);
    }
}

