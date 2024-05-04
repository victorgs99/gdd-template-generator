<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaPlataformas extends Model
{
    use HasFactory;

    protected $table = "plantilla_plataformas";

    protected $fillable = [
        'plantilla_id',
        'plataforma_lanzamiento_id',
    ];
}
