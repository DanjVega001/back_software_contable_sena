<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

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
        'datos_basicos_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function datosBasicos()
    {
        return $this->belongsTo(DatoBasico::class, 'datos_basicos_id');
    }

    public function representanteLegal()
    {
        return $this->hasOne(RepresentanteLegal::class, 'empresa_serial', 'serial');
    }
}
