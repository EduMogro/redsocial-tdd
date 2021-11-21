<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // Deshabilitamos la protección siempre que no pasemos request()->all() 
    // al crear un registro (en Like::create() o Like::update())
    protected $guarded = []; 
}
