<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archive extends Model
{
    protected $fillable = [
        'folder_id',
        'grade_id',
        'title',
        'description',
        'file_path',
        'file_name',
        'original_name',
        'file_size',
        'file_mime',
        'user_id',
    ];

    protected $casts = [
        'file_path' => 'array',
        'file_name' => 'array',
        'original_name' => 'array',
        'file_size' => 'array',
        'file_mime' => 'array',
    ];

    public function getFilesAttribute(): array
    {
        $paths = $this->file_path ?? [];
        $originals = $this->original_name ?? [];
        $sizes = $this->file_size ?? [];
        $mimes = $this->file_mime ?? [];

        $files = [];
        foreach ($paths as $i => $path) {
            $files[] = [
                'path' => $path,
                'original_name' => $originals[$i] ?? basename($path),
                'size' => (int) ($sizes[$i] ?? 0),
                'mime' => $mimes[$i] ?? 'application/octet-stream',
            ];
        }

        return $files;
    }

    public function getTotalSizeAttribute(): int
    {
        return array_sum(array_map('intval', $this->file_size ?? []));
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
