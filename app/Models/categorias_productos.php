<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias_productos extends Model
{
    use HasFactory;

    protected $table = "categorias_productos";
    public $timestamps = false;
}
