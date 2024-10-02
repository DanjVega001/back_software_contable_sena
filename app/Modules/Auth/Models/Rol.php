<?php

namespace App\Modules\Auth\Models;

use App\Modules\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Auth\Models\Rol
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Rol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rol query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rol extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $fillable = ['nombre'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
