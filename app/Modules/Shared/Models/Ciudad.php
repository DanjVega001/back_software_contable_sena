<?php

namespace App\Modules\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Shared\Models\Ciudad
 *
 * @property int $codigo_dian
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Shared\Models\DatoBasico> $datosBasicos
 * @property-read int|null $datos_basicos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ciudad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ciudad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ciudad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ciudad whereCodigoDian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ciudad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ciudad whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ciudad whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
