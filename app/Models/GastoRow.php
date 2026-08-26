<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GastoRow extends Model
{
    protected $fillable = [
        'gasto_week_id',
        'alumno',
        'pago_semanal',
        'mensual',
        'columna1',
        'gastos_semana',
        'pendientes_pagar',
        'row_order',
        'user_id',
    ];

    protected $casts = [
        'row_order' => 'integer',
    ];

    public function gastoWeek(): BelongsTo
    {
        return $this->belongsTo(GastoWeek::class, 'gasto_week_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
