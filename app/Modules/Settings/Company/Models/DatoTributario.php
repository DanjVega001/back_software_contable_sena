<?php

namespace App\Modules\Settings\Company\Models;

use App\Modules\Shared\Models\ResponsabilidadFiscal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
