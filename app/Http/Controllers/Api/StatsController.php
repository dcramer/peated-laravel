<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bottle;
use App\Models\Entity;
use App\Models\Tasting;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'totalTastings' => Tasting::count(),
            'totalBottles' => Bottle::count(),
            'totalEntities' => Entity::count(),
        ]);
    }
}
