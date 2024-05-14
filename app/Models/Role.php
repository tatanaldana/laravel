<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table='roles';

    protected $fillable = [
        'nombre',
        
    ];

        //relacion uno a muchos
        public function usuarios(){
            return $this->hasMany(User::class);
        }
}

