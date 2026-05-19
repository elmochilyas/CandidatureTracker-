<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'candidature_id',
    'type',
    'scheduled_at',
    'notes',
    'result',
])]
class Entretien extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
        ];
    }

    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'phone' => 'Téléphonique',
            'video' => 'Vidéo',
            'technical' => 'Technique',
            'hr' => 'RH',
            'in_person' => 'Présentiel',
            default => $this->type ?? '',
        };
    }

    public function getResultLabelAttribute(): string
    {
        return match ($this->result) {
            'pending' => 'En attente',
            'positive' => 'Positif',
            'negative' => 'Négatif',
            'rescheduled' => 'Reporté',
            default => $this->result ?? '',
        };
    }
}
