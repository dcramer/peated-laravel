<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class VersionController extends Controller
{
    public function show()
    {
        return response()->json([
            'version' => config('app.version')
        ]);
    }
}
