<?php

namespace App\Modules\Settings\Third\Models;

use App\Modules\Shared\Models\ResponsabilidadFiscal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Modules\Settings\Third\Models\DatoFacturacion
 *
 * @property int $id
 * @property string|null $nombres_contacto
 * @property string|null $apellidos_contacto
 * @property string|null $correo_electronico
 * @property string|null $tipo_regimen_iva
 * @property int|null $telefono
 * @property int|null $codigo_postal
 * @property int $tercero_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ResponsabilidadFiscal> $respFiscales
 * @property-read int|null $resp_fiscales_count
 * @property-read \App\Modules\Settings\Third\Models\Tercero $tercero
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereApellidosContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereCodigoPostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereNombresContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereTerceroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereTipoRegimenIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoFacturacion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DatoFacturacion extends Model
{
    use HasFactory;

    protected $table = 'datos_facturaciones';

    protected $fillable = [
        'nombres_contacto',
        'apellidos_contacto',
        'correo_electronico',
        'tipo_regimen_iva',
        'telefono',
        'codigo_postal',
        'tercero_id'
    ];

    public function tercero() : BelongsTo
    {
        return $this->belongsTo(Tercero::class);
    }

    public function respFiscales() : BelongsToMany
    {
        return $this->belongsToMany(ResponsabilidadFiscal::class, 'dato_facturacion_resp_fiscal',
                'dato_facturacion_id', 'responsabilidad_fiscal_id');
    }
}
