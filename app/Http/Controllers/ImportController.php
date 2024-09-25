<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;

class ImportController extends Controller
{
    public function progress(): JsonResponse
    {
        $userId = auth()->id(); // Adjust as needed
        $cacheKey = 'import_progress_' . $userId;

        $progress = Cache::get($cacheKey, ['status' => 'not started', 'progress' => 0]);

        return response()->json($progress);
    }
}
