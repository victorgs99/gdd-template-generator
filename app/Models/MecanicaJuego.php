<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MecanicaJuego extends Model
{
    use HasFactory;

    protected $table = "mecanica_juego";

    protected $fillable = [
        'img',
        'descripcion',
        'plantilla_id',
    ];

    public function plantilla(): BelongsTo
    {
        return $this->belongsTo(Plantilla::class);
    }
}
