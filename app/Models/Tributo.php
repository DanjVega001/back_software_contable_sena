<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
