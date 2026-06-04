<?php

namespace Database\Seeders;

use App\Models\Candidature;
use App\Models\Entretien;
use App\Models\User;
use Illuminate\Database\Seeder;

class EntretienSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'elmochilyas@gmail.com')->first();

        if (!$user) {
            $this->command->warn('User with email elmochilyas@gmail.com not found. Skipping seeder.');
            return;
        }

        $candidatures = Candidature::where('user_id', $user->id)->get()->keyBy('company_name');

        $entretiens = [
            'Qonto' => [
                [
                    'type' => 'phone',
                    'scheduled_at' => '2026-03-20 10:00:00',
                    'notes' => 'Premier échange RH. Présentation du poste et de l\'équipe.',
                    'result' => 'positive',
                ],
                [
                    'type' => 'technical',
                    'scheduled_at' => '2026-04-05 14:00:00',
                    'notes' => 'Test technique sur Laravel et conception d\'API. Bonne maîtrise du framework.',
                    'result' => 'positive',
                ],
                [
                    'type' => 'in_person',
                    'scheduled_at' => '2026-04-18 11:00:00',
                    'notes' => 'Entretien final avec le CTO. À venir.',
                    'result' => 'pending',
                ],
            ],
            'Malt' => [
                [
                    'type' => 'phone',
                    'scheduled_at' => '2026-04-10 09:30:00',
                    'notes' => 'Appel découverte avec le recruteur. Stack correspond bien au profil.',
                    'result' => 'positive',
                ],
            ],
            'Alan' => [
                [
                    'type' => 'technical',
                    'scheduled_at' => '2026-04-01 15:00:00',
                    'notes' => 'Test technique réalisé à distance. Exercice de refactoring Symfony.',
                    'result' => 'positive',
                ],
            ],
            'Doctolib' => [
                [
                    'type' => 'video',
                    'scheduled_at' => '2026-02-20 14:30:00',
                    'notes' => 'Entretien vidéo avec le lead dev. Questions sur l\'architecture microservices.',
                    'result' => 'negative',
                ],
            ],
            'Ledger' => [
                [
                    'type' => 'hr',
                    'scheduled_at' => '2026-02-01 11:00:00',
                    'notes' => 'Entretien RH standard. Présentation de l\'entreprise et package salarial.',
                    'result' => 'positive',
                ],
                [
                    'type' => 'technical',
                    'scheduled_at' => '2026-02-10 14:00:00',
                    'notes' => 'Entretien technique poussé sur PHP, PostgreSQL et Redis. Très bon retour.',
                    'result' => 'positive',
                ],
                [
                    'type' => 'in_person',
                    'scheduled_at' => '2026-02-18 10:00:00',
                    'notes' => 'Rencontre avec l\'équipe et le CTO. Fit culturel parfait.',
                    'result' => 'positive',
                ],
            ],
            'Deezer' => [
                [
                    'type' => 'hr',
                    'scheduled_at' => '2026-04-25 14:00:00',
                    'notes' => 'Entretien RH programmé. Préparer les réalisations Laravel.',
                    'result' => 'pending',
                ],
            ],
        ];

        $count = 0;

        foreach ($entretiens as $company => $interviews) {
            $candidature = $candidatures->get($company);

            if (!$candidature) {
                $this->command->warn("Candidature pour {$company} non trouvée. Ignorée.");
                continue;
            }

            foreach ($interviews as $data) {
                Entretien::create([
                    'candidature_id' => $candidature->id,
                    ...$data,
                ]);
                $count++;
            }
        }

        $this->command->info("{$count} entretiens créés pour les candidatures de elmochilyas@gmail.com");
    }
}
