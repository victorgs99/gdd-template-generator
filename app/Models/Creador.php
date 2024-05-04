<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Creador extends Model
{
    use HasFactory;

    protected $table = "creador";

    protected $fillable = [
        'nombre',
        'descripcion_personal',
        'correo_contacto',
        'telefono_contacto',
        'user_id',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plantillas(): HasMany
    {
        return $this->hasMany(Plantilla::class);
    }
}
