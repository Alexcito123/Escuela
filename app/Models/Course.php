<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion',
        'grade_id',
        'teacher_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'hora_inicio' => 'string',
            'hora_fin' => 'string',
        ];
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
