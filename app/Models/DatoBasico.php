<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_codigo_dian', 'codigo_dian');
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'datos_basicos_id');
    }
}
