<?php

namespace App\Modules\Settings\Company\Models;

use App\Modules\Shared\Models\ResponsabilidadFiscal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Modules\Settings\Company\Models\DatoTributario
 *
 * @property int $id
 * @property int $tarifa_ica
 * @property int $maneja_aiu
 * @property int $utiliza_dos_impuestos
 * @property int $es_agente_retenedor
 * @property int $maneja_impuesto_ad_valorem
 * @property int $moneda_extranjera
 * @property int $actividad_economica_codigo_ciiu
 * @property int $empresa_serial
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Settings\Company\Models\ActividadEconomica $actividadEconomica
 * @property-read \App\Modules\Settings\Company\Models\Empresa $empresa
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ResponsabilidadFiscal> $responsabilidadesFiscales
 * @property-read int|null $responsabilidades_fiscales_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Settings\Company\Models\Tributo> $tributos
 * @property-read int|null $tributos_count
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario query()
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereActividadEconomicaCodigoCiiu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereEmpresaSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereEsAgenteRetenedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereManejaAiu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereManejaImpuestoAdValorem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereMonedaExtranjera($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereTarifaIca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatoTributario whereUtilizaDosImpuestos($value)
 * @mixin \Eloquent
 */
class DatoTributario extends Model
{
    use HasFactory;

    protected $table = 'datos_tributarios';

    protected $fillable = [
        'tarifa_ica',
        'maneja_aiu',
        'utiliza_dos_impuestos',
        'es_agente_retenedor',
        'maneja_impuesto_ad_valorem',
        'moneda_extranjera',
        'actividad_economica_codigo_ciiu',
        'empresa_serial'
    ];

    public function actividadEconomica()
    {
        return $this->belongsTo(ActividadEconomica::class, 'actividad_economica_codigo_ciiu', 'codigo_ciiu');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_serial', 'serial');
    }

    public function responsabilidadesFiscales()
    {
        return $this->belongsToMany(ResponsabilidadFiscal::class, 'dato_tributario_resp_fiscal',
                'dato_tributario_id', 'responsabilidad_fiscal_id');
    }

    public function tributos() : BelongsToMany
    {
        return $this->belongsToMany(Tributo::class, 'dato_tributario_tributo',
                'dato_tributario_id', 'tributo_id');
    }
}
