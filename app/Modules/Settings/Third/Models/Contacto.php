<?php

namespace App\Modules\Settings\Third\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
