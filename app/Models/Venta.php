<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table='ventas';

    
    protected $fillable = [
        'metodo_pago',
        'estado',
        'total',
        'users_doc',
    ];

    public function usuarios()
    {
        return $this->belongsTo(User::class);
    }

        //relacion uno a muchos
    public function detventas(){
        return $this->hasMany(Detventa::class);
    }    
}
