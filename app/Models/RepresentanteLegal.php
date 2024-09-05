<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentanteLegal extends Model
{
    use HasFactory;

    protected $table ='representantes_legales';

    protected $fillable = [
        'nombres', 
        'apellidos', 
        'tipo_identificacion', 
        'numero_identificacion',
        'tiene_socios', 
        'empresa_serial'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_serial', 'serial');
    }    
}
