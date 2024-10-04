<?php

namespace App\Modules\Settings\Company\Models;

use App\Modules\Accounting\Models\CuentaContable;
use App\Modules\Settings\Third\Models\Tercero;
use App\Modules\Shared\Models\DatoBasico;
use App\Modules\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Modules\Settings\Company\Models\Empresa
 *
 * @property int $serial
 * @property string $tipo_regimen_iva
 * @property string $correo_contacto
 * @property string $nombre_contacto
 * @property string|null $pagina_web
 * @property int|null $es_consorcio
 * @property int $cobrador_id
 * @property string|null $logo
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read DatoBasico|null $datosBasicos
 * @property-read \App\Modules\Settings\Company\Models\DatoTributario|null $datosTributarios
 * @property-read \App\Modules\Settings\Company\Models\RepresentanteLegal|null $representanteLegal
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Tercero> $terceros
 * @property-read int|null $terceros_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereCobradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereCorreoContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereEsConsorcio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereNombreContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa wherePaginaWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereTipoRegimenIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereUserId($value)
 * @mixin \Eloquent
 */
class Empresa extends Model
{
    use HasFactory;

    protected $primaryKey = 'serial';

    protected $fillable = [
        'serial',
        'tipo_regimen_iva',
        'correo_contacto',
        'nombre_contacto',
        'pagina_web',
        'es_consorcio',
        'cobrador_id',
        'logo',
        'user_id',
    ];

    /*
    protected static function booted()
    {
        static::deleted(function ($empresa) {
            $empresa->datosBasicos()->delete();
        });
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function datosBasicos()
    {
        return $this->hasOne(DatoBasico::class, 'empresa_serial', 'serial');
    }

    public function representanteLegal()
    {
        return $this->hasOne(RepresentanteLegal::class, 'empresa_serial', 'serial');
    }

    public function datosTributarios()
    {
        return $this->hasOne(DatoTributario::class, 'empresa_serial', 'serial');
    }

    public function terceros() : HasMany
    {
        return $this->hasMany(Tercero::class, 'empresa_serial', 'serial');
    }

    public function cuentasContables() : BelongsToMany
    {
        return $this->belongsToMany(CuentaContable::class, 'empresa_cuenta_contable', 'empresa_serial',
         'cuenta_contable_id');
    }
}
