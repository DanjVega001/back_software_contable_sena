<?php

namespace App\Modules\Shared\Models;

use App\Modules\Settings\Company\Models\Empresa;
use App\Modules\Settings\Third\Models\Tercero;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
