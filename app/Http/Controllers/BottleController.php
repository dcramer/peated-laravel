<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use Illuminate\Http\Request;

class BottleController extends Controller
{
    public function index(Request $request)
    {
        return view('bottles.index');
    }

    public function show(Bottle $bottle)
    {
        // Load relationships needed for stats and overview
        $bottle->load([
            'distillers',
            'bottlers',
            'tastings',
            'tastings.createdBy',
        ]);

        // Get metadata for SEO
        $description = str($bottle->description ?: '')->limit(200);

        return view('bottles.show', [
            'bottle' => $bottle,
            'meta' => [
                'title' => $bottle->fullName,
                'description' => $description,
                'image' => $bottle->imageUrl,
                'openGraph' => [
                    'title' => $bottle->fullName,
                    'description' => $description,
                    'images' => [$bottle->imageUrl],
                ],
                'twitter' => [
                    'card' => 'summary',
                    'images' => [$bottle->imageUrl],
                ],
            ],
        ]);
    }
}
