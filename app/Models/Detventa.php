<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detventa extends Model
{
    use HasFactory;

    protected $table='detventas';

    protected $fillable = [
        'nom_producto',
        'pre_producto',
        'cantidad',
        'subtotal',
        'ventas_id',
    ];

    public function ventas()
    {
        return $this->belongsTo(Venta::class);
    }
}
