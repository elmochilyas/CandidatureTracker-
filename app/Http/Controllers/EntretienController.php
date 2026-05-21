<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntretienRequest;
use App\Http\Requests\UpdateEntretienRequest;
use App\Models\Candidature;
use App\Models\Entretien;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

    public function edit(Candidature $candidature, Entretien $entretien): View
    {
        $this->authorize('update', $entretien);

        return view('entretiens.edit', compact('candidature', 'entretien'));
    }

    public function update(UpdateEntretienRequest $request, Candidature $candidature, Entretien $entretien): RedirectResponse
    {
        $this->authorize('update', $entretien);

        $entretien->update($request->validated());

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Entretien modifié avec succès.');
    }

    public function destroy(Candidature $candidature, Entretien $entretien): RedirectResponse
    {
        $this->authorize('delete', $entretien);

        $entretien->delete();

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Entretien supprimé avec succès.');
    }
}
