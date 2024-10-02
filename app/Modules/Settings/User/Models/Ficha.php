<?php

namespace App\Modules\Settings\User\Models;

use App\Modules\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Settings\User\Models\Ficha
 *
 * @property int $id
 * @property int $codigo
 * @property int $numero
 * @property string $programa
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $creadoPor
 * @property-read int|null $creado_por_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha wherePrograma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ficha whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ficha extends Model
{
    use HasFactory;

    protected $table = "fichas";

    protected $fillable = [
        'codigo',
        'numero',
        'programa',
        'creado_por'
    ];

    protected static function booted()
    {
        static::deleting(function ($ficha) {
            $ficha->users()->delete();
        });
    }

    public function creadoPor()
    {
        return $this->belongsToMany(User::class)->wherePivot('rol', '=', 'instructor');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->wherePivot('rol', '=', 'aprendiz');
    }
}
