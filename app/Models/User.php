<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

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
