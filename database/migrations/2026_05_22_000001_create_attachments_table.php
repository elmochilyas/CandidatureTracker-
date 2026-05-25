<?php

use App\Models\Candidature;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained()->cascadeOnDelete();
            $table->string('file_path');
            $table->string('original_name');
            $table->unsignedBigInteger('file_size');
            $table->string('mime_type');
            $table->timestamps();
        });

        Candidature::whereNotNull('file_path')->chunk(100, function ($candidatures) {
            foreach ($candidatures as $candidature) {
                if (Storage::disk('public')->exists($candidature->file_path)) {
                    $candidature->attachments()->create([
                        'file_path' => $candidature->file_path,
                        'original_name' => basename($candidature->file_path),
                        'file_size' => Storage::disk('public')->size($candidature->file_path),
                        'mime_type' => Storage::disk('public')->mimeType($candidature->file_path),
                    ]);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
