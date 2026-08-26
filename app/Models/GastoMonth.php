<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GastoMonth extends Model
{
    protected $fillable = [
        'name',
        'month_number',
        'year',
        'user_id',
    ];

    protected $casts = [
        'month_number' => 'integer',
        'year' => 'integer',
    ];

    public function weeks(): HasMany
    {
        return $this->hasMany(GastoWeek::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
