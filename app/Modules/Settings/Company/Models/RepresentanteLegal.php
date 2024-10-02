<?php

namespace App\Modules\Settings\Company\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Settings\Company\Models\RepresentanteLegal
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $tipo_identificacion
 * @property int $numero_identificacion
 * @property int $tiene_socios
 * @property string|null $lista_socios
 * @property int $empresa_serial
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Settings\Company\Models\Empresa $empresa
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal query()
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereEmpresaSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereListaSocios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereNumeroIdentificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereTieneSocios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereTipoIdentificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepresentanteLegal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'lista_socios',
        'empresa_serial'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_serial', 'serial');
    }
}
