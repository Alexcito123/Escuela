<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GastoWeek extends Model
{
    protected $fillable = [
        'gasto_month_id',
        'name',
        'date_range',
        'week_number',
        'user_id',
    ];

    protected $casts = [
        'week_number' => 'integer',
    ];

    public function gastoMonth(): BelongsTo
    {
        return $this->belongsTo(GastoMonth::class);
    }

    public function rows(): HasMany
    {
        return $this->hasMany(GastoRow::class, 'gasto_week_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
