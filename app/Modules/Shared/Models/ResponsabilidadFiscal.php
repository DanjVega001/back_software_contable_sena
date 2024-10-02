<?php

namespace App\Modules\Shared\Models;

use App\Modules\Settings\Company\Models\DatoTributario;
use App\Modules\Settings\Third\Models\DatoFacturacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Modules\Shared\Models\ResponsabilidadFiscal
 *
 * @property string $codigo
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, DatoFacturacion> $datosFacturaciones
 * @property-read int|null $datos_facturaciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, DatoTributario> $empresas
 * @property-read int|null $empresas_count
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsabilidadFiscal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsabilidadFiscal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsabilidadFiscal query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsabilidadFiscal whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsabilidadFiscal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsabilidadFiscal whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsabilidadFiscal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ResponsabilidadFiscal extends Model
{
    use HasFactory;

    protected $primaryKey = 'codigo';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table ='responsabilidades_fiscales';

    protected $fillable = ['codigo', 'descripcion'];

    public function empresas() : BelongsToMany
    {
        return $this->belongsToMany(DatoTributario::class, 'dato_tributario_resp_fiscal',
                'responsabilidad_fiscal_id', 'dato_tributario_id');
    }

    public function datosFacturaciones() : BelongsToMany
    {
        return $this->belongsToMany(DatoFacturacion::class, 'dato_facturacion_resp_fiscal',
                'responsabilidad_fiscal_id', 'dato_facturacion_id');
    }
}
