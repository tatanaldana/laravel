<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table='images';

    protected $fileable=[
        'imageable_id',
        'imageable_type',
        'path'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}

