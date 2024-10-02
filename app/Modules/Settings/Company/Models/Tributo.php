<?php

namespace App\Modules\Settings\Company\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Modules\Settings\Company\Models\Tributo
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Tributo> $datosTributariosTributos
 * @property-read int|null $datos_tributarios_tributos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tributo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tributo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tributo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tributo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tributo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tributo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tributo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tributo extends Model
{
    use HasFactory;

    protected $table = 'tributos';

    protected $fillable = [
        'name'
    ];

    public function datosTributariosTributos() : BelongsToMany
    {
        return $this->belongsToMany(Tributo::class, 'dato_tributario_tributo',
            'tributo_id', 'dato_tributario_id');
    }

}
