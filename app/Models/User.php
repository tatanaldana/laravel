<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'doc';
    protected $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'doc',
        'nombre',
        'apellido',
        'tipo_doc',
        'tel',
        'fecha_naci',
        'genero',
        'direccion',
        'rol_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function nombre():Attribute{
        return Attribute::make(
            set:function($value){//metodo set es un mutador porque lo modifica antes de registrarse a la base
                return strtoupper($value);
            },
            get:function($value){//metodo get es metodo accesor porque permite modificarlo cuando lo voy a mostrar en una consulta
                return ucfirst($value);
            }
        );

    }
    //relacion uno a muchos
    public function pqrs(){
        return $this->hasMany(Pqr::class);
    }

    public function ventas(){
        return $this->hasMany(Venta::class);
    }

    public function roles(){
        return $this->belongsTo(Role::class);
    }
}
