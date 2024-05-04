<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plantilla extends Model
{
    use HasFactory;

    protected $table = "plantilla";

    protected $fillable = [
        'img_referencias_visuales',
        'titulo',
        'descripcion_corta',
        'publico_dirigido',
        'creador_id',
    ];

    public function creador(): BelongsTo
    {
        return $this->belongsTo(Creador::class);
    }

    /*public function plataformas_lanzamiento(): HasMany
    {
        return $this->hasMany(PlataformaLanzamiento::class);
    }*/

    public function plataformas_lanzamiento(): BelongsToMany
    {
        return $this->belongsToMany(PlataformaLanzamiento::class, 'plantilla_plataformas');
    }

    public function referencias_juego(): HasMany
    {
        return $this->hasMany(ReferenciaJuego::class);
    }

    public function palabras_clave(): HasMany
    {
        return $this->hasMany(PalabraClave::class);
    }

    public function mecanicas_juego(): HasMany
    {
        return $this->hasMany(MecanicaJuego::class);
    }
}
