<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadEconomica extends Model
{
    use HasFactory;

    protected $table = 'actividades_economicas';

    protected $fillable = [
        'codigo_ciiu',
        'descripcion',
    ];

    public function datosTributarios()
    {
        return $this->hasMany(DatoTributario::class, 'actividad_economica_codigo_ciiu', 'codigo_ciiu');
    }
}
