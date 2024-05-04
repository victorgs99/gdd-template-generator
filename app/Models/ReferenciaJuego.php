<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReferenciaJuego extends Model
{
    use HasFactory;

    protected $table = "referencia_juego";

    protected $fillable = [
        'referencia',
        'plantilla_id',
    ];

    public function plantilla(): BelongsTo
    {
        return $this->belongsTo(Plantilla::class);
    }
}
