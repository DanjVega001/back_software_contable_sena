<?php

namespace App\Models;

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

    public function creadoPor()
    {
        return $this->belongsToMany(User::class)->wherePivot('rol', '=', 'instructor');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->wherePivot('rol', '=', 'aprendiz');
    }
}
