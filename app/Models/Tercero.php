<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tercero extends Model
{
    use HasFactory;

    protected $table = 'terceros';

    protected $fillable = [
        'codigo_sucursal',
    ];

    public function datosBasicos() : BelongsTo
    {
        return $this->belongsTo(DatoBasico::class);
    }

    public function contacto() : HasMany
    {
        return $this->hasMany(Contacto::class);
    }

    public function datosFacturacion() : HasOne
    {
        return $this->hasOne(DatoFacturacion::class);
    }
}
