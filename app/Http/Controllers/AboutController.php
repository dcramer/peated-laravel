<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Entity;
use App\Models\Tasting;

class AboutController extends Controller
{
    public function show()
    {
        $stats = [
            'tastings' => Tasting::count(),
            'bottles' => Bottle::count(),
            'entities' => Entity::count(),
        ];

        return view('about', [
            'stats' => $stats,
            'version' => config('app.version'),
            'githubRepo' => config('services.github.repo'),
            'discordLink' => config('services.discord.link'),
        ]);
    }
}
