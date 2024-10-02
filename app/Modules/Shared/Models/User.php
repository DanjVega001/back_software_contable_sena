<?php

namespace App\Modules\Shared\Models;

use App\Modules\Auth\Models\Rol;
use App\Modules\Settings\Company\Models\Empresa;
use App\Modules\Settings\User\Models\Ficha;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Modules\Shared\Models\User
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $tipo_identificacion
 * @property int $numero_identificacion
 * @property string $correo_electronico
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $contrasena
 * @property int $rol_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Empresa> $empresas
 * @property-read int|null $empresas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Ficha> $ficha
 * @property-read int|null $ficha_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Ficha> $fichasCreadas
 * @property-read int|null $fichas_creadas_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Rol $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContrasena($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNumeroIdentificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTipoIdentificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'contrasena',
        'tipo_identificacion',
        'numero_identificacion',
        'correo_electronico',
        'rol_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }

    public function fichasCreadas()
    {
        return $this->belongsToMany(Ficha::class)->wherePivot('rol', '=', 'instructor');
    }

    public function ficha()
    {
        return $this->belongsToMany(Ficha::class)->wherePivot('rol', '=', 'aprendiz');
    }
}
