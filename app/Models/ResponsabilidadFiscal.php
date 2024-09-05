<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsabilidadFiscal extends Model
{
    use HasFactory;

    protected $table ='responsabilidades_fiscales';

    protected $fillable = ['codigo', 'descripcion'];

    public function empresas()
    {
        return $this->belongsToMany(DatoTributario::class, 'dato_tributario_resp_fiscal', 
                'responsabilidad_fiscal_id', 'dato_tributario_id');
    }
}
