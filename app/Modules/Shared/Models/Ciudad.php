<?php

namespace App\Modules\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = ['codigo_dian', 'nombre'];

    public function datosBasicos()
    {
        return $this->hasMany(DatoBasico::class, 'ciudad_codigo_dian', 'codigo_dian');
    }
}
