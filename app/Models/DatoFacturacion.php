<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
