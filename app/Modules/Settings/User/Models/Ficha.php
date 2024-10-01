<?php

namespace App\Modules\Settings\User\Models;

use App\Modules\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
