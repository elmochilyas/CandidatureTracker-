<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $fillable = [
        'candidature_id',
        'file_path',
        'original_name',
        'file_size',
        'mime_type',
    ];

    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }

    public function getSizeForHumansAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['o', 'Ko', 'Mo', 'Go'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 1) . ' ' . $units[$i];
    }

    public function getIconAttribute(): string
    {
        return match (true) {
            str_starts_with($this->mime_type, 'image/') => 'image',
            $this->mime_type === 'application/pdf' => 'pdf',
            str_contains($this->mime_type, 'word') => 'word',
            default => 'file',
        };
    }
}
