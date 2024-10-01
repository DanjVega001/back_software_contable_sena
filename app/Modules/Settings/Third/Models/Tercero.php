<?php

namespace App\Modules\Settings\Third\Models;

use App\Modules\Settings\Company\Models\Empresa;
use App\Modules\Shared\Models\DatoBasico;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tercero extends Model
{
    use HasFactory;

    protected $table = 'terceros';

    protected $fillable = [
        'codigo_sucursal',
        'empresa_serial',
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

    public function tipoTerceros() : BelongsToMany
    {
        return $this->belongsToMany(TipoTercero::class, 'tercero_tipo_tercero', 'tercero_id',
            'tipo_tercero_id');
    }

    public function empresas() : BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_serial', 'serial');
    }
}
