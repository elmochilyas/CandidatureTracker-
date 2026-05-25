<?php

namespace Database\Seeders;

use App\Models\Candidature;
use App\Models\User;
use App\Models\Attachment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CandidatureSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'elmochilyas@gmail.com')->first();

        if (!$user) {
            $this->command->warn('User with email elmochilyas@gmail.com not found. Skipping seeder.');
            return;
        }

        $candidatures = [
            [
                'company_name' => 'Qonto',
                'role' => 'Développeur Laravel Senior',
                'offer_url' => 'https://qonto.com/careers',
                'status' => 'interview_scheduled',
                'priority' => 'high',
                'notes' => "Premier contact via LinkedIn. Entretien technique prévu.\nStack : Laravel, Alpine.js, Tailwind CSS",
                'application_date' => '2026-03-15',
                'attachments' => [
                    ['name' => 'CV-Qonto-2026.pdf', 'mime' => 'application/pdf', 'size' => 245760],
                    ['name' => 'Lettre_de_motivation_Qonto.docx', 'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'size' => 15360],
                ],
            ],
            [
                'company_name' => 'Malt',
                'role' => 'Full Stack Developer',
                'offer_url' => 'https://malt.fr/careers',
                'status' => 'applied',
                'priority' => 'high',
                'notes' => "Candidature spontanée. Relance prévue dans 1 semaine.",
                'application_date' => '2026-04-02',
                'attachments' => [
                    ['name' => 'Portfolio_Dev_2026.pdf', 'mime' => 'application/pdf', 'size' => 5242880],
                ],
            ],
            [
                'company_name' => 'Alan',
                'role' => 'Backend Engineer PHP',
                'offer_url' => null,
                'status' => 'waiting',
                'priority' => 'normal',
                'notes' => "Test technique réalisé avec succès. En attente du retour RH.",
                'application_date' => '2026-03-28',
                'attachments' => [],
            ],
            [
                'company_name' => 'Doctolib',
                'role' => 'Software Engineer',
                'offer_url' => 'https://careers.doctolib.com',
                'status' => 'rejected',
                'priority' => 'normal',
                'notes' => "Refus après le premier entretien. Retour : \"profil trop orienté Laravel, recherche plus généraliste\".",
                'application_date' => '2026-02-10',
                'attachments' => [
                    ['name' => 'CV_Doctolib.pdf', 'mime' => 'application/pdf', 'size' => 312000],
                ],
            ],
            [
                'company_name' => 'Ledger',
                'role' => 'Développeur PHP Confirmé',
                'offer_url' => 'https://www.ledger.com/careers',
                'status' => 'accepted',
                'priority' => 'high',
                'notes' => "Offre acceptée ! Poste en CDI, télétravail partiel.\nDate de début : 01/06/2026",
                'application_date' => '2026-01-20',
                'attachments' => [
                    ['name' => 'Contrat_Ledger.pdf', 'mime' => 'application/pdf', 'size' => 1800000],
                    ['name' => 'Photo_identite.jpg', 'mime' => 'image/jpeg', 'size' => 450000],
                ],
            ],
            [
                'company_name' => 'Back Market',
                'role' => 'Senior Full Stack Developer',
                'offer_url' => 'https://jobs.backmarket.com',
                'status' => 'to_apply',
                'priority' => 'low',
                'notes' => "À postuler ce week-end. Préparer une lettre de motivation personnalisée.",
                'application_date' => '2026-04-10',
                'attachments' => [],
            ],
            [
                'company_name' => 'Deezer',
                'role' => 'Backend Developer',
                'offer_url' => 'https://www.deezer.com/jobs',
                'status' => 'interview_scheduled',
                'priority' => 'normal',
                'notes' => "Entretien RH prévu le 25/04 à 14h. Préparer des exemples de projets Laravel.",
                'application_date' => '2026-03-30',
                'attachments' => [
                    ['name' => 'Projets_Laravel.pdf', 'mime' => 'application/pdf', 'size' => 780000],
                ],
            ],
            [
                'company_name' => 'Ornikar',
                'role' => 'Développeur PHP / Laravel',
                'offer_url' => null,
                'status' => 'applied',
                'priority' => 'normal',
                'notes' => "Candidature via Welcome to the Jungle.",
                'application_date' => '2026-04-05',
                'attachments' => [],
            ],
        ];

        foreach ($candidatures as $data) {
            $attachments = $data['attachments'];
            unset($data['attachments']);

            $candidature = Candidature::create([
                'user_id' => $user->id,
                ...$data,
            ]);

            foreach ($attachments as $file) {
                $relativePath = 'candidatures/' . uniqid() . '_' . $file['name'];
                $fullPath = Storage::disk('public')->path($relativePath);

                $dir = dirname($fullPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }

                $content = match ($file['mime']) {
                    'application/pdf' => "%PDF-1.4\n1 0 obj\n<< /Type /Catalog >>\nendobj\n%%EOF",
                    'image/jpeg' => "\xFF\xD8\xFF\xE0\x00\x10JFIF\x00\x01\x01\x00\x00\x01\x00\x01\x00\x00",
                    default => "Fichier de démonstration pour " . $file['name'],
                };
                file_put_contents($fullPath, $content);

                Attachment::create([
                    'candidature_id' => $candidature->id,
                    'file_path' => $relativePath,
                    'original_name' => $file['name'],
                    'file_size' => $file['size'],
                    'mime_type' => $file['mime'],
                ]);
            }
        }

        $this->command->info('8 candidatures créées avec fichiers joints pour elmochilyas@gmail.com');
    }
}
