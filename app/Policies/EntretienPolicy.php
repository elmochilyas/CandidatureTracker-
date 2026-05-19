<?php

namespace App\Policies;

use App\Models\Entretien;
use App\Models\User;

class EntretienPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Entretien $entretien): bool
    {
        return $user->id === $entretien->candidature->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Entretien $entretien): bool
    {
        return $user->id === $entretien->candidature->user_id;
    }

    public function delete(User $user, Entretien $entretien): bool
    {
        return $user->id === $entretien->candidature->user_id;
    }

    public function restore(User $user, Entretien $entretien): bool
    {
        return false;
    }

    public function forceDelete(User $user, Entretien $entretien): bool
    {
        return false;
    }
}
