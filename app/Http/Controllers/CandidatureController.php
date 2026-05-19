<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
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
}
