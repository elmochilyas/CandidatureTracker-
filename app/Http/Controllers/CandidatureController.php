<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use App\Models\Candidature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CandidatureController extends Controller
{
    public function index(Request $request): View
    {
        $candidatures = auth()->user()
            ->candidatures()
            ->with('entretiens')
            ->when($request->query('status'), fn($q, $status) => $q->where('status', $status))
            ->when($request->query('priority'), fn($q, $priority) => $q->where('priority', $priority))
            ->when($request->query('search'), fn($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('company_name', 'like', "%{$s}%")->orWhere('role', 'like', "%{$s}%");
            }))
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

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('candidatures', 'public');
            $candidature->update(['file_path' => $path]);
        }

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

        if ($request->hasFile('attachment')) {
            if ($candidature->file_path && Storage::disk('public')->exists($candidature->file_path)) {
                Storage::disk('public')->delete($candidature->file_path);
            }
            $path = $request->file('attachment')->store('candidatures', 'public');
            $candidature->update(['file_path' => $path]);
        }

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Candidature mise à jour avec succès.');
    }

    public function destroy(Candidature $candidature): RedirectResponse
    {
        $this->authorize('delete', $candidature);

        $candidature->delete();

        return redirect()
            ->route('candidatures.index')
            ->with('success', 'Candidature archivée avec succès.');
    }

    public function restore(Candidature $candidature): RedirectResponse
    {
        $this->authorize('restore', $candidature);

        $candidature->restore();

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Candidature restaurée avec succès.');
    }

    public function download(Candidature $candidature): StreamedResponse
    {
        $this->authorize('view', $candidature);

        if (!$candidature->file_path || !Storage::disk('public')->exists($candidature->file_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($candidature->file_path);
    }

    public function archived(): View
    {
        $candidatures = auth()->user()
            ->candidatures()
            ->onlyTrashed()
            ->with('entretiens')
            ->latest()
            ->get();

        return view('candidatures.archived', compact('candidatures'));
    }
}
