<?php

namespace App\Modules\Settings\Third\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TipoTercero extends Model
{
    use HasFactory;

    protected $table = 'tipo_terceros';

    protected $fillable = ['nombre'];

    public function terceros() : BelongsToMany
    {
        return $this->belongsToMany(Tercero::class, 'tercero_tipo_tercero', 'tipo_tercero_id',
            'tercero_id');
    }
}
