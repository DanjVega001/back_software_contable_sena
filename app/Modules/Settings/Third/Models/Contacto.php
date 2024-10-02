<?php

namespace App\Modules\Settings\Third\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Modules\Settings\Third\Models\Contacto
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $apellido
 * @property string|null $correo_electronico
 * @property int|null $telefono
 * @property int $tercero_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Settings\Third\Models\Tercero $tercero
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto whereTerceroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacto whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contactos';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo_electronico',
        'telefono',
        'tercero_id',
    ];

    public function tercero() : BelongsTo
    {
        return $this->belongsTo(Tercero::class);
    }
}
