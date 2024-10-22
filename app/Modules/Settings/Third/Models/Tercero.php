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

/**
 * App\Modules\Settings\Third\Models\Tercero
 *
 * @property int $id
 * @property int $codigo_sucursal
 * @property int $empresa_serial
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Settings\Third\Models\Contacto> $contacto
 * @property-read int|null $contacto_count
 * @property-read DatoBasico|null $datosBasicos
 * @property-read \App\Modules\Settings\Third\Models\DatoFacturacion|null $datosFacturacion
 * @property-read Empresa $empresa
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Settings\Third\Models\TipoTercero> $tipoTerceros
 * @property-read int|null $tipo_terceros_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tercero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tercero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tercero query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tercero whereCodigoSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tercero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tercero whereEmpresaSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tercero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tercero whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Settings\Third\Models\Contacto> $contactos
 * @property-read int|null $contactos_count
 * @mixin \Eloquent
 */
class Tercero extends Model
{
    use HasFactory;

    protected $table = 'terceros';

    protected $fillable = [
        'codigo_sucursal',
        'empresa_serial',
    ];

    public function datosBasicos() : HasOne
    {
        return $this->hasOne(DatoBasico::class, 'tercero_id', 'id');
    }

    public function contactos() : HasMany
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

    public function empresa() : BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_serial', 'serial');
    }
}
