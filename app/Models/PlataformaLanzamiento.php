<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlataformaLanzamiento extends Model
{
    use HasFactory;

    protected $table = "plataforma_lanzamiento";

    protected $fillable = [
        'img',
        'nombre',
    ];

    /*public function plantilla(): BelongsTo
    {
        return $this->belongsTo(Plantilla::class);
    }*/

    public function plantillas(): BelongsToMany
    {
        return $this->belongsToMany(Plantilla::class, 'plantilla_plataformas');
    }
}
