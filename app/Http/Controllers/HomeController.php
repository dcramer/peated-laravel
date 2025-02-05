<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Tasting;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // // Get recent activity
        $recentTastings = Tasting::with(['createdBy', 'bottle'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // // Get popular bottles
        $popularBottles = Bottle::withCount('tastings')
            ->orderBy('tastings_count', 'desc')
            ->take(5)
            ->get();

        // Get site stats
        $stats = [
            'total_bottles' => Bottle::count(),
            'total_tastings' => Tasting::count(),
            'total_users' => User::count(),
        ];

        return view('home', [
            'recentTastings' => $recentTastings,
            'popularBottles' => $popularBottles,
            'stats' => $stats,
        ]);
    }
}
