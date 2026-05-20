<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use App\Models\Candidature;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CandidatureController extends Controller
{
    public function index(): View
    {
        $candidatures = auth()->user()
            ->candidatures()
            ->with('entretiens')
            ->latest()
            ->get();

        return view('candidatures.index', compact('candidatures'));
    }

    public function create(): View
    {
        return view('candidatures.create');
    }

    public function store(StoreCandidatureRequest $request): RedirectResponse
    {
        $candidature = auth()->user()->candidatures()->create(
            $request->validated()
        );

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Candidature créée avec succès.');
    }

    public function show(Candidature $candidature): View
    {
        $this->authorize('view', $candidature);

        $candidature->load('entretiens');

        return view('candidatures.show', compact('candidature'));
    }

    public function edit(Candidature $candidature): View
    {
        $this->authorize('update', $candidature);

        return view('candidatures.edit', compact('candidature'));
    }

    public function update(UpdateCandidatureRequest $request, Candidature $candidature): RedirectResponse
    {
        $this->authorize('update', $candidature);

        $candidature->update($request->validated());

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Candidature mise à jour avec succès.');
    }
}
