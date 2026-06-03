<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $allCandidatures = auth()->user()->candidatures()->with('entretiens')->get();
        $recentCandidatures = $allCandidatures->sortByDesc('created_at')->take(5);

        $stats = [
            'total'      => $allCandidatures->count(),
            'toApply'    => $allCandidatures->where('status', 'to_apply')->count(),
            'applied'    => $allCandidatures->where('status', 'applied')->count(),
            'waiting'    => $allCandidatures->where('status', 'waiting')->count(),
            'inProgress' => $allCandidatures->whereIn('status', ['applied', 'waiting'])->count(),
            'interviews' => $allCandidatures->where('status', 'interview_scheduled')->count(),
            'accepted'   => $allCandidatures->where('status', 'accepted')->count(),
            'rejected'   => $allCandidatures->where('status', 'rejected')->count(),
        ];

        return view('dashboard', compact('stats', 'recentCandidatures'));
    }
}
