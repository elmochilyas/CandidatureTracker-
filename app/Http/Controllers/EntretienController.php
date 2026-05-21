<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntretienRequest;
use App\Models\Candidature;
use Illuminate\Http\RedirectResponse;

class EntretienController extends Controller
{
    public function store(StoreEntretienRequest $request, Candidature $candidature): RedirectResponse
    {
        $this->authorize('view', $candidature);

        $candidature->entretiens()->create($request->validated());

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Entretien ajouté avec succès.');
    }
}
