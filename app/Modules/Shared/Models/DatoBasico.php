<?php

namespace App\Modules\Shared\Models;

use App\Modules\Settings\Company\Models\Empresa;
use App\Modules\Settings\Third\Models\Tercero;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Modules\Shared\Models\DatoBasico
 *
 * @property int $id
 * @property string $tipo_razon_social
 * @property string $tipo_identificacion
 * @property int $numero_identificacion
 * @property string|null $razon_social
 * @property string|null $nombres
 * @property string|null $apellidos
 * @property string|null $nombre_comercial
 * @property string|null $direccion
 * @property int|null $telefono
 * @property int $ciudad_codigo_dian
 * @property int|null $empresa_serial
 * @property int|null $tercero_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Shared\Models\Ciudad $ciudad
 * @property-read Empresa|null $empresa
 * @property-read Tercero|null $tercero
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico query()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereCiudadCodigoDian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereEmpresaSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereNombreComercial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereNumeroIdentificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereTerceroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereTipoIdentificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereTipoRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoBasico whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DatoBasico extends Model
{
    use HasFactory;

    protected $table = 'datos_basicos';

    protected $fillable = [
        'tipo_razon_social',
        'tipo_identificacion',
        'numero_identificacion',
        'razon_social',
        'nombres',
        'apellidos',
        'nombre_comercial',
        'direccion',
        'telefono',
        'ciudad_codigo_dian',
        'empresa_serial',
        'tercero_id'
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_codigo_dian', 'codigo_dian');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_serial', 'serial');
    }

    public function tercero() : BelongsTo
    {
        return $this->belongsTo(Tercero::class);
    }
}
