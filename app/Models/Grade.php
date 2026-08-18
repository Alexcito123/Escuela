<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Grade extends Model
{
    protected $fillable = [
        'name',
        'level',
        'display_order',
    ];

    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class);
    }

    public function archives(): HasManyThrough
    {
        return $this->hasManyThrough(Archive::class, Folder::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
