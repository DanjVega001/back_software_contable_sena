<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $primaryKey = 'serial';    

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
    ];

    /*
    protected static function booted()
    {
        static::deleted(function ($empresa) {
            $empresa->datosBasicos()->delete();
        });
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function datosBasicos()
    {
        return $this->hasOne(DatoBasico::class, 'empresa_serial', 'serial');
    }

    public function representanteLegal()
    {
        return $this->hasOne(RepresentanteLegal::class, 'empresa_serial', 'serial');
    }

    public function datosTributarios()
    {
        return $this->hasOne(DatoTributario::class, 'empresa_serial', 'serial');
    }
}
