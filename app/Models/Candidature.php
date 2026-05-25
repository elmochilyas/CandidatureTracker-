<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'user_id',
    'company_name',
    'role',
    'offer_url',
    'status',
    'priority',
    'notes',
    'application_date',
])]
class Candidature extends Model
{
    use HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return [
            'application_date' => 'date:Y-m-d',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entretiens(): HasMany
    {
        return $this->hasMany(Entretien::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    protected static function booted(): void
    {
        static::forceDeleting(function (Candidature $candidature) {
            foreach ($candidature->attachments as $attachment) {
                if (Storage::disk('public')->exists($attachment->file_path)) {
                    Storage::disk('public')->delete($attachment->file_path);
                }
            }
            $candidature->attachments()->delete();
        });
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'to_apply' => 'À postuler',
            'applied' => 'Candidature envoyée',
            'waiting' => 'En attente',
            'interview_scheduled' => 'Entretien programmé',
            'rejected' => 'Refus',
            'accepted' => 'Acceptée',
            default => $this->status ?? '',
        };
    }

    public function getPriorityLabelAttribute(): string
    {
        return match ($this->priority) {
            'low' => 'Basse',
            'normal' => 'Normale',
            'high' => 'Haute',
            default => $this->priority ?? '',
        };
    }
}
