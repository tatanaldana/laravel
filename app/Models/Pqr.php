<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pqr extends Model
{
    use HasFactory;

    protected $table='pqrs';

    protected $fillable = [
        'sugerencia',
        'tipo_suge',
        'estado',
        'users_doc',
    ];

    //relacion inversa uno a muchos
    public function usuarios()
    {
        return $this->belongsTo(User::class);
    }
}
