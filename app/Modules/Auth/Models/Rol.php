<?php

namespace App\Modules\Auth\Models;

use App\Modules\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
