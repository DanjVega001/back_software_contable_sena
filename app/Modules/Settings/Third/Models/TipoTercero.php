<?php

namespace App\Modules\Settings\Third\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Modules\Settings\Third\Models\TipoTercero
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Settings\Third\Models\Tercero> $terceros
 * @property-read int|null $terceros_count
 * @method static \Illuminate\Database\Eloquent\Builder|TipoTercero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoTercero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoTercero query()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoTercero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoTercero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoTercero whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoTercero whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TipoTercero extends Model
{
    use HasFactory;

    protected $table = 'tipo_terceros';

    protected $fillable = ['nombre'];

    public function terceros() : BelongsToMany
    {
        return $this->belongsToMany(Tercero::class, 'tercero_tipo_tercero', 'tipo_tercero_id',
            'tercero_id');
    }
}
