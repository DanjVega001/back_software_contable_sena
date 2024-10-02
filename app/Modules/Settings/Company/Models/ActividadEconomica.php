<?php

namespace App\Modules\Settings\Company\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Settings\Company\Models\ActividadEconomica
 *
 * @property int $codigo_ciiu
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Settings\Company\Models\DatoTributario> $datosTributarios
 * @property-read int|null $datos_tributarios_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadEconomica newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadEconomica newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadEconomica query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadEconomica whereCodigoCiiu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadEconomica whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadEconomica whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadEconomica whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
