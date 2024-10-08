<?php

namespace App\Modules\Accounting\Models;

use App\Modules\Accounting\Utils\Constants\AccountConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Modules\Accounting\Models\CuentaContable
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CuentaContable> $childrens
 * @property-read int|null $childrens_count
 * @property-read CuentaContable|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|CuentaContable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuentaContable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuentaContable query()
 * @mixin \Eloquent
 */
class CuentaContable extends Model
{
    use HasFactory;

    protected $table = 'cuentas_contables';

    protected $fillable = ['codigo', 'nombre', 'descripcion', 'nivel', 'naturaleza', 'padre_id', 'empresa_serial'];

    public function parent() : BelongsTo
    {
        return $this->belongsTo(CuentaContable::class, 'padre_id');
    }

    public function childrens() : HasMany
    {
        return $this->hasMany(CuentaContable::class, 'padre_id');
    }

    public function descendants($empresa_serial): HasMany
    {
        if ($this->nivel == AccountConstants::classAccName || $this->nivel == AccountConstants::groupAccName
            || $this->nivel == AccountConstants::accountAccName)
        {
            return $this->childrens()->with('descendants');
        }
        else {
            return $this->childrens()->with('descendants')->where('empresa_serial',
                '=', $empresa_serial);
        }
    }

}
