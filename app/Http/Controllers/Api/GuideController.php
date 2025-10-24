<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuideResource;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index(Request $request)
    {
        $query = Guide::query()->where('is_active', true);

        if ($request->has('min_experience')) {
            $query->where('experience_years', '>=', (int) $request->min_experience);
        }

        return GuideResource::collection($query->get());
    }
}
