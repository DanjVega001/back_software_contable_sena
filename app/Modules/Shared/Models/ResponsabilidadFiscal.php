<?php

namespace App\Modules\Shared\Models;

use App\Modules\Settings\Company\Models\DatoTributario;
use App\Modules\Settings\Third\Models\DatoFacturacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
